<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\LoginForm;
use app\models\Staff;
use app\models\User;
use app\models\Shop;
use app\models\Verification;
use Exception;
use SendGrid\Mail\Mail;
use SendGrid\Mail\To;
use SendGrid\Mail\TypeException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public static function register(Request $request, string $type)
    {
        $user = new User();
        $user->loadData($request->getBody());
        $user->Role = $type;
        if ($user->validate() && $user->save()) {
            $temp = User::findOne(['Email' => $user->Email]);
            return $temp->UserID;
        } else {
            return null;
        }
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

    public static function register(Request $request, string $type)
    {
        $user = new User();
        $user->loadData($request->getBody());
        $user->Role = $type;
        if($user->validate() && $user->save()){
            $temp = User::findOne(['Email' => $user->Email]);
            return $temp->UserID;
        }else{
            return null;
        }
    }

    /**
     * @throws TypeException
     */
    public static function verificationSend(int $userid,string $name,string $email)
    {
        // d-b81e118d214a416884c8ef46298b2b8e
        $uniqueid = Application::$app->generator->generateString(24,"0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $verifystring = Application::$app->generator->generateString(24,"0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $url = 'http://localhost/verify?id='.$uniqueid.'&verifycode='.$verifystring;

        $verify = new Verification();
        $verify->UserID = $userid;
        $verify->VerificationCode = $verifystring;
        $verify->UniqueID= $uniqueid;

        if($verify->validate() && $verify->save()){
            $to = new To($email,$name,
                [
                    'link' => $url,
                ]
            );
            $email =  new Mail(
                Application::$app->emailfrom,$to
            );
            $email->setTemplateId('d-b81e118d214a416884c8ef46298b2b8e');

            try {
                $response = Application::$app->sendgrid->send($email);
                return true;
            } catch (Exception $e){
                echo 'Caught exception: '.  $e->getMessage(). "\n";
                Application::$app->session->setFlash('warning', 'Error sending Email');
            }
        }else{ //validation or save failed.
            return null;
        }

    }

    public function verify(Request $request)
    {
        $this->setLayout('auth');
            if ($request->isSet('id') && $request->isSet('verifycode')) {
                $verify = Verification::findOne(['UniqueID' => $request->getBody()['id']]);
                if ($verify && ($verify->VerificationCode === $request->getBody()['verifycode'])) {
                    $user = User::findOne(['UserID' => $verify->UserID]);
                    if ($user) {
                        //update the user
                        $userTemp = new User();
                        if ($userTemp->update(['Verify_Flag' => 1], ['UserID' => $user->UserID])) {
                            Verification::delete(['UserID' => $user->UserID]) ;
                            return $this->render('email-verified',[
                                'invalid' => 'false'
                            ]);
                        }
                    }
                }
            }
        return $this->render('email-verified',[
            'invalid' => 'true'
        ]);

    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profileUpdate(Request $request)
    {// get logged staff ID
        $staff = new Staff();
        $user = new User();
        $user = $user->findOne(['UserID' => 11]);
        if ($request->isPost()) {
            $success = false;{
                $user->loadData($request->getBody());
                $user->loadData($request->getBody());
                if ($user->validate('update') && $user->update()) {
                    Application::$app->session->setFlash('success', 'Update Success');
                }else{
                    Application::$app->session->setFlash('danger', 'Update Failed');
                    Application::$app->response->redirect('staff/profile-setting');
                    $this->setLayout("dashboardL-staff");
                    return $this->render("staff/profile-setting", [
                        'model' => $staff,
                        'loginmodel' => $user
                    ]);

                }

            }
        }
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/profile-setting", [
            'model' => $staff,
            'loginmodel' => $user
        ]);

    }

}