<?php

namespace app\controllers;

use app\core\db\DBModel;
use app\core\Response;
use app\models\Cart;
use app\models\Customer;
use app\models\OrderCart;
use app\models\DeliveryStaff;
use app\models\Orders;
use app\models\Rider;
use app\models\Shop;
use app\models\ShopItem;
use app\models\ShopOrder;
use app\models\Staff;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Item;
use app\models\Complaint;
use app\models\User;
use app\models\Verification;
use app\models\SystemReports;
use SendGrid\Mail\TypeException;

/**
 * @throws TypeException
 */


class StaffController extends Controller
{
    public function Register(Request $request)
    {
        $this->setLayout('dashboardL-staff');
        $user = new Staff(); // staff instance
        $customer = new Customer();
        $shop = new Shop();
        $user->loadData($request->getBody());
        if ($request->isPost()) {
            $userid = AuthController::register($request, 'Staff');
            if ($userid) {
                $user->StaffID = $userid; //save the UserID = CustomerID
                if ($user->validate() && $user->save()) {
                    Application::$app->session->setFlash('success', 'Registration Success');
                    //send user verification
                    $status = AuthController::verificationSend($user->StaffID, $user->Name, $user->Email);
                    if ($status) {
                        Application::$app->response->redirect('/dashboard/staff/addstaff');
                    }
                } else {
                    Application::$app->session->setFlash('danger', 'Registration Failed');
                    $this->setLayout('dashboardL-staff');
                    return $this->render("staff/register", ['model' => $user]);
                }
            } else {
                Application::$app->session->setFlash('danger', 'Registration Failed ');
                $this->setLayout('dashboardL-staff');
                return $this->render("staff/register", ['model' => $user]);
            }

        }
        return $this->render("staff/register", [
            'staff' => $user,
            'customer' => $customer,
            'shop' => $shop
        ]);

    }

    public function addItem(Request $request)
    {
        $item = new Item();
        $this->setLayout("dashboardL-staff");
        if ($request->isPost()) {
            $item->loadData($request->getBody());
            $itemimg = $request->loadFile("/img/product-imgs/", "ItemImage", '95' . str_pad((string)Item::getLastID(), 5, '0', STR_PAD_LEFT));
            if ($itemimg) {
                $item->ItemImage = $itemimg;

                if ($item->validate() && $item->save()) {
                    Application::$app->session->setFlash("success", "Item Saved.");
                    Application::$app->response->redirect("/dashboard/staff/additem");
                } else {
                    Application::$app->session->setFlash("warning", "Validation Failed.");
                    return $this->render("staff/add-item"
                        , [
                            'model' => $item
                        ]);
                }
            } else {
                $item->addError("ItemImage", "Something is wrong with the image, Try again");
                Application::$app->session->setFlash("warning", "Check Item image.");
                return $this->render("staff/add-item"
                    , [
                        'model' => $item
                    ]);
            }

        }
        return $this->render("staff/add-item"
            , [
                'model' => $item
            ]);
    }

    public function updateItem(Request $request)
    {
        $itemUpdated = new Item();
        $this->setLayout("dashboardL-staff");

        if ($request->isPost()) {
            $itemUpdated->loadData($request->getBody());
            if (isset($request->getBody()['ItemImage'])) {
                $itemimg = $request->loadFile("/img/product-imgs/", "ItemImage", '95' . str_pad((string)(($itemUpdated->ItemID) - 1), 5, '0', STR_PAD_LEFT));
                $itemUpdated->ItemImage = $itemimg;
            } else {
                $body = $request->getBody();
                $itemUpdated->ItemImage = (string)$body['ImgStr'];
            }
            if ($itemUpdated->validate('update') && $itemUpdated->update()) {
                Application::$app->session->setFlash("success", "Item Updated Successfully.");
                Application::$app->response->redirect("/dashboard/staff/products");
            } else {
                Application::$app->session->setFlash("warning", "Validation Failed.");
                return $this->render("staff/core-products"
                    , [
                        'model' => $itemUpdated
                    ]);
            }
        }
        return $this->render("staff/core-products"
            , [
                'model' => $itemUpdated
            ]);
    }


    public function viewOrder()
    {
        $this->setLayout('dashboardL-staff');
        return $this->render('staff/view-orders');
    }

    public function viewOrders()
    {
        $this->setLayout('dashboardL-staff');
        return $this->render('staff/view-orders');
    }

