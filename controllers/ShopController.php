<?php

namespace app\controllers;

use app\core\Controller;

class ShopController extends Controller
{

    public function showShop()
    {
        $this->setLayout('shop');
        return $this->render('shop');
    }


}