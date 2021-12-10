<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions;

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }
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
            if(Application::getUserRole()  && !in_array(Application::$app->controller->action,$this->actions[Application::getUserRole()]) && !in_array(Application::$app->controller->action,(array)$this->actions["Common"] )){ //checks the current action is in the actions array which are not protected.
                throw new ForbiddenException();
            }
        }
    }
}