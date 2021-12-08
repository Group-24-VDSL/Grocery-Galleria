<?php

namespace app\core; //autoload

use app\core\exceptions\NotFoundException;

class Router
{
    public Request $request;
    private Response $response;
    protected array $routes =[];


    public function __construct(Request $request,Response $response)
    {

        $this->request = $request;
        $this->response = $response;
    }

    public function get($path,$callback){
        $this->routes['get'][$path]=$callback;
    }

    public function post($path,$callback){
        $this->routes['post'][$path]=$callback;
    }

    public function patch($path,$callback){
        $this->routes['patch'][$path]=$callback;
    }

    /**
     * @throws NotFoundException
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback=$this->routes[$method][$path] ?? false;
        if($callback === false){
            $this->response->statusCode(404);
            throw new NotFoundException();
        }
        if(is_string($callback)){
            return Application::$app->view->renderView($callback);
        }
        if(is_array($callback)){
            /**
             * @var Controller $controller
             **/
            $controller = new $callback[0]; //create a instance of the callback class
            Application::$app->setController($controller);
            $controller->action = $callback[1]; //the method of the class
            $callback[0] = $controller; //put the instance back in the array

            foreach ($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }

        }
        return call_user_func($callback,$this->request,$this->response);
    }


}