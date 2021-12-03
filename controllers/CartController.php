<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\core\Response;
use app\models\Cart;
use app\models\Customer;
use app\models\ShopItem;
use app\models\TemporaryCart;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Webhook;


class CartController extends Controller
{
    public function cart(Request $request, Response $response)
    {
        $this->setLayout('cart');
        $items = TemporaryCart::findAll(array_slice($request->getBody(), 1, null, true));
        $total = 0;
        $shopitems = [];
        foreach ($items as $item) {
            $shopitem = ShopItem::findOne(['ItemID' => $item->ItemID, 'ShopID' => $item->ShopID]);
            $shopitems[$item->ShopID][$item->ItemID] = [$shopitem, $item];
            $total += $shopitem->UnitPrice * $item->Quantity;
        }

        return $this->render('customer/cart', ['items' => $items, 'total' => $total, 'shopitems' => $shopitems]);
    }

    public function getCart(Request $request, Response $response) // get all items from DB
    {
        $items = TemporaryCart::findAll(array_slice($request->getBody(), 1, null, true));
        $total = 0;
        foreach ($items as $item) {
            $shopitem = ShopItem::findOne(['ItemID' => $item->ItemID, 'ShopID' => $item->ShopID]);
            $total += $shopitem->UnitPrice * $item->Quantity;
        }
        return $response->json(['items' => $items, 'total' => $total]);
    }

    public function addToCart(Request $request, Response $response)
    {
        $json = $request->getJson();
        if ($json) {
            $tempcart = new TemporaryCart();
            $tempcart->loadData($json);
            $checktemp = TemporaryCart::findOne(["ItemID" => $tempcart->ItemID, "ShopID" => $tempcart->ShopID, "CustomerID" => $tempcart->CustomerID]);
            if ($request->isPost()) {
                if ($checktemp) { //there exists such item
                    $newQuantity = $tempcart->Quantity + $checktemp->Quantity;
                    $tempcart->Quantity = $newQuantity;
                    if ($tempcart->validate('update') && $tempcart->update()) {
                        return $response->json('{"success":"ok"}');
                    }
                } else {
                    if ($tempcart->validate() && $tempcart->save()) {
                        return json_encode('{"success":"ok"}');
                    }
                }
                return $response->json('{"success":"fail"}');
            } elseif($request->isPatch()) {
                if ($checktemp) { //there exists such item
                    $tempcart->loadData($checktemp);
                    $tempcart->Quantity = $json['Quantity'];
                    if ($tempcart->validate('update') && $tempcart->update()) {
                        return $response->json('{"success":"ok"}');
                    }
                }
            }
        }
        return $response->json('{"success":"fail"}');
    }

