<?php

namespace app\controllers;

use app\core\Controller;

class  RiderController extends Controller
{
    public function vieworder()
    {
        $this->setLayout('rider-mobile');
        return $this->render('rider/view-order');
    }
    public function order()
    {
        $this->setLayout('rider-mobile');
        return $this->render('rider/order');
    }
}