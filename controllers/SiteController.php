<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function welcome()
    {
        $this->setLayout('main');
        return $this->render('welcome');
    }

//    public function handleContact(Request $request){
////        $body = Application::$app->request->getBody();
////        var_dump($body);
//        $body = $request->getBody();
//        return 'handling data';
//    }
//
//    //directly calling view from the
//    public function contact(){
//        return $this->render('contact');
//    }
//
//    //passing parameters to the view
//    public function home(){
//        $params = ["name"=> "Vishwajith"]; //variable passing
//        return $this->render('home',$params);
//    }


}