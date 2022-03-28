<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\exceptions\NotFoundException;
use app\core\Request;
use app\core\Response;
use app\models\Orders;
use app\models\Rider;
use MongoDB\Driver\Query;

class  RiderController extends Controller
{
    public function riderRegister(Request $request)
    {
        $this->setLayout('register');
        $user = new Rider(); // Create rider
        $user->loadData($request->getBody());
        if ($request->isPost()) {
            $userid = AuthController::register($request,'Rider');
            if($userid){
                $user->RiderID = $userid; //save the ShopID = UserID
                if($user->validate() && $user->save()){
                    Application::$app->session->setFlash('success', 'Registration Success');
                    $status = AuthController::verificationSend($user->RiderID,$user->Name,$user->Email);
                    if($status){
                        Application::$app->response->redirect('/login');
                    }
                }else{
                    Application::$app->session->setFlash('error', 'Registration Failed');
                    $this->setLayout('register');
                    return $this->render("rider/register", [
                        'model' => $user
                    ]);
                }
            }else {
                Application::$app->session->setFlash('error', 'Registration Failed');
                $this->setLayout('register');
                return $this->render("rider/register", [
                    'model' => $user
                ]);
            }
        }
        return $this->render("rider/register", [
            'model' => $user
        ]);
    }
    public function vieworder(Request $request,Response $response)
    {
        $this->setLayout('rider-mobile');
        if($request->isPost()){
            $json=$request->getJson();
            if($json){
                $orderid = $json["orderid"];
                $cartid = $json["cartid"];

                $orderStatus = DBModel::query("Update `delivery` SET Status=2, CompTime=CURRENT_TIMESTAMP WHERE OrderID=$orderid AND CartID=$cartid",\PDO::FETCH_ASSOC);

                    $riderid=Application::getUserID();
                    $riderStatus = DBModel::query("Update `deliveryrider` SET Status=0 WHERE RiderID=$riderid ",\PDO::FETCH_ASSOC);
                    Application::$app->session->setFlash('success','Order Completed');
                    return $response->json('{"url":"/rider/order" }');

            }
            Application::$app->session->setFlash('danger','Json is invalid');
            return $response->json('{"url":"/rider/order" }');
        }elseif ($request->isGet()) {
            $orderid = filter_var((int)$request->getBody()["orderid"], FILTER_SANITIZE_NUMBER_INT);
            $cartid = filter_var((int)$request->getBody()["cartid"], FILTER_SANITIZE_NUMBER_INT);

            if (is_null($orderid)) {
                return new NotFoundException();
            } else {
                $order = DBModel::query("SELECT RiderID,OrderID,CartID FROM `delivery` WHERE OrderID=$orderid AND CartID=$cartid AND Status=0", \PDO::FETCH_ASSOC);
                if ($order) {
                    if (Application::getUserID() == $order["RiderID"]) { //authorized rider views the order
                        $cartid = $order["CartID"];
                        $cart = DBModel::query("SELECT cus.CustomerID,cus.Address FROM `cart` AS c JOIN `customer` AS cus ON c.CustomerID=cus.CustomerID WHERE CartID=$cartid  ", \PDO::FETCH_ASSOC);
                        $cartitems = DBModel::query("SELECT ShopID,ItemID,Quantity,Total FROM `ordercart` WHERE CartID=$cartid ORDER BY ShopID", \PDO::FETCH_ASSOC, true);
                        $shopdetails = [];
                        $itemdetails = [];
                        $cartitemsfinal = []; //where we pass the items
                        $uniqueshops = array_unique(array_map(function ($i) {
                            return $i["ShopID"];
                        }, $cartitems));
                        foreach ($cartitems as $cartitem) {
                            $shopid = $cartitem['ShopID'];
                            $itemid = $cartitem['ItemID'];
                            if (!isset($shopdetails[$shopid])) {
                                $details = DBModel::query("SELECT Name,Address,ContactNo,ShopName,Location,PlaceID FROM `shop` WHERE ShopID=$shopid", \PDO::FETCH_ASSOC);
                                $shopdetails[$shopid] = $details;
                            }
                            if (!isset($itemdetails[$itemid])) {
                                $item = DBModel::query("SELECT Name,ItemImage,Brand,UWeight FROM `item` WHERE ItemID=$itemid", \PDO::FETCH_ASSOC);
                                $itemdetails[$itemid] = $item;
                            }
                            $cartitemsfinal[$shopid][$itemid] = [$cartitem["Quantity"], $cartitem["Total"]];
                        }

                        $cartdetails = DBModel::query("SELECT * FROM `orders` WHERE CartID=$cartid and OrderID=$orderid", \PDO::FETCH_ASSOC);
                        $customerid = $cart["CustomerID"];
                        $customer = DBModel::query("SELECT Name,ContactNo,Suburb,Location,PlaceID FROM `customer` WHERE CustomerID=$customerid", \PDO::FETCH_ASSOC);
                        $deliveryStatus = "SELECT Status FROM `delivery` WHERE OrderID=$orderid AND CartID=$cartid";
                        $deliveryStatusStmt = DBModel::prepare($deliveryStatus);
                        $deliveryStatusStmt->execute();
                        $orderStatus = $deliveryStatusStmt->fetchColumn();

                        return $this->render('rider/view-order', [
                            'orderid' => $orderid,
                            'cartid' => $cartid,
                            'cartdetails' => $cartdetails,
                            'cart' => $cart,
                            'customer' => $customer,
                            'shopdetails' => $shopdetails,
                            'itemdetails' => $itemdetails,
                            'uniqueshops' => $uniqueshops,
                            'cartitemsfinal' => $cartitemsfinal,
                            'orderStatus' => $orderStatus
                        ]);

                    }
                }

            }
        }
    }
    public function order()
    {
        $this->setLayout('rider-mobile');
        $riderID = Application::getUserID();
        $orders = DBModel::query("SELECT DeliveryID,OrderID FROM `delivery` WHERE RiderID=$riderID AND Status=0",\PDO::FETCH_ASSOC,true);
        foreach($orders as &$order){ //pass by reference
            $orderid=$order['OrderID'];
            $result = DBModel::query("SELECT CartID,TotalCost FROM `orders` WHERE OrderID=$orderid",\PDO::FETCH_ASSOC);
            $order["TotalCost"] = $result["TotalCost"];
            $cartid = $result["CartID"];
            $order["CartID"] = $result["CartID"];
            $order["Address"] = DBModel::query("SELECT cus.Address FROM `cart` AS c JOIN `customer` AS cus ON c.CustomerID=cus.CustomerID WHERE c.CartID=$cartid",\PDO::FETCH_COLUMN);
        }

        return $this->render('rider/order',[
            'orders' => $orders
        ]);
    }

    public function riderLocation(Request $request)
    {
        if(Application::getUserRole() === 'Rider'){
            if($request->isPost()){
                $json = $request->getJson();
                if($json){
                    $positionLat = $json["lat"];
                    $positionLng = $json["lng"];//{&quot;lat&quot;:6.871714052860769,&quot;lng&quot;:79.89268108720779}
                    //INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE
                    //name="A", age=19
                    $riderid = Application::$app->session->get('user');;
                    DBModel::query("INSERT INTO `deliveryriderlocation` (RiderID,LocationLat,LocationLng) VALUES ($riderid,$positionLat,$positionLng )ON DUPLICATE KEY UPDATE LocationLat=$positionLat,LocationLng=$positionLng",\PDO::FETCH_COLUMN);
                }
            }
        }

    }



    
}