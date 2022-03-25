<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\controllers\APIController;
use app\core\db\DBModel;
use app\core\Request;
use app\core\Response;
use app\models\Delivery;
use app\models\Item;
use app\models\OrderCart;
use app\models\Shop;
use app\models\ShopItem;
use app\models\ShopOrder;
use app\models\Staff;
use app\models\TemporaryCart;
use app\models\User;
use SendGrid\Mail\TypeException;
/**
 * @throws TypeException
 */

/**
 * @throws TypeException
 */

class ShopController extends Controller
{
    public function shopRegister(Request $request)
    {
        $this->setLayout('register');
        $user = new Shop(); // Create customer
        $user->loadData($request->getBody());
        if ($request->isPost()) {
            $userid = AuthController::register($request,'Shop');
            if($userid){
                $user->ShopID = $userid; //save the ShopID = UserID
                if($user->validate() && $user->save()){
                    Application::$app->session->setFlash('success', 'Registration Success');
                    $status = AuthController::verificationSend($user->ShopID,$user->Name,$user->Email);
                    if($status){
                    Application::$app->response->redirect('/login');
                    }
                }else{
                    Application::$app->session->setFlash('error', 'Registration Failed');
                    $this->setLayout('register');
                    return $this->render("shop/register", ['model' => $user]);
                }
            }else {
                Application::$app->session->setFlash('error', 'Registration Failed');
                $this->setLayout('register');
                return $this->render("shop/register", ['model' => $user]);
            }
        }
        return $this->render("shop/register", [
            'model' => $user
        ]);
    }

    public function showShop()
    {
        $this->setLayout('shop');
        return $this->render('shop');
    }

    public function shopGallery()
    {
        $this->setLayout('gallery');
        return $this->render('gallery');
    }

    public function productOverview(Request $request)
    {
        $item = new ShopItem();
        $this->setLayout("dashboardL-shop");


        if ($request->isPost()) {
            $item->loadData($request->getBody());

            $itemID = $item->ItemID ;

            $tempItem = Item::findOne(["ItemID"=>$itemID]);

            if ($tempItem->Unit == 0 || $tempItem->Unit ==1){
                $item->Stock = $item->Stock*1000 ;
            }

//            Application::$app->logger->debug($item->loadData($request->getBody()));

            if ($item->validate() && $item->update()) {
                Application::$app->session->setFlash("success", "Item Updated Successfully.");
                Application::$app->response->redirect("/dashboard/shop/products");
            } else {
                Application::$app->session->setFlash("warning", "Validation Failed.");
                return $this->render("shop/core-products"
                    , [
                        'model' => $item
                    ]);
            }
        }
        return $this->render("shop/core-products"
            , [
                'model' => $item
            ]);
    }


    public function shopOrderAnalytics(Request $request,Response $response){
        $response->setContentTypeJSON();

        $shopID =   Application::getUserID()  ;
        $yms = array();
        $now = date('Y-m-d');
        for($x = 13; $x >= 1; $x--) {
            $ym = date('Y M', strtotime($now . " -$x month"));
            $year = date('Y', strtotime($now . " -$x month"));
            $month = date('m', strtotime($now . " -$x month"));
            $orders = DBModel::query("SELECT COUNT(CartID) AS NumberOfOrders FROM `shoporder` WHERE YEAR (Date) =  ".$year." AND  MONTH (Date)= ".$month." AND ShopID = ".$shopID."  ",\PDO::FETCH_ASSOC,true);
            $yms[$ym] = $orders[0];
        }
//        echo "<pre>";
//        print_r($yms);
//        echo "</pre>";
        return $response->json($yms) ;
    }

