<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Rider;
use app\models\User;

class DeliveryController extends Controller
{
    public function addrider(Request $request)
    {
        $this->setLayout('dashboard-deli');
        $user = new User();
        $rider = new Rider();
        if($request->isPost()){
            $user->loadData($request->getBody());
            $user->Role ='Rider'; //it is a rider
            if ($user->validate() && $user->save()) {
                //then we have to register the rider
                //find the user-id to save as the rider-id
                $temp = User::findOne(['Email' => $request->getBody()['Email']]);
                $rider->RiderID = $temp->UserID;
                if($rider->validate() && $rider->save()){
                    Application::$app->session->setFlash('success', 'Rider Register Success');
                    $this->setLayout('auth');
                    exit;
                }
                return $this->render('delivery/add-rider', [
                    'model' => $rider
                ]);
            }

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
        return $this->render('delivery/view-rider',[
            'model' => $rider
            ]
        );
    }

}