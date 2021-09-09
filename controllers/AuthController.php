<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();

        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }

        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $this->setLayout('register');
        $user = new Customer();
        $user->loadData($request->getBody());
        if ($request->isPost()) {
            if ($request->getPath() === '/register') { //that means its a customer

                $tempuser = new User(); //register the user 1st
                $tempuser->loadData($request->getBody());
                $tempuser->Role ='Customer'; //it is a customer
                if ($tempuser->validate() && $tempuser->save()) {
                    //then we have to register the customer

                    //find the user-id to save as the customer-id
                    $temp = User::findOne(['Email' => $request->getBody()['Email']]);
                    $user->CustomerID = $temp->UserID;

                    if($user->validate() && $user->save()){
                        Application::$app->session->setFlash('success', 'Register Success');
                        $this->setLayout('auth');
                        Application::$app->response->redirect('/login');
                        exit;
                    }
                }
//            var_dump($registerModel->errors);
                return $this->render('register', [
                    'model' => $user
                ]);
            }
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }


}