    public function vieworderdetails(Request $request)
    {

        $order = Orders::findOne(array_slice($request->getBody(), 1, null, true));
        $cartID = $order->CartID;
        $cart = Cart::findOne(['CartID' => $cartID]);
        $customer = Customer::findOne(['CustomerID' => $cart->CustomerID]);
        $shopCountSQl = "SELECT COUNT(DISTINCT(ShopID)) AS ShopCount FROM `ordercart` WHERE CartID=$cartID";
        $shopCountStmt = DBModel::prepare($shopCountSQl);
        $shopCountStmt->execute();
        $shopCount = $shopCountStmt->fetchColumn(\PDO::FETCH_DEFAULT);
        $this->setLayout("dashboardL-staff");
        return $this->render('staff/view-order-details',
            [
                'order' => $order,
                'customer' => $customer,
                'shopCount' => $shopCount
            ]
        );
    }

    public function getShopList(Request $request)
    {
        $cartID = $request->getBody()['CartID'];
        $shopIDsSQL = "SELECT ShopID FROM `ordercart` WHERE CartID=$cartID GROUP BY ShopID";
        $shopIDs = DBModel::query($shopIDsSQL, fetch_type: \PDO::FETCH_ASSOC, fetchAll: true);
        return json_encode($shopIDs);


    }

    public function getOrderShopDetails(Request $request)
    {
        $Shopid = $request->getBody()['ShopID'];
        $shopSQL = "SELECT * FROM `shop` WHERE ShopID=$Shopid";
        $shop = DBModel::query($shopSQL, fetch_type: \PDO::FETCH_ASSOC, fetchAll: true);
        return json_encode($shop);
    }

    public function getOrderShopItemDetails(Request $request)
    {
        $body = $request->getBody();
        $cartID = $body['CartID'];
        $shopID = $body['ShopID'];
        $querySQL = "SELECT odc.ItemID, it.Name,it.ItemImage,it.Unit,it.UWeight,si.UnitPrice, odc.Quantity, odc.Total FROM `ordercart` odc 
                    INNER JOIN Item it ON
                    it.ItemID = odc.ItemID
                    INNER JOIN shopitem si ON
                    si.ItemID = it.ItemID
                    WHERE odc.CartID =$cartID AND odc.ShopID=$shopID
                    GROUP BY odc.ItemID";
        $shopItems = DBModel::query($querySQL,fetch_type: \PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($shopItems);


    }

    public function getShopLocations(Request $request)
    {
        $cartID = $request->getBody()['CartID'];
        $shopIDsSQL = "SELECT odc.ShopID,sp.ShopName,sp.ContactNo, sp.Location FROM `ordercart` odc
        INNER JOIN `shop` sp ON sp.ShopID = odc.ShopID WHERE CartID=$cartID GROUP BY ShopID;";
        $shopLocations = DBModel::query($shopIDsSQL, fetch_type: \PDO::FETCH_ASSOC, fetchAll: true);
        return json_encode($shopLocations);

    }

    public
    function viewitems()
    {
        $items = Item::findAll();
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/view-items",
            [
                'itemslist' => $items
            ]);
    }

    public function viewcomplaints(Request $request,Response $response)
    {
        $complaints = Complaint::findAll();

        $complaint = new Complaint() ;

        $this->setLayout("dashboardL-staff");
        return $this->render("staff/view-complaint",
            [
                'complaintlist' => $complaints, 'model'=> $complaint
            ]);
    }

    public function updateComplaint(Request $request, Response $response)
    {
        $json = $request->getJson();
        if ($json) {
            $temp = new Complaint();
            $temp->loadData($json);


            $checktemp = Complaint::findOne(["ComplaintID" => $temp->ComplaintID ]);


            if ($request->isPost()) {

                if ($checktemp) { //there exists such item
                    $checktemp->Status =1;
                    if ($checktemp->validate('update') && $checktemp->update()) {
                        $response->json('{"success":"ok"}');
                        Application::$app->response->redirect("/dashboard/staff/viewcomplaints");

                    }
                    else {
                        return $response->json('{"success":"fail"}');
                    }
                }
                return $response->json('{"success":"fail"}');

            } elseif($request->isPatch()) {
                $temp->Status =1;
                if ($checktemp) { //there exists such item
                    $checktemp->Status =1;
                    if ($checktemp->validate('update') && $checktemp->update()) {
                        Application::$app->response->redirect("/dashboard/shop/viewcomplaints");
                        return $response->json('{"success":"ok"}');
                    }
                }
                return $response->json('{"success":"fail"}');
            }
        }
        return $response->json('{"success":"fail"}');
    }


    public
    function addcomplaint(Request $request)
    {
        $complaint = new Complaint();
        $this->setLayout("headeronly-staff");
        if ($request->isPost()) {
            $complaint->loadData($request->getbody());

            $complaint->ComplaintDate =  date("Y-m-d H:i:s") ;

            $OrderID = $complaint->OrderID ;
            $order = Orders::findOne(['OrderID' => $OrderID]);
            if(!$order){
                Application::$app->session->setFlash("warning", "Order is not exist in the system.");
                Application::$app->response->redirect("/dashboard/staff/addcomplaint");
            }
            $complaint->OrderDate = $order->OrderDate;



            if ($complaint->validate() && $complaint->save()) {
                Application::$app->session->setFlash("success", "Complaint Saved.");
                Application::$app->response->redirect("/dashboard/staff/addcomplaint");
            } else {
                Application::$app->session->setFlash("warning", "Validation Failed.");
                return $this->render("staff/add-complaint"
                    , [
                        'model' => $complaint
                    ]);
            }
        }
        return $this->render("staff/add-complaint"
            , [
                'model' => $complaint
            ]);
    }

