<?php

namespace app\controllers;

use app\core\Request;
use app\models\User;

class TestController extends \app\core\Controller
{
    public function test(Request $request){
        var_dump($request->getBody());
    }
}