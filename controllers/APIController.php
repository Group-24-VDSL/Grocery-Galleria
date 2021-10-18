<?php


namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Item;
use app\models\Shop;
use app\models\ShopItem;

class APIController extends Controller
{
    // Item section
    public function getItem(Request $request,Response $response) // get item details from DB
    {
        $response->setContentTypeJSON();
        $item=Item::findOne(['Name'=>'Brinjal']);
        return json_encode($item->jsonSerialize());
    }
    public function getItemAll(Request $request,Response $response) // get all items from DB
    {
        $response->setContentTypeJSON();
        $items =Item::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($items);

    }

    public function getShopItems(Request $request, Response $response) // get all shop items from DB
    {
        $response->setContentTypeJSON();
        $shopItems=ShopItem::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($shopItems);
    }
    // Shop section
    public function getShop(Request $request, Response $response) // get shop details from DB
    {
        $response->setContentTypeJSON();
        $shop = Shop::findOne(array_slice($request->getBody(),1,null,true));
        return json_encode($shop);
    }

    public function getAllShop(Request $request,Response $response)
    {
        $response->setContentTypeJSON();
        $shops = Shop::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($shops);

    }

}