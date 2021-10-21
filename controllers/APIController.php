<?php


namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Item;
use app\models\Shop;
use app\models\ShopItem;
use app\models\TemporaryCart;

class APIController extends Controller
{
    // Item section
    public function getItem(Request $request,Response $response) // get item details from DB
    {
        $response->setContentTypeJSON();
        $item=Item::findOne(array_slice($request->getBody(),1,null,true));
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

    public function getShopItem(Request $request, Response $response) // get all shop items from DB
    {
        $response->setContentTypeJSON();
        $shopItem=ShopItem::findOne(array_slice($request->getBody(),1,null,true));
        return json_encode($shopItem);
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

    //cart

    public function getCart(Request $request,Response $response) // get all items from DB
    {
        $response->setContentTypeJSON();
        $items =TemporaryCart::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($items);

    }

    public function addToCart(Request $request,Response $response)
    {
        $response->setContentTypeJSON();
        if($request->isPost()){
            $json = $request->getJson();
            if($json){
                $tempcart = new TemporaryCart();
                $tempcart->loadData($json);
                $checktemp = TemporaryCart::findOne(["ItemID"=>$tempcart->ItemID,"ShopID"=>$tempcart->ShopID,"CustomerID"=>$tempcart->CustomerID]);
                if($checktemp) { //there exists such item
                    $newQuantity = $tempcart->Quantity + $checktemp->Quantity;
                    $tempcart->Quantity = $newQuantity;
                    if ($tempcart->validate() && $tempcart->update(["Quantity"=>$newQuantity],["ItemID"=>$tempcart->ItemID,"ShopID"=>$tempcart->ShopID,"CustomerID"=>$tempcart->CustomerID])) {
                        return json_encode('{"success":"ok"}');
                    }else{
                        return json_encode('{"success":"fail"}');
                    }
                }else{
                    if ($tempcart->validate() && $tempcart->save()) {
                        return json_encode('{"success":"ok"}');
                    } else {
                        return json_encode('{"success":"fail"}');
                    }
                }
            }
            return json_encode('{"success":"fail"}');
        }elseif($request->isPatch()){
            $json = $request->getJson();
            if($json){
                $tempcart = new TemporaryCart();
                $tempcart->loadData($json);
                $checktemp = TemporaryCart::findOne(["ItemID"=>$tempcart->ItemID,"ShopID"=>$tempcart->ShopID,"CustomerID"=>$tempcart->CustomerID]);
                if($checktemp) { //there exists such item
                    if($tempcart->validate() && $tempcart->update(["Quantity"=>$tempcart->Quantity],["ItemID"=>$tempcart->ItemID,"ShopID"=>$tempcart->ShopID,"CustomerID"=>$tempcart->CustomerID])){
                        return json_encode('{"success":"ok"}');
                    }else{
                        return json_encode('{"success":"fail"}');
                    }
                }else{
                    return json_encode('{"success":"fail"}');
                }
            }
        }else{
            return json_encode('{"success":"fail"}');
        }

    }


}