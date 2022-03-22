<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 1;
    const STATUS_NOTDELETED = 0;

    public string $Email = '';
    public string $Password = ''; //always have to use capitalized names
    public string $PasswordHash = '';
    public string $Name = '';
    public int $Verify_Flag = self::STATUS_INACTIVE; //email is not validated
    public int $Delete_Flag = self::STATUS_NOTDELETED;
    public int $UserID = 0;
    public string $Role = '';
    public string $ConfirmPassword = '';
    public int $City = 0;
    public int $Suburb = 0;


    public function save()
    {
        $this->PasswordHash = password_hash($this->Password,PASSWORD_BCRYPT);
        return parent::save(); //call the parent DBModel::save
    }

    public static function tableName(): string
    {
        return 'login'; //table name
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
            'Password' => [[self::RULE_MIN,'min' => 8],self::RULE_REQUIRED],
            'ConfirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'Password']]
        ];
    }

    public function attributes(): array
    {
        return ['Email','Name','PasswordHash','Verify_Flag','Delete_Flag','Role'];
    }

    public function labels(): array{
        return [
            'Email' => 'Email',
            'Password' => 'Password',
            'ConfirmPassword' => 'Confirm Password'
        ];
    }

    public static function primaryKey():array
    {
        return ['UserID'];
    }

    public function homepage(): string
    {
        $url = '' ;
        switch ($this->Role) {
            case 'Customer':
                $url = '/';
                break ;
            case 'Shop':
                $url = '/dashboard/shop/products';
                break ;
            case 'Rider':
                $url = '/rider/order';
                break ;
            case 'Delivery':
                $url = '/dashboard/delivery/vieworder';
                break ;
            case 'Staff':
                $url = '/dashboard/staff/products';
                break ;
            default :
                $url = '/' ;
        }
        return $url ;

//            case 'Customer' : return ['/'] ,
//            'Shop' => '/dashboard/shop/products',
//            'Rider' => '/rider/order',
//            'Delivery' => '/dashboard/delivery/vieworder',
//            'Staff' => '/dashboard/staff/products',
//            default => '/',
//        ;

    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }

    public function jsonarray(): array
    {
        return ['Email','Name','Verify_Flag','Delete_Flag','Role','City','Suburb'];
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function getUserID(): int
    {
        return $this->UserID;
    }

    public function excludeonupdateattributes(): array
    {
        return ['Password','ConfirmPassword'];
    }
}