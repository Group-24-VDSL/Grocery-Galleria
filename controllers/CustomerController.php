<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Customer;
use app\models\Verification;

class CustomerController extends Controller
{
    public function customerRegister(Request $request)
    {
        $this->setLayout('register');

        $user = new Customer(); // Create customer
        $user->loadData($request->getBody());
        if ($request->isPost()) {
            $userid = AuthController::register($request,'Customer');
            if($userid){
                $user->CustomerID = $userid; //save the UserID = CustomerID
                if($user->validate() && $user->save()){
                    Application::$app->session->setFlash('success', 'Registration Success');
                    //send user verification
                    $status = AuthController::verificationSend($user->CustomerID,$user->Name,$user->Email);
                    if($status){
                        Application::$app->response->redirect('/login');
                    }
                }else{
                    Application::$app->session->setFlash('danger', 'Registration Failed');
                    $this->setLayout('register');
                    return $this->render("customer/register", ['model' => $user]);
                }
            }else {
                Application::$app->session->setFlash('danger', 'Registration Failed ');
                $this->setLayout('register');
                return $this->render("customer/register", ['model' => $user]);
            }

        }
        return $this->render("customer/register", [
            'model' => $user
        ]);
    }
    public function profile()
    {
        return $this->render('customer/profile');
    }

}