    public function getmonthorders(Request $request,Response $response){
        $response->setContentTypeJSON();
        $shopID =   Application::getUserID()  ;
        $yms = array();
        $now = date('Y-m-d');
        for($x = 30 ; $x >= 1; $x--) {
            $ym = date('M d', strtotime($now . " -$x days"));
            $year = date('Y', strtotime($now . " -$x days"));
            $month = date('m', strtotime($now . " -$x days"));
            $day = date('d', strtotime($now . " -$x days"));
            $orders = DBModel::query("SELECT COUNT(CartID) AS NumberOfOrders FROM `shoporder` WHERE YEAR (Date) =  ".$year." AND  MONTH (Date)= ".$month." AND  DAY (Date)= ".$day." AND ShopID = ".$shopID."  ",\PDO::FETCH_ASSOC,true);
            $yms[$ym] = $orders[0];
        }
        return $response->json(array_reverse($yms)) ;
    }

    public function getmonthlyrevenues(Request $request,Response $response){
        $response->setContentTypeJSON();

        $shopID =   Application::getUserID()  ;
        $yms = array();
        $now = date('Y-m-d');
        for($x = 13; $x >= 1; $x--) {
            $ym = date('Y M', strtotime($now . " -$x month"));
            $year = date('Y', strtotime($now . " -$x month"));
            $month = date('m', strtotime($now . " -$x month"));
            $revenue = DBModel::query("SELECT SUM(ShopTotal) AS Total FROM `shoporder` WHERE YEAR (Date) =  ".$year." AND  MONTH (Date)= ".$month." AND ShopID = ".$shopID."  ",\PDO::FETCH_ASSOC,true);
            if($revenue[0] == null){
                $revenue[0] =0 ;
            }
            $yms[$ym] = $revenue[0];
        }
//        echo "<pre>";
//        print_r($yms);
//        echo "</pre>";
        return $response->json(array_reverse($yms)) ;
    }

    public function getmonthrevenues(Request $request,Response $response){
        $response->setContentTypeJSON();
        $shopID =  Application::getUserID() ;
        $yms = array();
        $now = date('Y-m-d');
        for($x = 30 ; $x >= 1; $x--) {
            $ym = date('M d', strtotime($now . " -$x days"));
            $year = date('Y', strtotime($now . " -$x days"));
            $month = date('m', strtotime($now . " -$x days"));
            $day = date('d', strtotime($now . " -$x days"));
            $revenue = DBModel::query("SELECT SUM(ShopTotal) AS Total FROM `shoporder` WHERE YEAR (Date) =  ".$year." AND  MONTH (Date)= ".$month." AND  DAY (Date)= ".$day." AND ShopID = ".$shopID."  ",\PDO::FETCH_ASSOC,true);
            if($revenue[0] == null){
                $revenue[0] =0 ;
            }
            $yms[$ym] = $revenue[0];
        }
        return $response->json(array_reverse($yms)) ;
    }

    public function getShopItemList(Request $request,Response $response){
        $response->setContentTypeJSON();

        $shopID =  Application::getUserID() ;

        $itemdetails = array();

        $shopitems = DBModel::query("SELECT ItemID  From shopitem WHERE  ShopID = ".$shopID." ",\PDO::FETCH_ASSOC,true);

//        echo $shopitems[0]["ItemID"] ;

        $q = DBModel::query("SELECT ItemID,ShopID  From shopitemsales WHERE  ShopID = ".$shopID." ",\PDO::FETCH_ASSOC,true);


        foreach ($shopitems as $item){

            $itemID =  $item["ItemID"] ;

            $item = DBModel::query("SELECT ItemID, Name,ItemImage From item WHERE  ItemID = ".$itemID." ",\PDO::FETCH_OBJ,true);

            array_push($itemdetails,$item);
        }


        return json_encode($itemdetails);

    }

    public function getsales(Request $request,Response $response){

        $response->setContentTypeJSON();

        $shopID =  Application::getUserID() ;
        $itemID = $request->getBody()["ItemID"] ;
        $yms = array();

        $now = date('Y-m-d');
        for($x = 13; $x >= 1; $x--) {
            $ym = date('Y M', strtotime($now . " -$x month"));
            $year = date('Y', strtotime($now . " -$x month"));
            $month = date('m', strtotime($now . " -$x month"));
            $sales = DBModel::query("SELECT SUM(Quantity) AS sales FROM `shopitemsales` WHERE YEAR (Date) =  ".$year." AND  MONTH (Date)= ".$month." AND ShopID = ".$shopID." AND ItemID = ".$itemID."  ",\PDO::FETCH_ASSOC,true);
            $yms[$ym] = $sales[0];
        }

        return $response->json($yms) ;
    }

