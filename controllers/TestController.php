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
//    public function test(Request $request){
//
//        $this->setLayout('headeronly-staff');
//
//        $ShopID = $request ->getBody()["ShopID"];
//        $CartID = $request ->getBody()["CartID"];
//
//        $shoporder = ShopOrder ::findOne([ "ShopID" => $ShopID ,"CartID" => $CartID]);
//
//        $ShopTotal = $shoporder->ShopTotal ;
//
//
//        $cartitems = OrderCart ::findAll([ "ShopID" => $ShopID ,"CartID" => $CartID]);
//
//        $shopitems = [];
//        $i = 0 ;
//        $itemprice = [] ;
//
//        foreach($cartitems as $cartitem){
//            $shopitem = ShopItem::findOne(['ItemID'=>$cartitem->ItemID,'ShopID'=>$cartitem->ShopID]);
//            $item = Item::findOne(['ItemID'=>$cartitem->ItemID]);
//
//            $shopitems[$cartitem->ShopID][$cartitem->ItemID]=[$shopitem,$item];
//
//        }
//
//        //return $this->render('shop/view-order-details',['shoporder'=>$shopitem]);
//
//        //print_r($request -> getBody());
//    }

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




    public function t(Request $request)

    {
//        var_dump($request);
        // get logged staff ID
        $shop = new Shop();
        $newObj = new Shop();
        $user = new User();


        $this->setLayout("dashboardL-shop");

        $shop = $shop->findOne(['ShopID' => Application::getUserID()]);
        $user = $user->findOne(['UserID' => Application::getUserID()]);


        if ($request->isPost()) {
            $newObj->loadData($request->getBody());
            $newObj->ShopID = Application::getUserID();
            $newObj->Category = $shop->Category;
            $newObj->Address = $shop->Address;
            $newObj->City = $shop->City;
            $newObj->Suburb = $shop->Suburb;
            $newObj->Location = $shop->Location;
            $newObj->PlaceID = $shop->PlaceID ;

            if ($newObj->validate('update') && $newObj->update()) {
                $newObj->callProcedure('email_Update', ['UserID'=>$newObj->ShopID,'Email'=> $newObj->Email]);
                Application::$app->session->setFlash('success','Update Success');
                Application::$app->response->redirect('/dashboard/shop/profilesetting');
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

    public function test(Request $request)
    {// get logged staff ID
        $shop = new Shop();
        $user = new User();
        $this->setLayout("dashboardL-shop");
//        $user = $user->findOne(['UserID' => Application::getUserID()]);
//        if ($request->isPost()) {
//            $success = false;{
//                $user->loadData($request->getBody());
//                $user->loadData($request->getBody());
//                var_dump("cccc");
//                if ($user->validate('update') && $user->update()) {
//                    Application::$app->session->setFlash('success', 'Update Success');
//                }else{
//                    Application::$app->session->setFlash('danger', 'Update Failed');
////                    Application::$app->response->redirect('shop/shop-profile-setting');
//                    $this->setLayout("dashboardL-shop");
//                    return $this->render("shop/shop-profile-setting", [
//                        'model' => $shop,
//                        'loginmodel' => $user
//                    ]);
//                }
//            }
//        }
        $this->setLayout("dashboardL-shop");
        return $this->render("shop/shop-profile-setting", [
            'model' => $shop,
            'loginmodel' => $user
        ]);
    }

    public function abc(Request $request, Response $response)
    {
        $json = $request->getJson();
        var_dump("in password");
        if ($json) {
            var_dump("in password");
            $tempuser = new User();
            $tempuser->loadData($json);

            $checktemp = User::findOne(["UserID" => Application::getUserID()]);


            $currenPwdHash =  password_hash($json["OldPwd"],PASSWORD_BCRYPT);



            if ($request->isPost()) {
                if (strlen($json["OldPwd"]) == 0) {
                    return $response->json('{"success":"currentRequire"}');
                } elseif (strlen($json["NewPwd"]) == 0) {
                    return $response->json('{"success":"newRequire"}');
                } elseif (strlen($json["ConfirmPwd"]) == 0) {
                    return $response->json('{"success":"confirmRequire"}');
                } else {

                    if ($checktemp) { //there exists such user

                        if(password_verify($json["OldPwd"], $checktemp->PasswordHash)){
//
                            if(strlen($json["NewPwd"])>=8) {
                                if ($json["NewPwd"] === $json["ConfirmPwd"]) {
                                    $tempuser = $checktemp ;
                                    $tempuser->PasswordHash = password_hash($json["NewPwd"] ,PASSWORD_BCRYPT);
                                    if ($tempuser->update()) {
//                                        Application::$app->response->redirect("/test");
                                        return $response->json('{"success":"ok"}');
                                    }


                                } else {
                                    return $response->json('{"success":"newConfirmFail"}');
                                }
                            }
                            else{
                                return $response->json('{"success":"sizeFail"}') ;
                            }

                        }
                        else{
                            return $response->json('{"success":"currentFail"}');
                        }
                    }
                    return $response->json('{"success":"fail"}');

                }
            }elseif($request->isPatch()) {

            }

//            if(password_verify($json["OldPwd"],$checktemp->PasswordHash)){
//                if(strlen($json["NewPwd"])>=8) {
//                    if (password_verify($json["NewPwd"], $json["ConfirmPwd"])) {
//
//
//                    } else {
//                        return $response->json('{"success":"newConfirmFail"}');
//                    }
//                }
//                else{
//                    return $response->json('{"success":"sizeFail"}') ;
//                }
//
//            }
//            else{
//                return $response->json('{"success":"currentFail"}');
//            }
//
//            var_dump($checktemp->PasswordHash);


//            if ($request->isPost()) {
//                if ($checktemp) { //there exists such item
//                    if ($tempuser->validate('update') && $tempuser->update()) {
//                        return $response->json('{"success1":"ok"}');
//                    }
//                }
//                return $response->json('{"success2":"fail"}');
//
//            } elseif($request->isPatch()) {
//                if ($checktemp) { //there exists such item
////                    Application::$app->logger->debug("iiiii");
//                    if ($tempuser->validate('update') && $tempuser->update()) {
//                        Application::$app->response->redirect("/test");
//                        return $response->json('{"success":"ok"}');
//
//                    }
//
//                }
//                return $response->json('{"success4":"fail1"}');
//
//            }
        }
        return $response->json('{"success5":"fail"}');
    }


    public function safetystock(Request $request, Response $response)
    {
        $newObj = new ShopItem();
        $json = $request->getJson();
        $itemID = (int)$request->getJson()['ItemID'] ;
        $shopID = (int)$request->getJson()['ShopID'];

       $result = DBModel:: returnProcedure('stockManage',$itemID,$shopID);

        if ($json) {
            if ($request->isPost()) {
                return $response->json($result);
            }
            elseif($request->isPatch()) {

            }

//            if(password_verify($json["OldPwd"],$checktemp->PasswordHash)){
//                if(strlen($json["NewPwd"])>=8) {
//                    if (password_verify($json["NewPwd"], $json["ConfirmPwd"])) {
//
//
//                    } else {
//                        return $response->json('{"success":"newConfirmFail"}');
//                    }
//                }
//                else{
//                    return $response->json('{"success":"sizeFail"}') ;
//                }
//
//            }
//            else{
//                return $response->json('{"success":"currentFail"}');
//            }
//
//            var_dump($checktemp->PasswordHash);


//            if ($request->isPost()) {
//                if ($checktemp) { //there exists such item
//                    if ($tempuser->validate('update') && $tempuser->update()) {
//                        return $response->json('{"success1":"ok"}');
//                    }
//                }
//                return $response->json('{"success2":"fail"}');
//
//            } elseif($request->isPatch()) {
//                if ($checktemp) { //there exists such item
////                    Application::$app->logger->debug("iiiii");
//                    if ($tempuser->validate('update') && $tempuser->update()) {
//                        Application::$app->response->redirect("/test");
//                        return $response->json('{"success":"ok"}');
//
//                    }
//
//                }
//                return $response->json('{"success4":"fail1"}');
//
//            }
        }
        return $response->json($result);
    }

    public function shopcards(Request $request, Response $response)
    {

        $shopID = 5;
//        var_dump($shopID);
        $json = $request->getJson();
//        var_dump($json);


        $result = DBModel:: returnProcedure('shop_Summary', $shopID, 1);
        return $response->json($result);

//        if ($json) {
//            var_dump("im in jason");
//        }
//            if ($request->isPost()) {
//                return $response->json($result);
//            } elseif ($request->isPatch()) {
//
//
////        $shopID = Application::getUserID();
//
//
//            var_dump($result);
//            return $response->json($result);
//
//        }
    }


        public function temp(){
            $this->setLayout('dashboardL-shop');
            return $this->render('shop/shop-profile-setting');
    }
}