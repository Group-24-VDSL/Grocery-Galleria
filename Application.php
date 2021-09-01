<?php
namespace app\core; //autoload


use app\core\db\Database;
use app\models\User;

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

    public View $view;
    public static Application  $app;
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

    public function run()
    {
        try{ //try catch for the exception handling
            echo $this->router->resolve();
        }catch (\Exception $e){
            $this->response->statusCode($e->getCode());
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

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user',$primaryValue);
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');

    }
}