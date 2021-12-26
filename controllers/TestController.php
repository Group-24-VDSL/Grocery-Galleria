<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\Response;
use app\models\Customer;
use app\models\OrderCart;
use app\core\Request;
use app\models\Orders;
use app\models\Shop;
use app\models\ShopOrder;
use app\models\Staff;
use app\models\User;
use app\models\Verification;
use app\models\ShopItem;
use app\models\Item;

class TestController extends Controller
{
    public function test(Request $request){

        $this->setLayout('headeronly-staff');

        $ShopID = $request ->getBody()["ShopID"];
        $CartID = $request ->getBody()["CartID"];

        $shoporder = ShopOrder ::findOne([ "ShopID" => $ShopID ,"CartID" => $CartID]);

        $ShopTotal = $shoporder->ShopTotal ;


        $cartitems = OrderCart ::findAll([ "ShopID" => $ShopID ,"CartID" => $CartID]);

        $shopitems = [];
        $i = 0 ;
        $itemprice = [] ;

        foreach($cartitems as $cartitem){
            $shopitem = ShopItem::findOne(['ItemID'=>$cartitem->ItemID,'ShopID'=>$cartitem->ShopID]);
            $item = Item::findOne(['ItemID'=>$cartitem->ItemID]);

            $shopitems[$cartitem->ShopID][$cartitem->ItemID]=[$shopitem,$item];

        }

        //return $this->render('shop/view-order-details',['shoporder'=>$shopitem]);

        //print_r($request -> getBody());
    }

    public function updateOngoingShopItem(Request $request, Response $response)
    {
        $json = $request->getJson();
        if ($json) {
            $tempshopitem = new ShopItem();
            $tempshopitem->loadData($json);

//            Application::$app->session->setFlash("success", "hi1" );
            $checktemp = ShopItem::findOne(["ItemID" => $tempshopitem->ItemID, "ShopID" => $tempshopitem->ShopID]);
            if ($request->isPost()) {
                if ($checktemp) { //there exists such item

                    if ($tempshopitem->validate('update') && $tempshopitem->update()) {
                        return $response->json('{"success":"ok"}');
                    }
                }

//                else {
//                    if ($tempshopitem->validate() && $tempshopitem->save()) {
//                        return json_encode('{"success":"ok"}');
//                    }
//                }

                return $response->json('{"success":"fail"}');

            } elseif($request->isPatch()) {
//                var_dump($tempshopitem);
                $tempshopitem->loadData($checktemp);
//                Application::$app->session->setFlash("success", "aaa" );
//                Application::$app->session->setFlash("success", var_dump($tempshopitem) );
                if ($checktemp) { //there exists such item
                    $tempshopitem->loadData($checktemp);
//                    $tempshopitem->Quantity = $json['Quantity'];
//                    Application::$app->session->setFlash("success", var_dump($tempshopitem) );
                    if ($tempshopitem>validate('update') && $tempshopitem->update()) {
                        return $response->json('{"success":"ok"}');
                    }
                }
            }
        }
        return $response->json('{"success":"fail"}');
    }



}