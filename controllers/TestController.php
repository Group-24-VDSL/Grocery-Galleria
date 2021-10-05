<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\models\User;
use SendGrid\Mail\Mail;
use SendGrid\Mail\TypeException;

class TestController extends \app\core\Controller
{

    public function test(Request $request){
        echo dirname(__DIR__).'/runtime/'.$_ENV['FIREBASE_KEY'];
        var_dump(Application::$app->firedb);
    }
}