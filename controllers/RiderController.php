<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\Request;
use app\models\Orders;
use app\models\Rider;

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
    public function vieworder()
    {
        $this->setLayout('rider-mobile');
        return $this->render('rider/view-order');
    }
    public function order()
    {
        $this->setLayout('rider-mobile');
        $riderID = Application::getUserID();
        $orders = DBModel::query("SELECT OrderID FROM `delivery` WHERE RiderID=$riderID AND Status=0",\PDO::FETCH_ASSOC,true);
        foreach($orders as &$order){ //pass by reference
            $orderid=$order['OrderID'];
            $result = DBModel::query("SELECT CartID,TotalCost FROM `orders` WHERE OrderID=$orderid",\PDO::FETCH_ASSOC);
            $order["TotalCost"] = $result["TotalCost"];
            $cartid = $result["CartID"];
            $order["Address"] = DBModel::query("SELECT Address FROM `cart` WHERE CartID=$cartid",\PDO::FETCH_COLUMN);
        }

        return $this->render('rider/order',[
            'orders' => $orders
        ]);
    }
}