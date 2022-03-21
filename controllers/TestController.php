<?php

namespace app\controllers;

use app\core\Controller;

class TestController extends Controller
{

    public function test(Request $request){
        echo Application::getUserID();
    }


}