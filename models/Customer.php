<?php

namespace app\models;

use app\core\db\DBModel;
use app\models\User;
use app\core\UserModel;

class Customer extends UserModel
{


    public int $CustomerID = 0;

    public string $Name = '';
    public string $Address = '';
    public string $ContactNo = '';
    public string $City = '';
    public string $Suburb = '';
    public string $Location = '';

    public string $Email = '';
    public string $Password = '';
//    public int $status= self::STATUS_INACTIVE; //email is not validated
    public string $ConfirmPassword = '';

    public function save()
    {
        return parent::save();
    }



    public static function tableName(): string
    {
        return 'customer'; //table name
    }

    public function rules(): array
    {
        return [
//            'Email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
//            'Password' => [[self::RULE_MIN,'min' => 8],self::RULE_REQUIRED],
//            'ConfirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'Password']],
//            'Name' => [self::RULE_REQUIRED],
//            'Address'=>[self::RULE_REQUIRED],
//            'ContactNo'=>[self::RULE_REQUIRED],
//            'City'=>[self::RULE_REQUIRED],
//            'Suburb' =>[self::RULE_REQUIRED],
//            'Location'=>[self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['CustomerID','Name','Address','Email','ContactNo','City','Suburb','Location'];
    }

//    public function labels(): array{
//        return [
//            'email' => 'Email',
//            'password' => 'Password',
//            'confirmPassword' => 'Confirm Password'
//        ];
//    }

    public static function primaryKey():string
    {
        return 'CustomerID';
    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }

}