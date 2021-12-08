<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions;
    /**
     * @param array $actions
     */
    public function __construct(array $actions)
    {
        $this->actions = $actions;
    }


    /**
     * @throws ForbiddenException
     */
    public function execute()
    {
        if(Application::isGuest()){
            if(empty($this->actions) || !in_array(Application::$app->controller->action,$this->actions["Guest"] ) ){ //checks the current action is in the actions array which are not protected.
                throw new ForbiddenException();
            }
        }else{
            if(!in_array(Application::$app->controller->action,(array)$this->actions["Common"] ) || !in_array(Application::$app->controller->action,(array)$this->actions[Application::getUserRole()] ) ){ //checks the current action is in the actions array which are not protected.
                throw new ForbiddenException();
            }
        }
    }
}