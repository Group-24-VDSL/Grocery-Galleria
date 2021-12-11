<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Staff;
use app\models\User;
use app\models\Verification;


class TestController extends Controller
{
    public function test(Request $request){
//        $verify = Verification::findOne(['UniqueID' => $request->getBody()['id']]);
//        var_dump($verify);
//        var_dump($request->getBody());
        // get logged staff ID
//        $staff = new Staff();
//        $newObj = new Staff();
//        $user = new User();
//        $this->setLayout("dashboardL-staff");
//        $staff = $staff->findOne(['StaffID' => 11]);
//        var_dump($staff);
//        $user = $user->findOne(['UserID' => 11]);
//        if ($request->isPost()) {
//            $newObj->loadData($request->getBody());
//            var_dump($newObj);
////            if ($newObj->validate('update') && $newObj->update()) {
////                $newObj->callProcedure('email_update', $newObj->StaffID, $newObj->Email);
////                Application::$app->session->setFlash('success','Update Success');
////                Application::$app->response->redirect('/dashboard/staff/profilesettings');
////            } else {
////                Application::$app->session->setFlash('danger', 'Update Failed');
////                $this->setLayout("dashboardL-staff");
////                return $this->render("staff/profile-setting", [
////                    'model' => $newObj,
////                    'loginmodel' => $user
////                ]);
////            }
//        }
//        return $this->render("staff/profile-setting", [
//            'model' => $staff,
//            'loginmodel' => $user
//        ]);
    }
}