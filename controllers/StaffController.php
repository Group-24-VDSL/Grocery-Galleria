<?php

namespace app\controllers;

use app\models\Staff;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Item;
use app\models\Complaint;
use app\models\Verification;

class StaffController extends Controller
{
    public function staffRegister(Request $request)
    {
        $this->setLayout('dashboardL-staff');
        $user = new Staff(); // Create customer
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
                    $this->setLayout('dashboard-staff');
                    return $this->render("staff/register", ['model' => $user]);
                }
            } else {
                Application::$app->session->setFlash('danger', 'Registration Failed ');
                $this->setLayout('dashboard-staff');
                return $this->render("staff/register", ['model' => $user]);
            }

        }
        return $this->render("staff/register", [
            'model' => $user
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
            $itemimg = $request->loadFile("/img/product-imgs/", "ItemImage", '95' . str_pad((string)(($itemUpdated->ItemID)-1), 5, '0', STR_PAD_LEFT));
            $itemUpdated->ItemImage = $itemimg;
            if ($itemUpdated->validate('update') && $itemUpdated->update(Item::primaryKey())) {
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
    public function profilesettings()
    {
        $staff = new Staff();
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/profile-setting",[
            'model'=> $staff
        ]);
    }

}