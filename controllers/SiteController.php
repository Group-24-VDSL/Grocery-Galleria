<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function welcome()
    {
        $this->setLayout('main');
        return $this->render('welcome');
    }

    public function dashboard()
    {
        $this->setLayout("headeronly-staff");
        return $this->render('dashboard-links');
    }


}