<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Item;
use app\models\Complaint;

class StaffController extends Controller
{
    public function additem(Request $request)
    {
        $item = new Item();
        $this->setLayout("dashboardL-staff");
        if($request->isPost()){
            $item->loadData($request->getBody());
            $itemimg = $request->loadFile("/img/product-imgs/","ItemImage",'95' . str_pad((string)Item::getLastID(), 5, '0', STR_PAD_LEFT));
            if($itemimg){
                $item->ItemImage = $itemimg;

                if($item->validate() && $item->save()){
                    Application::$app->session->setFlash("success", "Item Saved.");
                    Application::$app->response->redirect("/dashboard/staff/additem");
                }else{
                    Application::$app->session->setFlash("warning", "Validation Failed.");
                    return $this->render("staff/add-item"
                        ,[
                            'model' => $item
                        ]);
                }
            }else{
                $item->addError("ItemImage","Something is wrong with the image, Try again");
                Application::$app->session->setFlash("warning","Check Item image.");
                return $this->render("staff/add-item"
                    ,[
                        'model' => $item
                    ]);
            }

        }
        return $this->render("staff/add-item"
        ,[
                'model' => $item
            ]);
    }
    public function products(){
        $item = new Item();
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/core-products"
            ,[
                'model' => $item
            ]);
    }

    public function vieworderdetails(){
        $this->setLayout('headeronly-staff');
        return $this->render('staff/view-orders-details');
    }

    public function viewitems()
    {
        $items = Item::findAll();
        $this->setLayout("dashboard-staff");
        return $this->render("staff/view-items",
        [
            'itemslist'=>$items
            ]);
    }

    public function viewcomplaints()
    {
        $complaints = Complaint::findAll();
        $this->setLayout("dashboardL-staff");
        return $this->render("staff/view-complaint",
        [
                'comlist'=>$complaints 
            ]);
    }

    public function addcomplaint(Request $request) 
    {
        $complaint = new Complaint() ;
        $this->setLayout("headeronly-staff");
        if($request->isPost()){
            $complaint->loadData($request->getbody());

            if($complaint->validate() && $complaint->save()){
                Application::$app->session->setFlash("success", "Complaint Saved.");
                Application::$app->response->redirect("/dashboard/staff/addcomplaint");
            }
            else {
                Application::$app->session->setFlash("warning", "Validation Failed.");
                    return $this->render("staff/add-complaint"
                        ,[
                            'model' => $complaint
                        ]);
            }
        }
        return $this->render("staff/add-complaint"
        ,[
            'model' => $complaint
        ]);
    }
}