    public function additem(Request $request){
        $shopItem = new ShopItem();
        $shopItem->ShopID = Application::getUserID() ;

        $this->setLayout('dashboardL-shop');

        if ($request->isPost()) {
            $shopItem->loadData($request->getBody());
            if ($request->getBody()['Unit'] == "g") {
                $stock = $shopItem->Stock ;
                $stock = $stock * 1000 ;
                $shopItem->Stock = $stock ;
            }

            if ($shopItem->validate() && $shopItem->save()) {
                Application::$app->session->setFlash("success", "Item Saved.");
                Application::$app->response->redirect("/dashboard/shop/additem");
            } else {
                Application::$app->session->setFlash("warning", "Validation Failed.");
                return $this->render("shop/add-item"
                    , [
                        'model' => $shopItem
                    ]);
            }
        }
        return $this->render('shop/add-item', [
            'model' => $shopItem
        ]);
    }

    public function vieworders()
    {
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/view-orders');
    }

    public function vieworderdetails(Request $request)
    {
        $shoporder = new ShopOrder();
        $this->setLayout('headeronly-staff');

        $ShopID = $request->getBody()["ShopID"];
        $CartID = $request->getBody()["CartID"];

        $shoporder = ShopOrder::findOne(["ShopID" => $ShopID, "CartID" => $CartID]);
        $cartitems = OrderCart::findAll(["ShopID" => $ShopID, "CartID" => $CartID]);
        $shopitems = [];

        foreach ($cartitems as $cartitem) {
            $shopitem = ShopItem::findOne(['ItemID' => $cartitem->ItemID, 'ShopID' => $cartitem->ShopID]);
            $item = Item::findOne(['ItemID' => $cartitem->ItemID]);
            $shopitems[$cartitem->ShopID][$cartitem->ItemID] = [$shopitem, $item];
        }

        return $this->render('shop/view-order-details', ['shoporder' => $shoporder, 'cartitems' => $cartitems, 'shopitem' => $shopitems, 'model' => $shoporder]);
    }

    public function updateStatus(Request $request)
    {
        $this->setLayout("dashboardL-shop");
        $orderUpdated = new ShopOrder();


        if ($request->isPost()) {
            $orderUpdated->loadData($request->getBody());

            $ShopID = $orderUpdated->ShopID;
            $CartID = $orderUpdated->CartID;
            $orderUpdated = ShopOrder::findOne(['ShopID' => $ShopID, 'CartID' => $CartID]);

            $orderUpdated->Status = 1 ;
            $orderUpdated->CompleteDate = date("Y-m-d");

            if ($orderUpdated->validate('update') && $orderUpdated->update()) {

                Application::$app->session->setFlash("success", "Order is Successfully Completed.");
                Application::$app->response->redirect("#");
            } else {
                Application::$app->session->setFlash("warning", "Order is not Successfully Complete.");
                return $this->render("shop/view-orders"
                    , [
                        'model' => $orderUpdated
                    ]);
            }
        }
        return $this->render("shop/view-orders"
            , [
                'model' => $orderUpdated
            ]);
    }


    public function viewitems()
    {
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/view-items');
    }


    public function viewcompleteorder(){
        $this->setLayout('headeronly-staff');
        return $this->render('shop/view-completed-order');
    }



    public function itemsales(Request $request)
    {

//        $user = new Shop;
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/sales-analytics');
    }

    public function shopincome(Request $request)
    {
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/shop-analytics');
    }
    // Shop section
    public function getShop(Request $request, Response $response) // get shop details from DB
    {
        $response->setContentTypeJSON();
        $shop = Shop::findOne(['ShopID'=>$request->getBody()["ShopID"],'City'=>Application::getCity(),'Suburb'=>Application::getSuburb()]);
        return json_encode($shop);
    }


