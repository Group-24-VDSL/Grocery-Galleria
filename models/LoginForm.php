<?php

namespace app\models;

use app\core\Application;

use app\core\Model;


class LoginForm extends Model
{
    public string $Email = '';
    public string $Password = '';

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'Password' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
        $user = User::findOne(['Email'=> $this->Email]);
        if(!$user) {
            $this->addError('Email', 'Username or Password invalid');
            return false;
        }
        if(!password_verify($this->Password,$user->PasswordHash)){
            $this->addError('Password', 'Username or Password invalid');
            return false;
        }

        return Application::$app->login($user);
    }

}