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

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback=$this->routes[$method][$path] ?? false;
        if($callback === false){
            $this->response->statusCode(404);
//            return $this->renderView("_404");
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
//            Application::$app->controller = $controller;
            Application::$app->setController($controller);
            $controller->action = $callback[1]; //the method of the class
            $callback[0] = $controller; //put the instance back in the array

            foreach ($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }

        }
        return call_user_func($callback,$this->request,$this->response);
    }



//    protected function renderOnlyView($view):string{
//        ob_start();
//        include_once Application::$ROOT_DIR."/views/$view.php";
//        return ob_get_clean();
//    }

//    public function renderView($view)
//    {
//        $layoutContent = $this->layoutContent();
//        $viewContent = $this->renderOnlyView($view);
//        return str_replace('{{content}}',$viewContent,$layoutContent);
//    }

//    protected function layoutContent()
//    {
//        $layout = Application::$app->layout;
//        if(Application::$app->controller){
//        $layout = Application::$app->controller->layout;
//        }
//        ob_start();
//        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
//        return ob_get_clean();
//    }
////
////    protected function renderOnlyView($view):string{
////        ob_start();
////        include_once Application::$ROOT_DIR."/views/$view.php";
////        return ob_get_clean();
////    }
//    public function renderView($view, $params = [])
//    {
//        $viewContent = $this->renderViewOnly($view, $params);
//        $layoutContent = $this->layoutContent();
////        ob_start();
////        include_once Application::$ROOT_DIR.'/views/layouts/main.php';
////        $layoutContent = ob_get_clean();
//        return str_replace('{{content}}', $viewContent, $layoutContent);
//    }
//
//    public function renderContent($viewContent, $params = [])
//    {
//        ob_start();
//        include_once Application::$ROOT_DIR.'/views/layouts/main.php';
//        $layoutContent = ob_get_clean();
//        return str_replace('{{content}}', $viewContent, $layoutContent);
//    }
//
//    public function renderViewOnly($view, $params = [])
//    {
//        foreach ($params as $key => $value  ){
//            $$key = $value; //declare variables as keys;
//        }
//        ob_start();
//        include_once Application::$ROOT_DIR."/views/$view.php";
//        return ob_get_clean();
//    }

}