<?php

namespace app\controllers;

use app\core\db\DBModel;
use app\models\Customer;
use app\models\OrderCart;
use app\models\Orders;
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
            $itemimg = $request->loadFile("/img/product-imgs/", "ItemImage", '95' . str_pad((string)(($itemUpdated->ItemID) - 1), 5, '0', STR_PAD_LEFT));
            if (isset($itemimg)) {
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


    public function vieworders()
    {
        $this->setLayout('dashboardL-staff');
        return $this->render('staff/view-orders');
    }

//    public function vieworderdetails(Request $request)
//    {
//        $this->setLayout('headeronly-staff');
//        $OrderID = $request->getBody()["OrderID"];
//
//        return $this->render('staff/view-orders-details');
//    }

    public function viewitems()
    {
        $items = Item::findAll();
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/view-items",
            [
                'itemslist' => $items
            ]);
    }

    public function viewcomplaints()
    {
        $complaints = Complaint::findAll();
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/view-complaint",
            [
                'comlist' => $complaints
            ]);
    }

    public function addcomplaint(Request $request)
    {
        $complaint = new Complaint();

        $this->setLayout("headeronly-staff");
        if ($request->isPost()) {
            $complaint->loadData($request->getbody());

            $complaint->ComplaintDate =  date("d-m-Y");

            $OrderID = $complaint->OrderID ;
            $order = Orders::findOne(['OrderID' => $OrderID]);
            if(!$order){
                Application::$app->session->setFlash("warning", "Order is not in the system");
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

    public function viewUsers()
    {
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/users");
    }

    public function profilesettings(Request $request)
    {
        $userID = Application::getUserID();
        $model = new Staff();
        $user = new User();
        $this->setLayout("dashboardL-staff");
        $model = $model->findOne(['StaffID' => $userID]);
//        $user = $user->findOne(['UserID' => 11]);
        if ($request->isPost()) {
            $newObj = new Staff();
            $newObj->loadData($request->getBody());
//            $newObj->StaffID = Application::getCustomerID(); // get session id
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
//-> view system order details by 19001541

//    public function vieworderdetails(Request $request)
//    {
//        $this->setLayout('headeronly-staff');
//        $OrderID = $request->getBody()["OrderID"];
//
//        $ShopCount = $request->getBody()["ShopCount"];
//
////        var_dump($ShopCount);
////        var_dump($OrderID);
//
//        $order = Orders::findOne(["OrderID" => $OrderID]);
////        var_dump($order);
//        $CustomerID = $order->CustomerID;
//        $customer = Customer::findOne(["CustomerID" => $CustomerID]);
//
//        $carts = OrderCart::findAll(["CartID" => $order->CartID]);
//        $shopOrders = ShopOrder::findAll(["CartID" => $order->CartID]);
//
//
//        $shops = [];
//
//        foreach ($shopOrders as $shopOrder) {
//            $ItemsArray = [];
//            $itemList = [];
//            $shopWeight = 0;
////            var_dump($shopOrder);
//
//
//            $shop = Shop::findOne(["ShopID" => $shopOrder->ShopID]);
//
//            $i = 0;
//            $orderCarts = OrderCart::findAll(["ShopID" => $shopOrder->ShopID, "CartID" => $order->CartID]);
//
//            foreach ($orderCarts as $cart) {
////                var_dump($cart->ItemID);
//
//                $shopItem = ShopItem::findOne(["ItemID" => $cart->ItemID]);
//                $systemItem = Item::findOne(["ItemID" => $cart->ItemID]);
//
////                $itemList[$i] = ["shopItem"=>$shopItem, "systemItem"=>$systemItem];
//
//
//                array_push($itemList, ["shopItem" => $shopItem, "systemItem" => $systemItem , "quantity" => $cart->Quantity]);
//
//                $shopWeight = ($cart->Quantity * $systemItem->UWeight) / 1000;
////                var_dump($shopItem);
//
//            }
//
//            $ItemsArray[] = $itemList;
//            $i += 1;
//
//
//            $shops[$shopOrder->ShopID] = ["shop" => $shop, "shopOrder" => $shopOrder, "itemList" => $ItemsArray, "shopWeight" => $shopWeight];
//        }
//
//
//        return $this->render('staff/view-orders-details',
//            ['order' => $order, 'customer' => $customer, 'shops' => $shops]);
//
//
//    }


}
