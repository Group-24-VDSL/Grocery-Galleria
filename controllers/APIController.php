<?php


namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Item;

class APIController extends Controller
{
    public function getItem(Request $request,Response $response){
        $response->setContentTypeJSON();
        $item=Item::findOne(['Name'=>'Brinjal']);
        return json_encode($item->jsonSerialize());
    }
    public function getItemAll(Request $request,Response $response){
        var_dump(array_slice($request->getBody(),1,null,true));
        var_dump(['id'=>1,'Category'=>0]);
        $response->setContentTypeJSON();
        $items =Item::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($items);

    }


}