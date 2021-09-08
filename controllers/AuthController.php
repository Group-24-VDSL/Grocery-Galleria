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

    public function __construct(){
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }
    
    public function login(Request $request,Response $response){
        $loginForm = new LoginForm();

        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                Application::$app->response->redirect('/');
//                $response->redirect('/contact');
//                echo "success";
                return;
            }

        }
        $this->setLayout('auth');
        return $this->render('login',[
            'model' => $loginForm
        ]);
    }
    public function register(Request $request){
        $this->setLayout('register');
        $user = new Customer();
        if($request->isPost()){

            $user->loadData($request->getBody());

            if($user->validate() && $user->save()){
                print_r(here2);
                Application::$app->session->setFlash('success', 'Register Success');
                $this->setLayout('auth');
                Application::$app->response->redirect('/login');
                exit;
            }
//            var_dump($registerModel->errors);
            return $this->render('register',[
                'model' => $user
            ]);
        }
        return $this->render('register',[
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response){
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }


}