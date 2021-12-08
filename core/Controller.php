<?php

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;

class Controller{
    public string $layout = 'main';

    public function __construct()
    {
        $this->registerMiddleware(Application::$app->authMiddleware);
    }

    /**
     * @var BaseMiddleware[]
    **/
    protected array $middlewares = [];

    public string $action = ''; //what function its gonna call;

    public function render($view,$params = []){
        return Application::$app->view->renderView($view,$params);
    }

    public function setLayout($layout){
        $this->layout=$layout; //setting the layout
    }

    public function registerMiddleware(BaseMiddleware $middleware){
        $this->middlewares[] = $middleware; //pushes the $middleware in the array
    }

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }


}