    public function getAllShop(Request $request,Response $response)
    {
        $response->setContentTypeJSON();
        $shops = Shop::findAll(['Category'=>$request->getBody()["Category"],'City'=>Application::getCity(),'Suburb'=>Application::getSuburb()]);
        return json_encode($shops);


    }

    


    public function updateItem(Request $request)
    {
        $itemUpdated = new ShopItem();
        $this->setLayout("dashboardL-shop");

        if ($request->isPost()) {
            $itemUpdated->loadData($request->getBody());

            $itemUpdated->Stock*1000 ;

            if ($itemUpdated->validate('update') && $itemUpdated->update()) {
                Application::$app->session->setFlash("success", "Item update is success" );
//                Application::$app->response->redirect("/dashboard/shop/products");
            } else {
                Application::$app->session->setFlash("warning", "Validation Failed.");
                return $this->render("shop/core-products"
                    , [
                        'model' => $itemUpdated
                    ]);
            }
        }
        return $this->render("shop/core-products"
            , [
                'model' => $itemUpdated
            ]);
    }



    public function updateOngoingShopItem(Request $request, Response $response)
    {
        $json = $request->getJson();
        Application::$app->logger->debug('ikik');
        if ($json) {
            $tempshopitem = new ShopItem();
            $tempshopitem->loadData($json);

            $checktemp = ShopItem::findOne(["ItemID" => $tempshopitem->ItemID, "ShopID" => $tempshopitem->ShopID]);
            $checktemp->Stock = $tempshopitem->Stock ;

            if ($request->isPost()) {
                if ($checktemp) { //there exists such item
                    if ($checktemp->validate('update') && $checktemp->update()) {
                        Application::$app->response->redirect("/dashboard/shop/viewitems");
                        return $response->json('{"success":"ok"}');
                    }
                }
                return $response->json('{"success":"fail"}');

            } elseif($request->isPatch()) {
                if ($checktemp) { //there exists such item
                    if ($tempshopitem->validate('update') && $tempshopitem->update()) {
                        Application::$app->response->redirect("/dashboard/shop/viewitems");
                        return $response->json('{"success":"ok"}');
                    }
                }
                return $response->json('{"success":"fail"}');
            }
        }
        return $response->json('{"success":"fail"}');
    }


    public function profilesettings(Request $request)
    {
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
            $newObj->Password = 123;
            $newObj->ConfirmPassword = 123 ;


            if ($newObj->update() && $newObj->validate('update')){
                    $newObj->singleProcedure('email_Update', $newObj->ShopID, $newObj->Email);
                    Application::$app->session->setFlash('success', 'Update Success');
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

    // shop-change password(garbage)
    public function changepassword(Request $request, Response $response)
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

        }
        return $response->json('{"success5":"fail"}');
    }

    public function safetystock(Request $request, Response $response)
    {
        $json = $request->getJson();

        $itemID = (int)$request->getJson()['ItemID'] ;
        $shopID = (int)$request->getJson()['ShopID'];



        if ($json) {
            if ($request->isPost()) {
                $result = DBModel:: returnProcedure('stockManage',$itemID,$shopID);

                if($result){
                    return $response->json($result);
                }

            }elseif($request->isPatch()) {

            }

        }
    }

    public function shopcards(Request $request, Response $response)
    {
        $shopID = Application::getUserID();

        $json = $request->getJson();

        $result = DBModel:: returnProcedure('shop_Summary', $shopID, 1);
        return $response->json($result);

    }

    public function getShopCategory(Request $request,Response $response)
    {
        $this->setLayout('empty');
        $response->setContentTypeJSON();
        $shop =Shop::findOne(["ShopID" => Application::getUserID()]);
        return json_encode($shop->Category);
    }

    public function getShopID(Request $request,Response $response)
    {
        $this->setLayout('empty');
        $response->setContentTypeJSON();
        return json_encode(Application::getUserID());
    }

}

