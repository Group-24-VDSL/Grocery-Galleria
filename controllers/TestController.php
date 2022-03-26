<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\Response;
use app\models\Customer;
use app\models\OrderCart;
use app\core\Request;
use app\models\Orders;
use app\models\Shop;
use app\models\ShopOrder;
use app\models\Staff;
use app\models\User;
use app\models\Verification;
use app\models\ShopItem;
use app\models\Item;

class TestController extends Controller
{

    public function test(Request $request){
        echo Application::getUserID();
    }




    // bellow functions are shop related test functions

    public function updateOngoingShopItem(Request $request, Response $response)
    {
        $json = $request->getJson();
        if ($json) {
            $tempshopitem = new ShopItem();
            $tempshopitem->loadData($json);

            $checktemp = ShopItem::findOne(["ItemID" => $tempshopitem->ItemID, "ShopID" => $tempshopitem->ShopID]);
            if ($request->isPost()) {
                if ($checktemp) { //there exists such item

                    if ($tempshopitem->validate('update') && $tempshopitem->update()) {
                        return $response->json('{"success":"ok"}');
                    }
                }
                return $response->json('{"success":"fail"}');

            } elseif($request->isPatch()) {
                $tempshopitem->loadData($checktemp);
                if ($checktemp) { //there exists such item
                    $tempshopitem->loadData($checktemp);
                    if ($tempshopitem>validate('update') && $tempshopitem->update()) {
                        return $response->json('{"success":"ok"}');
                    }
                }
            }
        }
        return $response->json('{"success":"fail"}');
    }

    public function vieworderdetails(Request $request)
    {
        $this->setLayout('headeronly-staff');
        $OrderID = $request->getBody()["OrderID"];
        $ShopCount = $request->getBody()["ShopCount"];
        $order = Orders::findOne(["OrderID" => $OrderID]);
        $CustomerID = $order->CustomerID;
        $customer = Customer::findOne(["CustomerID" => $CustomerID]);
        $carts = OrderCart::findAll(["CartID" => $order->CartID]);
        $shopOrders = ShopOrder::findAll(["CartID" => $order->CartID]);
        $shops = [];

        foreach ($shopOrders as $shopOrder) {
            $ItemsArray = [];
            $itemList = [];
            $shopWeight = 0;
            $shop = Shop::findOne(["ShopID" => $shopOrder->ShopID]);
            $i = 0;
            $orderCarts = OrderCart::findAll(["ShopID" => $shopOrder->ShopID, "CartID" => $order->CartID]);
            foreach ($orderCarts as $cart) {
                $shopItem = ShopItem::findOne(["ItemID" => $cart->ItemID]);
                $systemItem = Item::findOne(["ItemID" => $cart->ItemID]);
                array_push($itemList, ["shopItem" => $shopItem, "systemItem" => $systemItem , "quantity" => $cart->Quantity]);
                $shopWeight = ($cart->Quantity * $systemItem->UWeight) / 1000;
            }
            $ItemsArray[] = $itemList;
            $i += 1;
            $shops[$shopOrder->ShopID] = ["shop" => $shop, "shopOrder" => $shopOrder, "itemList" => $ItemsArray, "shopWeight" => $shopWeight];
        }
        return $this->render('staff/view-orders-details',
            ['order' => $order, 'customer' => $customer, 'shops' => $shops]);
    }







    public function safetystock(Request $request, Response $response)
    {
        $json = $request->getJson();

        $itemID = (int)$request->getJson()['ItemID'] ;
        $shopID = (int)$request->getJson()['ShopID'];


       $result = DBModel:: returnProcedure('stockManage',$itemID,$shopID);

        if ($json) {
            if ($request->isPost()) {
                    return $response->json($result);
            }elseif($request->isPatch()) {

            }

        }
        return $response->json($result);
    }

    public function shopcards(Request $request, Response $response)
    {

        $shopID = 5;

        $json = $request->getJson();

        $result = DBModel:: returnProcedure('shop_Summary', $shopID, 1);
        return $response->json($result);

    }

}