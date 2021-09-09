<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Rider;

class DeliveryController extends Controller
{
    public function addrider(Request $request)
    {
        $this->setLayout('dashboard-deli');
        $rider = new Rider();
        if($request->isPost()){

        }
        return $this->render('delivery/add-rider', [
            'model' => $rider
        ]);
    }

}