<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Rider;

class  RiderController extends Controller
{
    public function riderRegister(Request $request)
    {
        $this->setLayout('register');
        $user = new Rider(); // Create rider
        $user->loadData($request->getBody());
        if ($request->isPost()) {
            $userid = AuthController::register($request,'Rider');
            if($userid){
                $user->RiderID = $userid; //save the ShopID = UserID
                if($user->validate() && $user->save()){
                    Application::$app->session->setFlash('success', 'Registration Success');
                    $status = AuthController::verificationSend($user->RiderID,$user->Name,$user->Email);
                    if($status){
                        Application::$app->response->redirect('/login');
                    }
                }else{
                    Application::$app->session->setFlash('error', 'Registration Failed');
                    $this->setLayout('register');
                    return $this->render("rider/register", [
                        'model' => $user
                    ]);
                }
            }else {
                Application::$app->session->setFlash('error', 'Registration Failed');
                $this->setLayout('register');
                return $this->render("rider/register", [
                    'model' => $user
                ]);
            }
        }
        return $this->render("rider/register", [
            'model' => $user
        ]);
    }
    public function vieworder()
    {
        $this->setLayout('rider-mobile');
        return $this->render('rider/view-order');
    }
    public function order()
    {
        $this->setLayout('rider-mobile');
        return $this->render('rider/order');
    }
}