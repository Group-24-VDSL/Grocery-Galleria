<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\DeliveryStaff;
use app\models\LoginForm;
use app\models\Rider;
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

    /**
     * @throws TypeException
     */
    public static function verificationSend(int $userid, string $name, string $email)
    {
        // d-b81e118d214a416884c8ef46298b2b8e
        $uniqueid = Application::$app->generator->generateString(24, "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $verifystring = Application::$app->generator->generateString(24, "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $url = 'http://localhost/verify?id=' . $uniqueid . '&verifycode=' . $verifystring;

        $verify = new Verification();
        $verify->UserID = $userid;
        $verify->VerificationCode = $verifystring;
        $verify->UniqueID = $uniqueid;

        if ($verify->validate() && $verify->save()) {
            $to = new To($email, $name,
                [
                    'link' => $url,
                ]
            );
            $email = new Mail(
                Application::$app->emailfrom, $to
            );
            $email->setTemplateId('d-b81e118d214a416884c8ef46298b2b8e');

            try {
                $response = Application::$app->sendgrid->send($email);
                return true;
            } catch (Exception $e) {
                echo 'Caught exception: ' . $e->getMessage() . "\n";
                Application::$app->session->setFlash('warning', 'Error sending Email');
            }
        } else { //validation or save failed.
            return null;
        }

    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();

        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $url=$loginForm->login()) {
                Application::$app->response->redirect($url);
                return;
            }

        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
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
                        Verification::delete(['UserID' => $user->UserID]);
                        return $this->render('email-verified', [
                            'invalid' => 'false'
                        ]);
                    }
                }
            }
        }
        return $this->render('email-verified', [
            'invalid' => 'true'
        ]);

    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function pwdUpdate(Request $request)
    {
        $login = Application::getUser();
        $userID = Application::getUserID();

        if ($login->Role == 'Customer') {
            $this->setLayout('register');
        }
        elseif ($login->Role == 'Staff') {
            $this->setLayout("dashboardL-staff");
        }
        elseif ($login->Role == 'Shop') {
            $this->setLayout("dashboardL-shop");
        }
        elseif ($login->Role == 'Delivery') {
            $this->setLayout("dashboardL-staff");
        }
//        elseif ($login->Role == 'Rider') {
//            $model = new Rider();
//        }
        $user = new User();
        if ($request->isPost()) {
            $userNew = new User();
            $body = $request->getBody();
            $arrayUser = (array)User::findOne(['UserID' => $userID]);
            $hashPWD = $arrayUser['PasswordHash'];
            $userNew->loadData($arrayUser);
            $userNew->loadData($body);
            $userNew->PasswordHash = password_hash($userNew->Password,PASSWORD_BCRYPT);
            if (password_verify($body['currentPWD'], $hashPWD)) {
                if ($userNew->validate('update') && $userNew->update()) {
                    Application::$app->session->setFlash('success', 'Password Updated.');
                    Application::$app->logout();
                    Application::$app->response->redirect('/login');

                } else {
                    Application::$app->session->setFlash('warning', 'Password Updated failed!');

                    return $this->render("/settings", [
                        'loginmodel' => $user
                    ]);
                }
            } else {
                Application::$app->session->setFlash('danger', 'Incorrect current password!');
                return $this->render("/settings", [
                    'loginmodel' => $user
                ]);
            }

        }
        return $this->render("/settings", [
            'loginmodel' => $user
        ]);
    }

}