<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\NotFoundException;
use app\core\Request;
use app\core\Response;
use app\models\Cart;
use app\models\Customer;
use app\models\Orders;
use app\models\Rider;
use app\models\Shop;
use app\models\Staff;
use app\models\User;
use Exception;
use SendGrid\Mail\Mail;
use SendGrid\Mail\To;

class DeliveryController extends Controller
{
    public function riderRegister(Request $request)
    {
        $this->setLayout('dashboard-deli');
        $user = new User();
        $rider = new Rider();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            $user->Role = 'Rider'; //it is a rider
            $user->Password = Application::$app->generator->generateString(12);
            $user->ConfirmPassword = $user->Password;
            if ($user->validate() && $user->save()) {
                //then we have to register the rider
                //find the user-id to save as the rider-id
                $rider->loadData($request->getBody());
                $temp = User::findOne(['Email' => $user->Email]);
                $rider->RiderID = (int)$temp->UserID;
                $riderpic = $request->loadFile("/img/rider-imgs/", "ProfilePic", '95' . str_pad((string)$rider->RiderID, 5, '0', STR_PAD_LEFT));
                if (!is_null($riderpic) && !empty($riderpic)){
                    $rider->ProfilePic = $riderpic;
                    if ($rider->validate() && $rider->save()) {
                        Application::$app->session->setFlash('success', 'Rider Register Success');
                        //send the register success email
                        //id = d-4c34f31db7674b7d98f93f0eed9f23f5

                        $to = new To($rider->Email,
                            $rider->Name,
                            [
                                'password' => $user->Password,
                                'name' => $rider->Name
                            ]
                        );
                        $email =  new Mail(
                            Application::$app->emailfrom,$to
                        );
                        $email->setTemplateId('d-4c34f31db7674b7d98f93f0eed9f23f5');

                        try {
                            $response = Application::$app->sendgrid->send($email);
                        } catch (Exception $e) {
                            echo 'Caught exception: '.  $e->getMessage(). "\n";
                            Application::$app->session->setFlash('warning', 'Error sending Email');
                            return $this->render('delivery/add-rider', [
                                'model' => $rider
                            ]);
                        }

                        $this->setLayout('dashboard-deli');
                        Application::$app->response->redirect("/dashboard/delivery/addrider");
                        exit;
                    }
                }
                Application::$app->session->setFlash('warning', 'Add a valid Rider Picture');
                return $this->render('delivery/add-rider', [
                    'model' => $rider
                ]);
            }
            Application::$app->session->setFlash('warning', 'Please Recheck Information entered, Rider might have already registered.');
            return $this->render('delivery/add-rider', [
                'model' => $rider
            ]);
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
        return $this->render('delivery/view-rider', [
                'model' => $rider
            ]
        );
    }

    public function assignrider(){
        $this->setLayout('headeronly-staff');
        return $this->render('delivery/assign-rider');
    }

    /**
     * @throws NotFoundException
     */
    public function viewnewdelivery(Request $request, Response $response){
        $this->setLayout('headeronly-staff');
        if($request->isSet("id")){
            $order = Orders::findOne(['OrderID' => $request->getBody()["id"]]);
            if($order){
                $cart = Cart::findOne(['CartID' => $order->CartID]);
                if($cart) {
                    $customer = Customer::findOne(['CustomerID' => $cart->CustomerID]);
                    if($customer){

                    }
                }
            }else{
                $response->statusCode(404);
                throw new NotFoundException();
            }

        }
        return $this->render('delivery/view-new-delivery-details');
    }

    public function viewongoingdelivery(){
        $this->setLayout('headeronly-staff');
        return $this->render('delivery/view-ongoing-delivery-details');
    }

    public function viewcompletedelivery(){
        $this->setLayout('headeronly-staff');
        return $this->render('delivery/view-complete-delivery-details');
    }

    public function viewdelivery(){
        $this->setLayout('dashboard-delivery');
        return $this->render('delivery/view-delivery');
    }

    public function profile()
    {
        return $this->render('delivery/profile');
    }
}