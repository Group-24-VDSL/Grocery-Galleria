<?php
require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\APIController;
use app\controllers\CartController;
use app\controllers\CustomerController;
use app\controllers\DeliveryController;
use app\controllers\PaymentController;
use app\controllers\ShopController;
use app\controllers\StaffController;
use app\controllers\TestController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\RiderController;
use app\controllers\Reports;


$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/',[SiteController::class,'welcome']);

$app->router->get('/dashboardlinks',[SiteController::class,'dashboard']);
$app->router->post('/dashboardlinks',[SiteController::class,'dashboard']);

$app->router->get('/verify',[AuthController::class,'verify']);
$app->router->get('/email-verified',[AuthController::class,'emailverified']);
$app->router->get('/profileupdate',[AuthController::class,'profileUpdate']);
$app->router->get('/settings',[AuthController::class,'pwdUpdate']);
$app->router->post('/settings',[AuthController::class,'pwdUpdate']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/shop/register',[ShopController::class,'shopRegister']);
$app->router->post('/shop/register',[ShopController::class,'shopRegister']);
$app->router->get('/logout',[AuthController::class,'logout']);

//payment
$app->router->post('/pay',[CartController::class,'paymentProcessor']);

//customer
$app->router->get('/customer/register',[CustomerController::class,'customerRegister']);
$app->router->post('/customer/register',[CustomerController::class,'customerRegister']);
$app->router->get('/customer/profile',[CustomerController::class,'profile']);
$app->router->get('/customer/cart',[CartController::class,'cart']);
$app->router->get('/customer/checkout',[CartController::class,'checkout']);
$app->router->post('/customer/checkout',[CartController::class,'proceedToCheckout']);

$app->router->get('/pay/success',[CustomerController::class,'paymentSuccess']);

$app->router->get('/gallery/shop',[ShopController::class,'showshop']);
$app->router->get('/gallery',[ShopController::class,'shopGallery']);

//delivery staff
$app->router->get('/dashboard/delivery/addrider',[DeliveryController::class, 'riderRegister']);
$app->router->post('/dashboard/delivery/addrider',[DeliveryController::class, 'riderRegister']);
$app->router->get('/dashboard/delivery/viewriders',[DeliveryController::class,'viewriders']);
$app->router->get('/dashboard/delivery/viewrider',[DeliveryController::class,'viewrider']);
//$app->router->get('/dashboard/delivery/vieworders',[DeliveryController::class,'vieworders']);
$app->router->get('/dashboard/delivery/vieworder',[DeliveryController::class,'vieworder']);
$app->router->get('/dashboard/delivery/deliveryInfo',[DeliveryController::class, 'deliveryInfo']);
$app->router->get('/dashboard/delivery/viewdelivery',[DeliveryController::class, 'viewDelivery']);
$app->router->get('/dashboard/delivery/newdelivery',[DeliveryController::class, 'newDelivery']);
$app->router->get('/dashboard/delivery/onDelivery',[DeliveryController::class, 'onDelivery']);
$app->router->get('/dashboard/delivery/pastDelivery',[DeliveryController::class, 'pastDelivery']);
$app->router->get('/dashboard/delivery/profile',[DeliveryController::class,'profile']);
$app->router->get('/dashboard/delivery/assignrider',[DeliveryController::class,'assignRider']);
$app->router->post('/dashboard/delivery/assignrider',[DeliveryController::class,'assignRider']);

//system staff
$app->router->get('/dashboard/staff/adduser',[StaffController::class, 'Register']);
$app->router->post('/dashboard/staff/adduser',[StaffController::class, 'Register']);
$app->router->get('/dashboard/staff/additem',[StaffController::class, 'addItem']);
$app->router->post('/dashboard/staff/additem',[StaffController::class, 'addItem']);
$app->router->get('/dashboard/staff/products',[staffController::class, 'updateItem']);
$app->router->post('/dashboard/staff/products',[staffController::class, 'updateItem']);
$app->router->get('/dashboard/staff/viewitems',[StaffController::class,'viewitems']);
$app->router->post('/dashboard/staff/user',[StaffController::class,'user']);
$app->router->post('/dashboard/staff/viewcustomers',[StaffController::class,'viewcustomers']);
$app->router->post('/dashboard/staff/viewshops',[StaffController::class,'viewshops']);
$app->router->get('/dashboard/staff/viewusers',[StaffController::class,'viewUsers']);
$app->router->get('/dashboard/staff/addcomplaint',[StaffController::class,'addcomplaint']);
$app->router->post('/dashboard/staff/addcomplaint',[StaffController::class,'addcomplaint']);
$app->router->get('/dashboard/staff/viewcomplaints',[StaffController::class,'viewcomplaints']);
$app->router->get('/dashboard/staff/vieworders',[StaffController::class,'vieworders']);
$app->router->get('/dashboard/staff/vieworderdetails',[StaffController::class,'vieworderdetails']);
$app->router->post('/dashboard/staff/vieworderdetails',[TestController::class,'vieworderdetails']);
$app->router->get('/dashboard/staff/profilesettings',[StaffController::class,'profilesettings']);
$app->router->post('/dashboard/staff/profilesettings',[StaffController::class,'profilesettings']);
$app->router->get('/dashboard/staff/systemreports',[Reports::class,'systemReports']);
$app->router->get('/dashboard/staff/shopreports',[Reports::class,'shopReports']);
$app->router->get('/dashboard/staff/productreports',[Reports::class,'productReports']);
$app->router->get('/dashboard/staff/gettotalorders',[Reports::class,'getTotalOrders']);
$app->router->get('/dashboard/staff/gettotalusers',[Reports::class,'getTotalUsers']);
$app->router->get('/dashboard/staff/shopsreportmonthly',[Reports::class,'shopsReportMonthly']);
$app->router->get('/dashboard/staff/shopsreportyearly',[Reports::class,'shopsReportYearly']);
$app->router->get('/dashboard/staff/itemreport',[Reports::class,'itemReport']);
$app->router->get('/dashboard/staff/salesreportcurrent',[Reports::class,'salesReportCurrent']);
$app->router->get('/dashboard/staff/salesreportlast',[Reports::class,'salesReportLast']);
$app->router->get('/dashboard/staff/itemreport',[Reports::class,'itemReport']);
$app->router->get('/dashboard/staff/getitemweekreport',[Reports::class,'getItemWeekReport']);
$app->router->get('/dashboard/staff/dailyrevenue',[Reports::class,'dailyRevenue']);
$app->router->get('/dashboard/staff/dailytotorders',[Reports::class,'dailyTotOrders']);

//shop staff
$app->router->get('/dashboard/shop/products',[ShopController::class,'productOverview']);
$app->router->post('/dashboard/shop/products',[ShopController::class,'productOverview']);
$app->router->get('/dashboard/shop/viewitems',[ShopController::class,'viewitems']);
//$app->router->patch('/dashboard/shop/viewitems',[ShopController::class,'updateOngoingShopItem']);
$app->router->get('/dashboard/shop/vieworder',[ShopController::class,'vieworder']);
$app->router->get('/dashboard/shop/vieworders',[ShopController::class,'vieworders']);
$app->router->get('/dashboard/shop/vieworderdetails',[ShopController::class,'vieworderdetails']);
$app->router->post('/dashboard/shop/vieworderdetails',[ShopController::class,'updateStatus']);
$app->router->get('/dashboard/shop/additem',[ShopController::class,'additem']);
$app->router->post('/dashboard/shop/additem',[ShopController::class,'additem']);
$app->router->post('/dashboard/shop/viewitems',[ShopController::class,'viewitems']);
$app->router->post('/dashboard/shop/viewitems',[ShopController::class,'updateOngoingShopItem']);
$app->router->get('/dashboard/shop/profilesettings',[TestController::class,'profilesettings']);
$app->router->post('/dashboard/shop/profilesettings',[TestController::class,'profilesettings']);
$app->router->post('/dashboard/shop/profileupdate',[TestController::class,'profileUpdate']);

//rider
$app->router->get('/rider/register',[RiderController::class,'riderRegister']);
$app->router->post('/rider/register',[RiderController::class,'riderRegister']);
$app->router->get('/rider/vieworder',[RiderController::class,'vieworder']);
$app->router->post('/rider/vieworder',[RiderController::class,'vieworder']);
$app->router->get('/rider/order',[RiderController::class,'order']);
$app->router->post('/rider/order',[RiderController::class,'order']);

//for debugging purposes
$app->router->get('/test',[TestController::class,'test']);
$app->router->post('/test',[TestController::class,'test']);

//api

$app->router->get('/api/item',[APIController::class,'getItem']);
$app->router->get('/api/items',[APIController::class,'getItemAll']);
$app->router->get('/api/shopitems',[APIController::class,'getShopItems']);
$app->router->get('/api/shopitem',[APIController::class,'getShopItem']);
$app->router->get('/api/shop',[APIController::class,'getShop']);
$app->router->get('/api/shops',[APIController::class,'getAllShop']);
$app->router->get('/api/getcustomer',[APIController::class,'getCustomer']);

//api - customer
$app->router->get('/api/getcart',[CartController::class,'getTempCart']);
$app->router->post('/api/addtocart',[CartController::class,'addToCart']);
$app->router->patch('/api/addtocart',[CartController::class,'addToCart']);
$app->router->post('/api/deletefromcart',[CartController::class,'deleteFromCart']);

//api - shop
$app->router->get('/api/orders',[APIController::class,'getOrders']);
$app->router->get('/api/getordercart',[APIController::class,'getOrderCart']);
$app->router->get('/api/getdelivery',[APIController::class,'getDelivery']);
$app->router->get('/api/getshoporders',[APIController::class,'getShopOrders']);
$app->router->get('/api/getshoporder',[APIController::class,'getShopOrder']);
$app->router->get('/api/updateshopitem',[ShopController::class,'updateItem']);
$app->router->get('/api/shopitems',[APIController::class,'getShopItems']);
$app->router->patch('/api/updateshopitem',[ShopController::class,'updateOngoingShopItem']);

//api - delivery
$app->router->get('/api/getrider',[APIController::class,'getRider']);
$app->router->get('/api/getriders',[APIController::class,'getRiders']);


$app->router->get('/api/getriderlocation',[DeliveryController::class,'getRiderLocation']);
$app->router->get('/api/getriderlocationdata',[DeliveryController::class,'getRiderLocationData']);
//rider
$app->router->get('/rider/register',[RiderController::class,'riderRegister']);
$app->router->post('/rider/register',[RiderController::class,'riderRegister']);
$app->router->get('/rider/vieworder',[RiderController::class,'vieworder']);
$app->router->post('/rider/vieworder',[RiderController::class,'vieworder']);
$app->router->get('/rider/order',[RiderController::class,'order']);
$app->router->post('/rider/order',[RiderController::class,'order']);
$app->router->post('/rider/getlocation',[RiderController::class,'riderLocation']);


$app->router->get('/changePwd',[AuthController::class,'changePassword']);
$app->router->post('/changePwd',[AuthController::class,'changePassword']);

$app->run();

?>