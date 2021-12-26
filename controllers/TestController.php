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
}