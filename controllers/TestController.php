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

        $this->setLayout('headeronly-staff');

        $ShopID = $request ->getBody()["ShopID"];
        $CartID = $request ->getBody()["CartID"];

        $shoporder = ShopOrder ::findOne([ "ShopID" => $ShopID ,"CartID" => $CartID]);

        $ShopTotal = $shoporder->ShopTotal ;


        $cartitems = OrderCart ::findAll([ "ShopID" => $ShopID ,"CartID" => $CartID]);

        $shopitems = [];
        $i = 0 ;
        $itemprice = [] ;

        foreach($cartitems as $cartitem){
            $shopitem = ShopItem::findOne(['ItemID'=>$cartitem->ItemID,'ShopID'=>$cartitem->ShopID]);
            $item = Item::findOne(['ItemID'=>$cartitem->ItemID]);

            $shopitems[$cartitem->ShopID][$cartitem->ItemID]=[$shopitem,$item];

        }

        //return $this->render('shop/view-order-details',['shoporder'=>$shopitem]);

        //print_r($request -> getBody());
    }

    public function updateOngoingShopItem(Request $request, Response $response)
    {
        $json = $request->getJson();
        if ($json) {
            $tempshopitem = new ShopItem();
            $tempshopitem->loadData($json);

//            Application::$app->session->setFlash("success", "hi1" );
            $checktemp = ShopItem::findOne(["ItemID" => $tempshopitem->ItemID, "ShopID" => $tempshopitem->ShopID]);
            if ($request->isPost()) {
                if ($checktemp) { //there exists such item

                    if ($tempshopitem->validate('update') && $tempshopitem->update()) {
                        return $response->json('{"success":"ok"}');
                    }
                }

//                else {
//                    if ($tempshopitem->validate() && $tempshopitem->save()) {
//                        return json_encode('{"success":"ok"}');
//                    }
//                }

                return $response->json('{"success":"fail"}');

            } elseif($request->isPatch()) {
//                var_dump($tempshopitem);
                $tempshopitem->loadData($checktemp);
//                Application::$app->session->setFlash("success", "aaa" );
//                Application::$app->session->setFlash("success", var_dump($tempshopitem) );
                if ($checktemp) { //there exists such item
                    $tempshopitem->loadData($checktemp);
//                    $tempshopitem->Quantity = $json['Quantity'];
//                    Application::$app->session->setFlash("success", var_dump($tempshopitem) );
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

//        var_dump($ShopCount);
//        var_dump($OrderID);

        $order = Orders::findOne(["OrderID" => $OrderID]);
//        var_dump($order);
        $CustomerID = $order->CustomerID;
        $customer = Customer::findOne(["CustomerID" => $CustomerID]);

        $carts = OrderCart::findAll(["CartID" => $order->CartID]);
        $shopOrders = ShopOrder::findAll(["CartID" => $order->CartID]);


        $shops = [];

        foreach ($shopOrders as $shopOrder) {
            $ItemsArray = [];
            $itemList = [];
            $shopWeight = 0;
//            var_dump($shopOrder);


            $shop = Shop::findOne(["ShopID" => $shopOrder->ShopID]);

            $i = 0;
            $orderCarts = OrderCart::findAll(["ShopID" => $shopOrder->ShopID, "CartID" => $order->CartID]);

            foreach ($orderCarts as $cart) {
//                var_dump($cart->ItemID);

                $shopItem = ShopItem::findOne(["ItemID" => $cart->ItemID]);
                $systemItem = Item::findOne(["ItemID" => $cart->ItemID]);

//                $itemList[$i] = ["shopItem"=>$shopItem, "systemItem"=>$systemItem];


                array_push($itemList, ["shopItem" => $shopItem, "systemItem" => $systemItem , "quantity" => $cart->Quantity]);

                $shopWeight = ($cart->Quantity * $systemItem->UWeight) / 1000;
//                var_dump($shopItem);

            }

            $ItemsArray[] = $itemList;
            $i += 1;


            $shops[$shopOrder->ShopID] = ["shop" => $shop, "shopOrder" => $shopOrder, "itemList" => $ItemsArray, "shopWeight" => $shopWeight];
        }


        return $this->render('staff/view-orders-details',
            ['order' => $order, 'customer' => $customer, 'shops' => $shops]);


    }
    public function profilesettings(Request $request)
    {
        // get logged staff ID
        $shop = new Shop();
        $newObj = new Shop();
        $user = new User();

        $this->setLayout("dashboardL-shop");

        $shop = $shop->findOne(['ShopID' => 3]);
        $user = $user->findOne(['UserID' => 3]);

        $aa = ShopOrder::findCount("CartID","Date",['ShopID'=>1],"date_format(Date, '%M')",30);
//        $aa = DBModel::query("SELECT COUNT(CartID) FROM shoporder WHERE ShopID =1 GROUP BY DATE ",\PDO::FETCH_COLUMN);



        var_dump($aa);

        if ($request->isPost()) {
            $newObj->loadData($request->getBody());
//            var_dump($newObj);
//            $newObj->StaffID = Application::getCustomerID(); // get session id
            $newObj->ShopID = 3;
            $newObj->Category = $shop->Category;
            $newObj->Address = $shop->Address;
            $newObj->City = $shop->City;
            $newObj->Suburb = $shop->Suburb;
            $newObj->Location = $shop->Location;
            $newObj->PlaceID = $shop->PlaceID ;
//            $newObj->Password = "88" ;
//            $newObj->ConfirmPassword = "88" ;
            var_dump($newObj->ShopID);
            var_dump($newObj);
            if ($newObj->validate('update') && $newObj->update()) {
                $newObj->singleProcedure('email_Update', 3, $newObj->Email);
                Application::$app->session->setFlash('success','Update Success');
                Application::$app->response->redirect('/dashboard/shop/profilesettings');
            }

            else {
                Application::$app->session->setFlash('danger', 'Update Failed');
                $this->setLayout("dashboardL-shop");
                return $this->render("shop/shop-profile-setting", [
                    'model' => $newObj,
                    'loginmodel' => $user
                ]);
            }
        }
        return $this->render("shop/shop-profile-setting", [
            'model' => $shop,
            'loginmodel' => $user
        ]);
    }

    public function profileUpdate(Request $request)
    {// get logged staff ID
        $staff = new Shop();
        $user = new User();
        $user = $user->findOne(['UserID' => 3]);
        if ($request->isPost()) {
            $success = false;{
                $user->loadData($request->getBody());
                $user->loadData($request->getBody());
                if ($user->validate('update') && $user->update()) {
                    Application::$app->session->setFlash('success', 'Update Success');
                }else{
                    Application::$app->session->setFlash('danger', 'Update Failed');
                    Application::$app->response->redirect('shop/shop-profile-setting');
                    $this->setLayout("dashboardL-shop");
                    return $this->render("shop/shop-profile-setting", [
                        'model' => $staff,
                        'loginmodel' => $user
                    ]);
                }
            }
        }
        $this->setLayout("dashboardL-shop");
        return $this->render("shop/shop-profile-setting", [
            'model' => $staff,
            'loginmodel' => $user
        ]);
    }


}