<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Staff;
use app\models\User;
use app\models\Verification;


class TestController extends Controller
{
    public function test(Request $request){
        echo Application::getUserID();
    }
}