<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\DBModel;
use app\core\exceptions\NotFoundException;
use app\core\Request;
use app\core\Response;
use app\models\Cart;
use app\models\Customer;
use app\models\Delivery;
use app\models\OrderCart;
use app\models\Orders;
use app\models\Rider;
use app\models\Shop;
use app\models\Staff;
use app\models\User;
use Exception;
use SendGrid\Mail\Mail;
use SendGrid\Mail\To;

class DeliveryController extends Controller
{
    public function riderRegister(Request $request)
    {
        $this->setLayout('dashboard-delivery');
        $user = new User();
        $rider = new Rider();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            $user->Role = 'Rider'; //it is a rider
            $user->Password = Application::$app->generator->generateString(12);
            $user->ConfirmPassword = $user->Password;
            $riderpic = $request->loadFile("/img/rider-imgs/", "ProfilePic", '95' . str_pad((string)$rider->RiderID, 5, '0', STR_PAD_LEFT));
            if (!is_null($riderpic) && !empty($riderpic)) {
                $rider->loadData($request->getBody());
                $rider->ProfilePic = $riderpic;
                if ($user->validate() && $user->save()) {
                    $temp = User::findOne(['Email' => $user->Email]);
                    $rider->RiderID = (int)$temp->UserID;
                    if ($rider->validate() && $rider->save()) {
                        Application::$app->session->setFlash('success', 'Rider Register Success');
                        //send user verification
                        $status = AuthController::verificationSend($rider->RiderID, $rider->Name, $user->Email);
//                            if($status){
//                                $url = "http://localhost/changePwd?UserID=$rider->RiderID";
//                                $to = new To($rider->Email, $rider->Name, ['password' => $user->Password, 'name' => $rider->Name,'link' => $url,]);
//                                $email =  new Mail(
//                                    Application::$app->emailfrom,$to
//                                );
//                                $email->setTemplateId('d-4c34f31db7674b7d98f93f0eed9f23f5');
//
//                                try {
//                                    $response = Application::$app->sendgrid->send($email);
//                                } catch (Exception $e) {
//                                    echo 'Caught exception: '.  $e->getMessage(). "\n";
//                                    Application::$app->session->setFlash('warning', 'Error sending Email');
//                                    return $this->render('delivery/add-rider', [
//                                        'model' => $rider
//                                    ]);
//                                }
//                                Application::$app->response->redirect('/login');
//                            }
                        //send the register success email
                        //id = d-4c34f31db7674b7d98f93f0eed9f23f5


                        $this->setLayout('dashboard-delivery');
                        Application::$app->response->redirect("/dashboard/delivery/addrider");
                        exit;
                    }
                }
                Application::$app->session->setFlash('warning', 'Please Recheck Information entered, Rider might have already registered.');
                return $this->render('delivery/add-rider', [
                    'model' => $rider
                ]);

            }
            Application::$app->session->setFlash('warning', 'Add a valid Rider Picture');
            return $this->render('delivery/add-rider', [
                'model' => $rider
            ]);
        }
        return $this->render('delivery/add-rider', [
            'model' => $rider
        ]);
    }

    public function viewrider(Request $request)
    {
        $this->setLayout('dashboard-deli');
        $id = $request->getBody()['id'];
        $rider = Rider::findOne(['RiderID' => $id]);
        return $this->render('delivery/view-rider', [
                'model' => $rider
            ]
        );
    }


    /**
     * @throws NotFoundException
     */
    public function deliveryInfo(Request $request, Response $response)
    {
        $order = Orders::findOne(array_slice($request->getBody(), 1, null, true));
        $cartID = $order->CartID;
        $cart = Cart::findOne(['CartID' => $cartID]);
        $customer = Customer::findOne(['CustomerID' => $cart->CustomerID]);
        $orderSQL = "SELECT * FROM `ordercart` WHERE CartID=$cartID GROUP BY ShopID,ItemID";
        $shopCountSQl = "SELECT COUNT(DISTINCT(ShopID)) AS ShopCount FROM `ordercart` WHERE CartID=$cartID";
        $orderStmt = DBModel::prepare($orderSQL);
        $shopCountStmt = DBModel::prepare($shopCountSQl);
        $orderStmt->execute();
        $shopCountStmt->execute();
        $shopOrders = $orderStmt->fetchAll(\PDO::FETCH_ASSOC);
        $shopCount = $shopCountStmt->fetchColumn(\PDO::FETCH_DEFAULT);
        $this->setLayout('dashboard-delivery');
        return $this->render('delivery/view-new-delivery-details',
            [
                'order' => $order,
                'cart' => $cart,
                'customer' => $customer,
                'shopOrders' => $shopOrders,
                'shopCount' => $shopCount
            ]
        );
    }

    public function viewDelivery()
    {
        $this->setLayout('dashboard-delivery');
        return $this->render('delivery/view-delivery');
    }
