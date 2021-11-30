<?php
namespace app\core; //autoload


use app\core\db\Database;
use app\models\User;
use Exception;
use \RandomLib\Factory;
use RandomLib\Generator;
use SecurityLib\Strength;
use SendGrid;
use SendGrid\Mail\From;

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
    public From $emailfrom;
    public View $view;
    public static Application $app;
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

        $this->sendgrid = new SendGrid($_ENV['SENDGRID_API_KEY']);
        $this->emailfrom = new From('grocerygalleria@gmail.com','Grocery Galleria');

        $this->secfactory = new Factory();
        $this->generator = $this->secfactory->getGenerator(new Strength(Strength::LOW));


        $userId = Application::$app->session->get('user');
        if ($userId) {
            $key = User::primaryKey();
            $this->user = User::findOne([$key => $userId]);
        }else{
            $this->user= null;
        }

    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public static function isCustomer(){
        return (self::$app->session->get('role') === 'Customer');
    }

    public static function isShop(){
        return (self::$app->session->get('role') === 'Shop');
    }

    public static function isStaff(){
        return (self::$app->session->get('role') === 'Staff');
    }

    public static function isDeliveryRider(){
        return (self::$app->session->get('role') === 'Rider');
    }

    public static function isDelivery(){
        return (self::$app->session->get('role') === 'Delivery');
    }

    public static function getCustomerID()
    {
        return self::isCustomer()?self::$app->session->get('user'):null;
    }

    public static function getShopID()
    {
        return self::isShop()?self::$app->session->get('user'):null;
    }

    public static function getStaffID()
    {
        return self::isStaff()?self::$app->session->get('user'):null;
    }

    public static function getRiderID()
    {
        return self::isDeliveryRider()?self::$app->session->get('user'):null;
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
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');

    }
}