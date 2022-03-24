<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\core\Response;
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

    public function getTempCart(Request $request, Response $response) // get all items from DB
    {
        $items = TemporaryCart::findAll(["CustomerID" => Application::getUserID(),"Purchased"=> 0]);
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
            $tempcart->CustomerID=Application::getUserID();
            $checktemp = TemporaryCart::findOne(["ItemID" => $tempcart->ItemID, "ShopID" => $tempcart->ShopID, "CustomerID" => Application::getUserID()]);
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
        $customerid = Application::getUserID();
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
     *
     * [
        'price_data' => [
            'currency' => 'usd',
            'unit_amount' => 1000,
            'product_data' =>
     *          [
                'name' => 'test1',
                ],
            ],
            'quantity' => 1,
        ]
     *
     * [
        'price_data' => [
            'currency' => 'lkr',
            'unit_amount' => $totalprice*100,
            'product_data'=>[
            'name' => 'Grocery Galleria Cart'
            ]
        ],
        'quantity' => 1,
    ]
     */


    public function proceedToCheckout(Request $request, Response $response)
    {
        if(Application::getUserRole() === "Customer") {
            if ($request->isPost()) {
                $recipient_name = filter_var($request->getBody()['recipient-name'],FILTER_SANITIZE_SPECIAL_CHARS);
                $notes = filter_var($request->getBody()['note'],FILTER_SANITIZE_SPECIAL_CHARS);
                $recipient_contact = filter_var($request->getBody()['recipient-contact'],FILTER_SANITIZE_NUMBER_INT);

                $domain = Application::$app->domain;

                //There should be a procedure for checking the stock.
                $items = $this->checkStock(Application::getUserID());
                //get the availible items

                $shopcount = DBModel::query("SELECT COUNT(DISTINCT `ShopID`) FROM `temporarycart` WHERE CustomerID=".Application::getUserID()." AND Purchased=1",\PDO::FETCH_COLUMN);
                $subprice = DBModel::query("SELECT SUM(tc.Quantity*si.UnitPrice) FROM temporarycart AS tc,shopitem AS si WHERE tc.ItemID = si.ItemID AND tc.ShopID = si.ShopID AND tc.CustomerID=".Application::getUserID()." AND tc.Purchased=1",\PDO::FETCH_COLUMN);
                $deliveryfee = $this->getDeliveryFee($shopcount);
                $totalprice = $subprice + $deliveryfee;

                $arr = [];
                foreach ($items as $index=>$item){
                  $arr[$index] =   [
                        'price_data' => [
                            'currency' => 'lkr',
                            'unit_amount' => $item["UnitPrice"]*100,
                            'product_data' => [
                                'name' => $item["Name"],
                                'images' => [rtrim(Application::$app->domain, '/').$item["ItemImage"]],
                            ],
                        ],
                        'quantity' => $item["Quantity"],
                    ];
                }

                $checkout_session = Application::$app->stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'metadata'=>[
                        'userid' => Application::getUserID(),
                        'city'=> Application::getCity(),
                        'suburb'=> Application::getSuburb(),
                        'recipient_name'=> $recipient_name,
                        'notes' => $notes,
                        'recipient_contact' => $recipient_contact,
                        'deliverycost' => $deliveryfee,
                        'totalcost' => $totalprice
                    ],
                    'customer_email' => Application::$app->user->getEmail(),
                    'line_items' => $arr,
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
        $this->setLayout('empty');
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
                break;

            case 'checkout.session.expired':
                $checkoutSession = $event->data->object;
                $userid = $checkoutSession->metadata->userid;
                $this->cancelOrder($userid);
                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }
        http_response_code(200);

    }

    public function checkStock($user){
        $sql="UPDATE temporarycart tc JOIN shopitem si ON si.ItemID=tc.ItemID AND si.ShopID=tc.ShopID SET tc.Purchased=1 WHERE tc.CustomerID=:user AND (si.Stock-tc.Quantity) > 0";
        $result = Application::$app->db->pdo->prepare($sql);
        $result->bindValue(":user",$user);
        $result->execute();
        $sql ="SELECT tc.ItemID,tc.ShopID,tc.Quantity,si.UnitPrice,it.ItemImage,it.Name from `temporarycart` tc INNER JOIN `shopitem` si ON tc.ItemID = si.ItemID AND si.ShopID=tc.ShopID INNER JOIN `item` it ON it.ItemID=tc.ItemID WHERE tc.CustomerID=:user";
        $result = Application::$app->db->pdo->prepare($sql);
        $result->bindValue(":user",$user);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fullfillOrder($obj)
    {
        $customerid = filter_var($obj->metadata->userid,FILTER_SANITIZE_NUMBER_INT);
        $notes=filter_var($obj->metadata->notes,FILTER_SANITIZE_SPECIAL_CHARS);
        $rec_name=filter_var($obj->metadata->recipient_name,FILTER_SANITIZE_SPECIAL_CHARS);
        $city=filter_var($obj->metadata->city,FILTER_SANITIZE_NUMBER_INT);
        $suburb=filter_var($obj->metadata->suburb,FILTER_SANITIZE_NUMBER_INT);
        $rec_contact=filter_var($obj->metadata->recipient_contact,FILTER_SANITIZE_NUMBER_INT);
        $delivery_fee=filter_var($obj->metadata->deliverycost,FILTER_SANITIZE_NUMBER_FLOAT);
        $totalcost=filter_var($obj->metadata->totalcost,FILTER_SANITIZE_NUMBER_FLOAT);
        $pdo=Application::$app->db->pdo;


        $customer = Customer::findOne(['CustomerID' => $customerid]);


            try{
                if($customer){
                    $sql="INSERT INTO `cart` (CustomerID,Date,Time) VALUES (:id,CURRENT_DATE,CURRENT_TIME);";
                    $result = $pdo->prepare($sql);
                    $result->bindValue(":id",$customerid);
                    $result->execute();
                    $cartid= $pdo->lastInsertId();

                    $sql="INSERT INTO `orders` (CartID,RecipientName,Note,RecipientContact,DeliveryCost,TotalCost,City,Suburb,Status) VALUES (:cartid,:rec_name,:notes,:rec_contact,:delivery_fee,:totalcost,:city,:suburb,0);";
                    $result = $pdo->prepare($sql);
                    $result->bindValue(":cartid",$cartid);
                    $result->bindValue(":rec_name",$rec_name);
                    $result->bindValue(":notes",$notes);
                    $result->bindValue(":rec_contact",$rec_contact);
                    $result->bindValue(":delivery_fee",$delivery_fee);
                    $result->bindValue(":totalcost",$totalcost);
                    $result->bindValue(":city",$city);
                    $result->bindValue(":suburb",$suburb);
                    $result->execute();

                    $orderid=$pdo->lastInsertId();

                    $sql="INSERT INTO `ordercart` (CartID,ShopID,ItemID,Quantity,Total) SELECT :cartid AS CartID,tc.ShopID,tc.ItemID,tc.Quantity,(si.UnitPrice*tc.Quantity) AS Total from `temporarycart` AS tc INNER JOIN `shopitem`AS si ON si.ShopID=tc.ShopID AND tc.ItemID=si.ItemID WHERE tc.Purchased=1 AND tc.CustomerID=:customerid;";
                    $result = $pdo->prepare($sql);
                    $result->bindValue(":cartid",$cartid);
                    $result->bindValue(":customerid",$customerid);
                    $result->execute();

                    $sql="INSERT INTO `shoporder` (ShopID,CartID,ShopTotal,Status) SELECT  tc.ShopID,:cartid AS CartID,SUM(si.UnitPrice*tc.Quantity), 0 AS Status from `temporarycart` AS tc INNER JOIN `shopitem`AS si ON si.ShopID=tc.ShopID AND si.ItemID=tc.ItemID WHERE tc.Purchased=1 AND tc.CustomerID=:customerid GROUP BY tc.ShopID;";
                    $result = $pdo->prepare($sql);
                    $result->bindValue(":cartid",$cartid);
                    $result->bindValue(":customerid",$customerid);
                    $result->execute();

                    $sql ="INSERT INTO `payment` (OrderID,TotalPrice) VALUES (:orderid,:totalcost);";
                    $result = $pdo->prepare($sql);
                    $result->bindValue(":orderid",$orderid);
                    $result->bindValue(":totalcost",$totalcost);
                    $result->execute();

                    $sql ="UPDATE `shopitem` si JOIN temporarycart tc ON tc.ItemID=si.ItemID AND tc.ShopID=si.ShopID SET si.Stock=(si.Stock-tc.Quantity) WHERE tc.CustomerID=:customerid AND (si.Stock-tc.Quantity) > 0 AND tc.Purchased=1;";
                    $result = $pdo->prepare($sql);
                    $result->bindValue(":customerid",$customerid);
                    $result->execute();

                    $sql="DELETE FROM `temporarycart` WHERE `temporarycart`.`Purchased`=1 AND `temporarycart`.`CustomerID`=:customerid;";
                    $result = $pdo->prepare($sql);
                    $result->bindValue(":customerid",$customerid);
                    $result->execute();
                }

                }catch (\PDOException $pdoex){
                Application::$app->logger->debug($pdoex);
            }

    }

    public function cancelOrder($user){
        $sql="UPDATE temporarycart tc SET tc.Purchased=0 WHERE tc.CustomerID=:user;";
        $result = Application::$app->db->pdo->prepare($sql);
        $result->bindValue(":user",$user);
        $result->execute();
    }



}