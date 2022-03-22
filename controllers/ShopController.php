<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\controllers\APIController;
use app\core\Request;
use app\core\Response;
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

    public function additem(Request $request)
    {

        $shopItem = new ShopItem();
        $this->setLayout('dashboardL-shop');
        if ($request->isPost()) {
            $shopItem->loadData($request->getBody());
            if ($request->getBody()['Unit'] == "Kg") {
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



    public function updateItem(Request $request)
    {
        $itemUpdated = new ShopItem();
        $this->setLayout("dashboardL-shop");

        if ($request->isPost()) {
            $itemUpdated->loadData($request->getBody());

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
                if ($checktemp) { //there exists such item
//                    Application::$app->logger->debug("iiiii");
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


//            if ($newObj->validate('update') && $newObj->update()) {
            if ($newObj->update() && $newObj->validate('update')){

                    var_dump("im update and validate");
//                    Application::$app->session->setFlash('success', 'validate Success');
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

}