//    public function viewFullDelivery()
//    {
//        $this->setLayout('dashboard-delivery');
//        return $this->render('delivery/view-complete-delivery-details.php');
//    }

    public function newDelivery()
    {

        $city = Application::getCity();
        $querySql =
            "SELECT od.OrderID, od.OrderDate,cus.Name AS custName,od.Note,cus.ContactNo AS custContact, od.DeliveryCost,od.TotalCost FROM orders od
                INNER JOIN cart crt ON
                od.CartID = crt.CartID
                INNER JOIN customer cus ON
                crt.CustomerID = cus.CustomerID
                WHERE od.Status=0 AND od.City=$city";
        $newDeliveries = DBModel::query($querySql, \PDO::FETCH_ASSOC, true);
        return json_encode($newDeliveries);

    }

    public function onDelivery()
    {

        $city = Application::getCity();
        $querySQL = "SELECT od.OrderID, od.OrderDate,cus.Name AS custName,od.Note,cus.ContactNo AS custContact,del.RiderID,delR.Name AS RiderName,delR.ContactNo AS RiderContact, od.DeliveryCost,od.TotalCost FROM orders od
                    INNER JOIN cart crt ON
                    od.CartID = crt.CartID
                    INNER JOIN customer cus ON
                    crt.CustomerID = cus.CustomerID
                    INNER JOIN delivery del ON
                    del.OrderID = od.OrderID
                    INNER JOIN deliveryrider delR ON
                    delR.RiderID = del.RiderID
                    WHERE od.Status=1 AND del.Status=1 AND od.City=$city";
        $onDeliveries = DBModel::query($querySQL, \PDO::FETCH_ASSOC, true);
        return json_encode($onDeliveries);

    }

    public function pastDelivery()
    {

        $city = Application::getCity();
        $querySQL = "SELECT od.OrderID, od.OrderDate,cus.Name AS custName,od.Note,cus.ContactNo AS custContact,del.RiderID,delR.Name AS RiderName,delR.ContactNo AS RiderContact, od.DeliveryCost,od.TotalCost FROM orders od
                    INNER JOIN cart crt ON
                    od.CartID = crt.CartID
                    INNER JOIN customer cus ON
                    crt.CustomerID = cus.CustomerID
                    INNER JOIN delivery del ON
                    del.OrderID = od.OrderID
                    INNER JOIN deliveryrider delR ON
                    delR.RiderID = del.RiderID
                    WHERE od.Status=1 AND del.Status=2 AND od.City=$city";
        $onDeliveries = DBModel::query($querySQL, \PDO::FETCH_ASSOC, true);
        return json_encode($onDeliveries);
    }


    public function profile()
    {
        return $this->render('delivery/profile');
    }

    public function assignRider(Request $request, Response $response)
    {
        $delivery = new Delivery();
        $deliveryRider = new Rider();
        $order = new Orders();
        $body = $request->getBody();
        $orderID = $body['OrderID'];
        $riderID = $body['RiderID'];
        //order
        $order = $order->findOne(['OrderID' => $orderID]);
        $order->Status = 1;
        $cartID = $order->CartID;
        //delivery
        $deliveryRider = $deliveryRider->findOne(['RiderID' => $riderID, 'Status' => 0]); //check the rider was assigned or not
        $stmt = DBModel::prepare("INSERT INTO `delivery`(`RiderID`,`OrderID`, `CartID`) VALUES ($riderID,$orderID,$cartID)");
        if ($deliveryRider) {
            if ($order->update() && $deliveryRider->update() && $stmt->execute()) {
                Application::$app->session->setFlash('success', 'Rider allocation Success');
                Application::$app->response->redirect('/dashboard/delivery/viewdelivery');

            } else {
                $redirectURL = "/dashboard/delivery/deliveryInfo?OrderID=$orderID";
                Application::$app->response->redirect($redirectURL);

            }
        } else {
            Application::$app->session->setFlash('warning', 'Rider already Assigned, try another!');
            $redirectURL = "/dashboard/delivery/deliveryInfo?OrderID=$orderID";
            Application::$app->response->redirect($redirectURL);
        }

    }

    public function getRiderLocation(Request $request, Response $response)
    {
        $response->setContentTypeJSON();
        $this->setLayout('empty');
        $data['City'] = Application::getCity();
        Application::$app->pusher->trigger('my-channel', 'get-location', $data,);
    }

    public function getRiderLocationData(Request $request, Response $response)
    {
        $type = $request->getBody()['type'];
        $response->setContentTypeJSON();
        $this->setLayout('empty');
        $city = Application::getCity();
        $res = DBModel::query("SELECT d.RiderID,d.LocationLat,d.LocationLng,dr.Name,dr.ContactNo FROM `deliveryriderlocation` AS d INNER JOIN `deliveryrider` AS dr ON dr.RiderID = d.RiderID WHERE d.LastUpdate >= NOW() - INTERVAL 5 MINUTE AND dr.Status=0 AND dr.RiderType=$type AND dr.City=$city;", \PDO::FETCH_ASSOC, true);
        return $response->json($res);
    }


}