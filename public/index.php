<?php
require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\APIController;
use app\controllers\DeliveryController;
use app\controllers\ShopController;
use app\controllers\StaffController;
use app\controllers\TestController;
use app\core\Application;
use app\controllers\SiteControllers;
use app\controllers\AuthController;


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

$app->router->get('/',[SiteControllers::class,'welcome']);
$app->router->get('/welcome',[SiteControllers::class,'welcome']);
$app->router->get('/contact',[SiteControllers::class,'contact']);
$app->router->post('/contact',[SiteControllers::class,'handleContact']);

$app->router->get('/verify',[AuthController::class,'verify']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/customer/register',[\app\controllers\CustomerController::class,'customerRegister']);
$app->router->post('/customer/register',[\app\controllers\CustomerController::class,'customerRegister']);
$app->router->get('/shop/register',[AuthController::class,'register']);
$app->router->post('/shop/register',[AuthController::class,'register']);
$app->router->get('/logout',[AuthController::class,'logout']);
$app->router->get('/profile',[AuthController::class,'profile']);

$app->router->get('/gallery/shop',[ShopController::class,'showshop']);
$app->router->get('/gallery',[ShopController::class,'showgallery']);

$app->router->get('/dashboard/delivery/addrider',[DeliveryController::class, 'riderRegister']);
$app->router->post('/dashboard/delivery/addrider',[DeliveryController::class, 'riderRegister']);
$app->router->get('/dashboard/delivery/viewriders',[DeliveryController::class,'viewriders']);
$app->router->get('/dashboard/delivery/viewrider',[DeliveryController::class,'viewrider']);
$app->router->get('/dashboard/delivery/vieworders',[DeliveryController::class,'vieworders']);
$app->router->get('/dashboard/delivery/vieworder',[DeliveryController::class,'vieworder']);


$app->router->get('/dashboard/staff/additem',[StaffController::class,'additem']);
$app->router->post('/dashboard/staff/additem',[StaffController::class,'additem']);
$app->router->get('/dashboard/staff/products',[staffController::class,'products']);
$app->router->post('/dashboard/staff/products',[staffController::class,'products']);
$app->router->get('/dashboard/staff/viewitems',[StaffController::class,'viewitems']);
$app->router->post('/dashboard/staff/user',[StaffController::class,'user']);
$app->router->post('/dashboard/staff/viewcustomers',[StaffController::class,'viewcustomers']);
$app->router->post('/dashboard/staff/viewshops',[StaffController::class,'viewshops']);
$app->router->post('/dashboard/staff/viewusers',[StaffController::class,'viewusers']);
$app->router->get('/dashboard/staff/addcomplaint',[StaffController::class,'addcomplaint']);
$app->router->post('/dashboard/staff/addcomplaint',[StaffController::class,'addcomplaint']);
$app->router->get('/dashboard/staff/viewcomplaints',[StaffController::class,'viewcomplaints']);



$app->router->get('/dashboard/shop/products',[ShopController::class,'productOverview']);
$app->router->get('/dashboard/shop/viewItem',[ShopController::class,'viewitem']);
$app->router->get('/dashboard/shop/viewOrder',[ShopController::class,'vieworder']);
$app->router->get('/dashboard/shop/viewOrders',[ShopController::class,'vieworders']);
$app->router->get('/dashboard/shop/additem',[ShopController::class,'additem']);
$app->router->post('/dashboard/shop/additem',[ShopController::class,'additem']);
//for debugging purposes
$app->router->get('/test',[TestController::class,'test']);

$app->router->get('/api/item',[APIController::class,'getItem']);
$app->router->get('/api/items',[APIController::class,'getItemAll']);
$app->router->get('/api/shopItems',[APIController::class,'getShopItems']);
$app->run();


?>