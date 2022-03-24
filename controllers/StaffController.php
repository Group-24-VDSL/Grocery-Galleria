<?php

namespace app\controllers;

use app\core\db\DBModel;
use app\core\Response;
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

    public function vieworderdetails()
    {
        $this->setLayout('headeronly-staff');
        return $this->render('staff/view-orders-details');
    }

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

    //apis
    public function getShopStaff(Request $request,Response $response){
        $response->setContentTypeJSON();
        $shops  = Shop::findAll();
        return $response->json($shops);

    }
    public function getRiderStaff(Request $request,Response $response){
        $response->setContentTypeJSON();
        $riders = Rider::findAll();
        return $response->json($riders);

    }
    public function getDeliveryStaff(Request $request,Response $response){
        $response->setContentTypeJSON();
        $deliverys = DeliveryStaff::findAll();
        return $response->json($deliverys);

    }
    public function getSystemStaff(Request $request,Response $response){
        $response->setContentTypeJSON();
        $systems  = Staff::findAll();
        return $response->json($systems);

    }


}