    public function deleteFromCart(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $json = $request->getJson();
            if ($json) {
                $status = TemporaryCart::delete($json);
                if ($status) {
                    return $response->json('{"success":"ok"}');
                }
            }
        }
        return $response->json('{"success":"fail"}');

    }

    public function checkout(Request $request,Response $response)
    {
        $this->setLayout('checkoutL');
        $customerid = Application::getCustomerID();
        $customer = Customer::findOne(['CustomerID'=>$customerid]);
        $shopcount = DBModel::query("SELECT COUNT(DISTINCT `ShopID`) FROM `temporarycart` WHERE CustomerID=".$customerid." AND Purchased=0",\PDO::FETCH_COLUMN);
        $subprice = DBModel::query("SELECT SUM(tc.Quantity*si.UnitPrice) FROM temporarycart AS tc,shopitem AS si WHERE tc.ItemID = si.ItemID AND tc.ShopID = si.ShopID AND tc.CustomerID=".$customerid." AND tc.Purchased=0",\PDO::FETCH_COLUMN);
        $itemcount = DBModel::query("SELECT COUNT(*) FROM temporarycart AS tc,shopitem AS si WHERE tc.ItemID = si.ItemID AND tc.ShopID = si.ShopID AND tc.CustomerID=".$customerid." AND tc.Purchased=0",\PDO::FETCH_COLUMN);
        $deliveryfee = $this->getDeliveryFee($shopcount);
        $totalprice = $subprice + $deliveryfee;
        return $this->render('customer/checkout',[
            'customer' => $customer,
            'shopcount' => $shopcount,
            'subprice' => $subprice,
            'itemcount' => $itemcount,
            'deliveryfee' => $deliveryfee,
            'totalprice' => $totalprice
        ]);
    }

    /**
     * @throws ApiErrorException
     * @throws ForbiddenException
     */
    public function proceedToCheckout(Request $request, Response $response)
    {
        if(Application::isCustomer()) {
            if ($request->isPost()) {
                $recipient_name = filter_var($request->getBody()['recipient-name'],FILTER_SANITIZE_SPECIAL_CHARS);
                $notes = filter_var($request->getBody()['note'],FILTER_SANITIZE_SPECIAL_CHARS);
                $recipient_contact = filter_var($request->getBody()['recipient-contact'],FILTER_SANITIZE_NUMBER_INT);

                $domain = Application::$app->domain;

                //There should be a procedure for checking the stock.
                $this->checkStock(Application::getCustomerID());
                //get the availible items
                $shopcount = DBModel::query("SELECT COUNT(DISTINCT `ShopID`) FROM `temporarycart` WHERE CustomerID=".Application::getCustomerID()." AND Purchased=1",\PDO::FETCH_COLUMN);
                $subprice = DBModel::query("SELECT SUM(tc.Quantity*si.UnitPrice) FROM temporarycart AS tc,shopitem AS si WHERE tc.ItemID = si.ItemID AND tc.ShopID = si.ShopID AND tc.CustomerID=".Application::getCustomerID()." AND tc.Purchased=1",\PDO::FETCH_COLUMN);
                $deliveryfee = $this->getDeliveryFee($shopcount);
                $totalprice = $subprice + $deliveryfee;

                $checkout_session = Application::$app->stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'metadata'=>[
                        'userid' => Application::getCustomerID(),
                        'recipient_name'=> $recipient_name,
                        'notes' => $notes,
                        'recipient_contact' => $recipient_contact,
                        'deliverycost' => $deliveryfee,
                        'totalcost' => $totalprice
                    ],
                    'customer_email' => Application::$app->user->getEmail(),
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'lkr',
                            'unit_amount' => $totalprice*100,
                            'product_data'=>[
                                'name' => 'Grocery Galleria Cart'
                            ]
                        ],
                        'quantity' => 1,
                    ]],
                    'expires_at'=> time() + 3600,
                    'mode' => 'payment',
                    'success_url' => $domain . 'pay/success',
                    'cancel_url' => $domain . 'customer/cart',
                ]);

                return $response->redirect($checkout_session->url);

            } else {
                $response->redirect('/customer/checkout');
            }
        }
        throw new ForbiddenException("Not Allowed",403);
    }

    public function getDeliveryFee(int $shopcount)
    {
        return ($shopcount > 1)?160:120;
    }

    public function paymentProcessor(Request $request,Response $response)
    {
        $endpoint_secret = $_ENV['STRIPE_WEBHOOK_SECRET'];

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }
        switch ($event->type) {
            case 'checkout.session.completed':
                $checkoutSession = $event->data->object;
                $this->fullfillOrder($checkoutSession);

            case 'checkout.session.expired':
                $checkoutSession = $event->data->object;
                $userid = $checkoutSession->metadata->userid;
                $this->cancelOrder($userid);
                Application::$app->logger->debug("Canceled");
            default:
                echo 'Received unknown event type ' . $event->type;
        }
        http_response_code(200);

    }

    public function checkStock($user){
        DBModel::callProcedure('checkStock',['ID'=>$user]);
    }

    public function fullfillOrder($obj)
    {
        $customerid = $obj->metadata->userid;
        $customer_email=$obj->customer_email;
        $notes=$obj->metadata->notes;
        $rec_name=$obj->metadata->recipient_name;
        $rec_contact=$obj->metadata->recipient_contact;
        $delivery_fee=$obj->metadata->deliverycost;
        $totalcost=$obj->metadata->totalcost;

        $customer = Customer::findOne(['CustomerID' => $customerid]);
        if($customer->Email == $customer_email){ //we are good to go
            DBModel::callProcedure('fullfillOrder',[
                'ID'=>$customerid,
                'Note'=>$notes,
                'Recipient_Name'=>$rec_name,
                'Recipient_Num'=>$rec_contact,
                'Delivery_Fee' => $delivery_fee,
                'Total_Price' => $totalcost
            ]);
        }

    }

    public function cancelOrder($user){
        DBModel::callProcedure('cancelStock',['ID'=>$user]);
    }



}