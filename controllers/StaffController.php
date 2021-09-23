<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Item;

class StaffController extends Controller
{
    public function additem(Request $request)
    {
        $item = new Item();
        $this->setLayout("dashboard-staff");
        if($request->isPost()){
            var_dump($request->getBody());
            var_dump($_FILES);
            $item->loadData($request->getBody());
            $itemimg = $request->loadFile("img/product-imgs/","ItemImage");
            if($itemimg){
                $item->ItemImage = $itemimg;
                if($item->validate() && $item->save()){
                    Application::$app->response->redirect("/");
                }else{
                    return $this->render("staff/add-item"
                        ,[
                            'model' => $item
                        ]);
                }
            }else{
                $item->addError("ItemImage","Something is wrong with the image, Try again");
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

    public function viewitems()
    {

    }

}