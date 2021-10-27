<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\controllers\APIController;
use app\core\Request;
use app\models\Item;
use app\models\Shop;
use app\models\ShopItem;
use SendGrid\Mail\TypeException;

class ShopController extends Controller
{

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

    public function productOverview(Request $request){
        $item = new Item();
        $this->setLayout("dashboardL-shop");

        if($request->isPost()){
            $item->loadData($request->getBody());

            if($item->validate() && $item->update()){
                Application::$app->session->setFlash("success", "Item Updated Successfully.");
                Application::$app->response->redirect("/dashboard/shop/products");
            }else{
                Application::$app->session->setFlash("warning", "Validation Failed.");
                return $this->render("shop/core-products"
                    ,[
                        'model' => $item
                    ]);
            }
        }
        return $this->render("shop/core-products"
            ,[
                'model' => $item
            ]);
    }

    public function additem(Request $request){

        $shopItem =new ShopItem();
        $this->setLayout('dashboardL-shop');
        if($request->isPost()){
            $shopItem->loadData($request->getBody());
            if($request->getBody()['Unit'] == "Kg"){
                $stock = $shopItem->Stock;
                $stock = $stock*1000;
                $shopItem->Stock = $stock;
            }
                if($shopItem->validate() && $shopItem->save()){
                    Application::$app->session->setFlash("success", "Item Saved.");
                    Application::$app->response->redirect("/dashboard/shop/additem");
                }else{
                    Application::$app->session->setFlash("warning", "Validation Failed.");
                    return $this->render("shop/add-item"
                        ,[
                            'model' => $shopItem
                        ]);
                }
            }
        return $this->render('shop/add-item',[
            'model' => $shopItem
        ]);
    }

    public function vieworders(){
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/view-orders');
    }

    public function vieworderdetails(){
        $this->setLayout('headeronly-staff');
        return $this->render('shop/view-order-details');
    }

    public function viewcompleteorder(){
        $this->setLayout('headeronly-staff');
        return $this->render('shop/view-completed-order');
    }


    /**
     * @throws TypeException
     */
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
}
    


