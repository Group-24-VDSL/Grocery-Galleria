<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Verification;


class TestController extends Controller
{
    public function test(Request $request){
        $verify = Verification::findOne(['UniqueID' => $request->getBody()['id']]);
        var_dump($verify);
        var_dump($request->getBody());
    }
}