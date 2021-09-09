<?php

namespace app\controllers;

use app\models\User;

class TestController extends \app\core\Controller
{
    public function test(){
        $user2 = User::findOne(['Email'=> 'dilshan@gg.com']);
        var_dump($user2);
        print_r($user2->primaryKey());
        print_r($user2->UserID);
    }
}