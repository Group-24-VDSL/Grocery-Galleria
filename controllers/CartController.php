<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\ShopItem;
use app\models\TemporaryCart;


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
        $shopcount = DBModel::query("SELECT COUNT(DISTINCT `ShopID`) FROM `temporarycart` WHERE CustomerID=".Application::getCustomerID()." AND Purchased=0",\PDO::FETCH_COLUMN);
        $subprice = DBModel::query("SELECT SUM(tc.Quantity*si.UnitPrice) FROM temporarycart AS tc,shopitem AS si WHERE tc.ItemID = si.ItemID AND tc.ShopID = si.ShopID AND tc.CustomerID=".Application::getCustomerID()." AND tc.Purchased=0",\PDO::FETCH_COLUMN);
        $itemcount = DBModel::query("SELECT COUNT(*) FROM temporarycart AS tc,shopitem AS si WHERE tc.ItemID = si.ItemID AND tc.ShopID = si.ShopID AND tc.CustomerID=".Application::getCustomerID()." AND tc.Purchased=0",\PDO::FETCH_COLUMN);
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

    public function getDeliveryFee(int $shopcount)
    {
        return ($shopcount > 1)?160:120;
    }



}