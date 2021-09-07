<?php
require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\ShopController;
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

$app->router->get('/',[SiteControllers::class,'home']);
$app->router->get('/contact',[SiteControllers::class,'contact']);
$app->router->post('/contact',[SiteControllers::class,'handleContact']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

$app->router->get('/logout',[AuthController::class,'logout']);

$app->router->get('/profile',[AuthController::class,'profile']);

$app->router->get('/gallery/shop',[ShopController::class,'showShop']);


$app->run();


?>