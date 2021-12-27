<?php
namespace app\core; //autoload


use app\core\db\Database;
use app\core\middlewares\AuthMiddleware;
use app\models\User;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use \RandomLib\Factory;
use RandomLib\Generator;
use SecurityLib\Strength;
use SendGrid;
use SendGrid\Mail\From;
use Stripe\StripeClient;

class Application
{
    public string $layout = 'main';

    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public static string $ROOT_DIR;
    public ?Controller $controller = null;
    public Database $db;
    public ?UserModel $user;
    public Factory $secfactory;
    public Generator $generator;
    public SendGrid  $sendgrid;
    public StripeClient $stripe;
    public From $emailfrom;
    public Logger $logger;
    public View $view;
    public AuthMiddleware $authMiddleware;
    public static Application $app;
    public string $domain;

    public function __construct($rootPath ,$config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request=new Request();
        $this->response=new Response();

        $this->router=new Router($this->request,$this->response);
        $this->db = new Database($config['db']);

        $this->view = new View();

        $this->session=new Session();

        $this->authMiddleware=new AuthMiddleware([
            'Guest' => ['welcome','verify','emailverified','login','shopRegister','customerRegister','test','riderRegister'],
            'Delivery' => ['riderRegister','riderRegister','viewriders','viewrider','vieworders','vieworder','assignrider','viewdelivery','viewnewdelivery','viewongoingdelivery','viewcompletedelivery','profile'],
            'Customer' => ['welcome','getTempCart','paymentProcessor','profile','cart','checkout','proceedToCheckout','showshop','shopGallery','getItem','getItemAll','getShopItems','getShopItem','getShop','getAllShop','getCart','addToCart','deleteFromCart'],
            'Staff' => ['Register','addItem','updateItem','viewitems','user','viewcustomers','viewshops','viewUsers','addcomplaint','viewcomplaints','vieworders','vieworderdetails','profilesettings','profilesettings','getItem','getItemAll','getShopItems','getShopItem','getShop','getAllShop','getOrders','getOrderCart'],
            'Shop' => ['productOverview','productOverview','viewitem','vieworder','vieworders','vieworderdetails','updateStatus','additem','getItem','getItemAll','getShopItems','getShopItem','getShop','getAllShop','getOrders','getOrderCart'],
            'Rider' => ['vieworder','order'],
            "Common" => ['logout','profileUpdate','test']
        ]);

        $this->stripe = new StripeClient($_ENV['STRIPE_SECRET_KEY']);

        $this->domain=$_ENV['DOMAIN'];

        $this->logger = new Logger('Default');
        $this->logger->pushHandler(new StreamHandler($_ENV['LOG_FILE'],Logger::DEBUG));

        $this->sendgrid = new SendGrid($_ENV['SENDGRID_API_KEY']);
        $this->emailfrom = new From($_ENV['SENDGRID_EMAIL'],$_ENV['SENDGRID_NAME']);

        $this->secfactory = new Factory();
        $this->generator = $this->secfactory->getGenerator(new Strength(Strength::LOW));


        $userID = Application::$app->session->get('user');
        if ($userID) {
            $key = User::primaryKey();
            $this->user = User::findOne([$key[0] => $userID]);
        }else{
            $this->user= null;
        }

    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public static function getUser(){
        return self::$app->user;
    }

    public static function getUserRole(){
        return self::$app->user->Role??null;
    }

    public static function getCity(){
        return self::$app->session->get('city');
    }

    public static function getSuburb(){
        return self::$app->session->get('Suburb');
    }

    public function run()
    {
        try{ //try catch for the exception handling
            echo $this->router->resolve();
        }catch (Exception $e){
            $this->response->statusCode((int)$e->getCode());
            echo $this->view->renderView('_error',[
                'exception' => $e
            ]);
        }

    }


    public function getController(): Controller
    {
        return $this->controller;
    }


    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(User $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey[0]};
        $this->session->set('user',$primaryValue);
        $this->session->set('role',$user->Role);
        $this->session->set('city',$user->City);
        $this->session->set('suburb',$user->Suburb);
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');

    }
}