<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Shop;
use app\models\ShopItem;
use app\models\TemporaryCart;

class CartController extends Controller
{
    public function cart(Request $request,Response $response)
    {
        $this->setLayout('cart');
        $items = TemporaryCart::findAll(array_slice($request->getBody(),1,null,true));
        $total = 0;
        $shopitems = [];
        foreach($items as $item){
            $shopitem = ShopItem::findOne(['ItemID'=>$item->ItemID,'ShopID'=>$item->ShopID]);
            $shopitems[$item->ShopID][$item->ItemID]=[$shopitem,$item];
            $total += $shopitem->UnitPrice * $item->Quantity;
        }

        return $this->render('customer/cart',['items'=>$items,'total'=>$total,'shopitems' =>$shopitems]);
    }

    public function getCart(Request $request,Response $response) // get all items from DB
    {
        $items = TemporaryCart::findAll(array_slice($request->getBody(),1,null,true));
        $total = 0;
        foreach($items as $item){
            $shopitem = ShopItem::findOne(['ItemID'=>$item->ItemID,'ShopID'=>$item->ShopID]);
            $total += $shopitem->UnitPrice * $item->Quantity;
        }
        return $response->json(['items'=>$items,'total'=>$total]);
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
                    if ($tempcart->validate() && $tempcart->update()) {
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

        }else{
            return json_encode('{"success":"fail"}');
        }
    }
}