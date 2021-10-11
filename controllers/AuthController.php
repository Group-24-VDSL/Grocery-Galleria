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
use app\models\Shop;

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
        $requestPath = $request->getPath();
        $position = stripos($requestPath,'/',1);
        $userRole = ucfirst(filter_var(substr($requestPath,1,$position-1),FILTER_SANITIZE_SPECIAL_CHARS)); // User Role
        $userName = "\\app\\models\\$userRole";
        $user = new $userName(); // Create user obj based on user type using user models
        $user->loadData($request->getBody());
        if ($request->isPost()) {
                $UserLogin = new User(); //register the user 1st
                $UserLogin->loadData($request->getBody()); // load the input values into model attributes
                $UserLogin->Role = $userRole;
                if ($UserLogin->validate() && $UserLogin->save()) {
                    $temp = User::findOne(['Email' => $request->getBody()['Email']]);
                    $userID = $userRole . "ID";
                    $user->$userID = $temp->UserID;
                }
                if ($user->validate() && $user->save()) {
                    Application::$app->session->setFlash('success', 'Register Success');
                    $this->setLayout('auth');
                    Application::$app->response->redirect('/login');
                    exit;
                }
                return $this->render("$userRole\\register", ['model' => $user]);

        }
        return $this->render("$userRole\\register", [
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