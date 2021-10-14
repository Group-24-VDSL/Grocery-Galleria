<?php


namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Item;
use app\models\ShopItem;

class APIController extends Controller
{
    public function getItem(Request $request,Response $response){
        $response->setContentTypeJSON();
        $item=Item::findOne(['Name'=>'Brinjal']);
        return json_encode($item->jsonSerialize());
    }
    public function getItemAll(Request $request,Response $response){
        $response->setContentTypeJSON();
        $items =Item::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($items);

    }

    public function getShopItems(Request $request, Response $response){
        $response->setContentTypeJSON();
        $shopItems=ShopItem::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($shopItems);
    }


}