<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;


class TestController extends Controller
{
    public function test(Request $request){
        $this->setLayout('auth');
        return $this->render('email-verified',[
            'invalid' => 'true'
        ]);
    }
}