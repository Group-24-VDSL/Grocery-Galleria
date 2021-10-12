<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Shop;

class ShopController extends Controller
{

    public function showShop()
    {
        $this->setLayout('shop');
        return $this->render('shop');
    }

    public function productOverview(){
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/core-products');
    }

    public function shopRegister(Request $request)
    {
        $this->setLayout('register');

        $user = new Shop(); // Create customer
        $user->loadData($request->getBody());
        if ($request->isPost()) {
            $userid = AuthController::register($request,'Shop');
            if($userid){
                $user->ShopID = $userid; //save the UserID = ShopID
                if($user->validate() && $user->save()){
                    Application::$app->session->setFlash('success', 'Registration Success');
                    Application::$app->response->redirect('/login');
                }else{
                    Application::$app->session->setFlash('danger', 'Registration Failed');
                    $this->setLayout('register');
                    return $this->render("shop/register", ['model' => $user]);
                }
            }else {
                Application::$app->session->setFlash('danger', 'Registration Failed');
                $this->setLayout('register');
                return $this->render("shop/register", ['model' => $user]);
            }
        }
        return $this->render("shop/register", [
            'model' => $user
        ]);
    }
}
    