    public
    function viewUsers()
    {
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/users");
    }

    public
    function profilesettings(Request $request)
    {
        $userID = Application::getUserID();
        $model = new Staff();
        $user = new User();
        $this->setLayout("dashboardL-staff");
        $model = $model->findOne(['StaffID' => $userID]);
        if ($request->isPost()) {
            $newObj = new Staff();
            $newObj->loadData($request->getBody());
            $newObj->StaffID = $userID;
            if ($newObj->validate('update') && $newObj->update()) {
                $newObj->callProcedure('email_update', ['UserID' => $newObj->StaffID, 'Email' => $newObj->Email]);
                Application::$app->session->setFlash('success', 'Update Success');
                Application::$app->response->redirect('/dashboard/staff/profilesettings');
            } else {
                Application::$app->session->setFlash('danger', 'Update Failed');
                $this->setLayout("dashboardL-staff");
                return $this->render("staff/profile-setting", [
                    'model' => $newObj
                ]);
            }
        }
        return $this->render("staff/profile-setting", [
            'model' => $model,
            'loginmodel' => $user
        ]);
    }

    public
    function newOrders()
    {

        $querySql =
            "SELECT od.OrderID, od.OrderDate,cus.Name AS custName,od.Note,cus.ContactNo AS custContact, od.DeliveryCost,od.TotalCost, od.Status FROM orders od
                INNER JOIN cart crt ON
                od.CartID = crt.CartID
                INNER JOIN customer cus ON
                crt.CustomerID = cus.CustomerID
                WHERE od.Status=0";
        $newDeliveries = DBModel::query($querySql, \PDO::FETCH_ASSOC, true);
        return json_encode($newDeliveries);

    }

    public
    function onOrders()
    {

        $querySQL = "SELECT od.OrderID, od.OrderDate,cus.Name AS custName,od.Note,cus.ContactNo AS custContact,del.RiderID,delR.Name AS RiderName,delR.ContactNo AS RiderContact, od.DeliveryCost,od.TotalCost, od.Status FROM orders od
                    INNER JOIN cart crt ON
                    od.CartID = crt.CartID
                    INNER JOIN customer cus ON
                    crt.CustomerID = cus.CustomerID
                    INNER JOIN delivery del ON
                    del.OrderID = od.OrderID
                    INNER JOIN deliveryrider delR ON
                    delR.RiderID = del.RiderID
                    WHERE od.Status=1 AND del.Status=0";
        $onDeliveries = DBModel::query($querySQL, \PDO::FETCH_ASSOC, true);
        return json_encode($onDeliveries);

    }

    public
    function pastOrders()
    {

        $querySQL = "SELECT od.OrderID, od.OrderDate,cus.Name AS custName,od.Note,cus.ContactNo AS custContact,del.RiderID,delR.Name AS RiderName,delR.ContactNo AS RiderContact, od.DeliveryCost,od.TotalCost, od.Status FROM orders od
                    INNER JOIN cart crt ON
                    od.CartID = crt.CartID
                    INNER JOIN customer cus ON
                    crt.CustomerID = cus.CustomerID
                    INNER JOIN delivery del ON
                    del.OrderID = od.OrderID
                    INNER JOIN deliveryrider delR ON
                    delR.RiderID = del.RiderID
                    WHERE od.Status=1 AND del.Status=1";
        $onDeliveries = DBModel::query($querySQL, \PDO::FETCH_ASSOC, true);
        return json_encode($onDeliveries);
    }

//-> view system order details by 19001541

//apis
    public
    function getShopStaff(Request $request, Response $response)
    {
        $response->setContentTypeJSON();
        $shops = Shop::findAll();
        return $response->json($shops);

    }

    public
    function getRiderStaff(Request $request, Response $response)
    {
        $response->setContentTypeJSON();
        $riders = Rider::findAll();
        return $response->json($riders);

    }

    public
    function getDeliveryStaff(Request $request, Response $response)
    {
        $response->setContentTypeJSON();
        $deliverys = DeliveryStaff::findAll();
        return $response->json($deliverys);

    }

    public
    function getSystemStaff(Request $request, Response $response)
    {
        $response->setContentTypeJSON();
        $systems = Staff::findAll();
        return $response->json($systems);

    }


}
