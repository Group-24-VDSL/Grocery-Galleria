<?php

namespace app\controllers;

use app\core\Controller;
use app\core\db\DBModel;
use app\core\Request;
use app\core\Response;
use app\models\ShopOrder;
use app\models\TemporaryCart;
use app\models\Verification;


class TestController extends Controller
{
    public function shopOrderAnalytics(Request $request,Response $response){
        $response->setContentTypeJSON();

        $shopID =  1 ;
        $yms = array();
        $now = date('Y-m');
        for($x = 12; $x >= 1; $x--) {
            $ym = date('Y F', strtotime($now . " -$x month"));
            $year = date('Y', strtotime($now . " -$x month"));
            $month = date('m', strtotime($now . " -$x month"));
            echo gettype($year) ;
            echo $month."  " ;
            $orders = DBModel::query("SELECT COUNT(CartID) AS NumberOfOrders FROM `shoporder` WHERE YEAR (Date) =  ".$year." AND  MONTH (Date)= ".$month." AND ShopID = ".$shopID."  ",\PDO::FETCH_ASSOC,true);

//            echo $orders;
            $yms[$ym] = $orders[0];

        }
        $items =ShopOrder::findAll(array_slice($request->getBody(),1,null,true));

        echo "<pre>";
        print_r($yms);
        echo "</pre>";

        return json_encode($yms) ;


    }
    public function getmonthorders(Request $request,Response $response){
        $response->setContentTypeJSON();

        $shopID =  1 ;
        $yms = array();
        $now = date('Y-m-d');
        echo  $now."   ";


        for($x = 30 ; $x >= 1; $x--) {
            $ym = date('F d', strtotime($now . " -$x days"));
//            echo $ym."    " ;
            $year = date('Y', strtotime($now . " -$x days"));

            $month = date('m', strtotime($now . " -$x days"));

            $day = date('d', strtotime($now . " -$x days"));


            $orders = DBModel::query("SELECT COUNT(CartID) AS NumberOfOrders FROM `shoporder` WHERE YEAR (Date) =  ".$year." AND  MONTH (Date)= ".$month." AND  DAY (Date)= ".$day." AND ShopID = ".$shopID."  ",\PDO::FETCH_ASSOC,true);

            $yms[$x][$ym] = $orders[0];
        }

            return $response->json(array_reverse($yms)) ;


        }

    public function test(Request $request)
    {

//        $user = new Shop;
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/shop-analytics');
    }

    public function abc(Request $request)
    {

//        $user = new Shop;
        $this->setLayout('dashboardL-shop');
        return $this->render('shop/sales-analytics');
    }
}