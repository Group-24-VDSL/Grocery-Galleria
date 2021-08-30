<?php

namespace app\models;



use app\core\UserModel;

class User extends UserModel
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $email = '';
    public string $password = '';
    public int $status= self::STATUS_INACTIVE; //email is not validated
    public string $confirmPassword = '';

    public function save()
    {

        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
        return parent::save(); //call the parent DBModel::save
    }

    public static function tableName(): string
    {
        return 'users'; //table name
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
            'password' => [[self::RULE_MIN,'min' => 8],[self::RULE_MAX,'max' => 32],self::RULE_REQUIRED],
            'confirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'password']]
        ];
    }

    public function attributes(): array
    {
        return ['email','password','status'];
    }

    public function labels(): array{
        return [
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public static function primaryKey():string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->email;
    }
}