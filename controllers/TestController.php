<?php

namespace app\controllers;

use app\core\Request;
use app\models\User;

class TestController extends \app\core\Controller
{
    public function test(Request $request){
        echo var_dump($request->getBody());
        echo var_dump(filter_var($request->getBody()['id'], FILTER_VALIDATE_INT));
        echo is_numeric($request->getBody()['id']);
        if(is_numeric($request->getBody()['id'])) { //ints or floats
            if (filter_var($request->getBody()['id'], FILTER_VALIDATE_FLOAT)) {
                echo $request->getBody()['id'] . " is a float";
            } elseif (filter_var($request->getBody()['id'], FILTER_VALIDATE_INT)) {
                echo $request->getBody()['id'] . " is a int";
            }
        }
//        }else{
//            echo $request->getBody()['id']." is a string".PHP_EOL;
//            if(filter_var($request->getBody()['id'],FILTER_VALIDATE_FLOAT)){
//                echo $request->getBody()['id']." is a float";
//            }elseif(filter_var($request->getBody()['id'],FILTER_VALIDATE_INT)){
//                echo $request->getBody()['id']." is a int";
//            }else{
//                echo "nada";
//            }
//        }
    }
}