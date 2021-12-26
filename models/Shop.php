<?php

namespace app\models;

use app\core\Model;
use app\core\UserModel;

class Shop extends UserModel
{

    public int $ShopID = 0;
    public string $Name = '';
    public string $Address = '';
    public string $Email = '';
    public string $ContactNo = '';
    public string $Location = '';
    public string $City = '';
    public string $Suburb = '';
    public string $ShopName = '';
    public string $PlaceID = '';
    public string $ShopDesc = '';
    public int $Category = 0;//['0'=>'Grocery','1'=>'Vegetable','2'=>'Meat','3'=>'Fruit']

    public string $Password = '';
    public string $ConfirmPassword = '';
    public static function tableName(): string
    {
        return 'shop';
    }

    public static function primaryKey(): array
    {
        return ['ShopID'];
    }
    public function labels(): array{
        return [
            'Name' =>'Name',
            'Address' =>'Shop Address',
            'Email' =>'Shop Email',
            'ContactNo' =>'Contact No',
            'Location' =>'Location',
            'City' =>'City',
            'Suburb' =>'Suburb',
            'ShopName' =>'Shop Name',
            'ShopDesc' =>'Shop Description',
            'Password' => 'Password',
            'ConfirmPassword' => 'Confirm Password',
            'Category' => 'Select category'
        ];
    }
    public function attributes(): array
    {
        return ['ShopID','Name', 'Address', 'Email', 'ContactNo', 'Location', 'City', 'Suburb','ShopName', 'ShopDesc','Category','PlaceID'];
    }

    public function rules(): array
    {
        return [
            'ShopID'=>[self::RULE_UNIQUE],
            'Email' => [self::RULE_EMAIL , self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
//            'Password' => [self::RULE_MIN,'min' => 8],
//            'ConfirmPassword' => [self::RULE_MATCH,'match' => 'Password'],//check if the user class has the same email or not.
            'Name' => [self::RULE_REQUIRED],
            'Address' => [self::RULE_REQUIRED],
            'ContactNo' => [self::RULE_REQUIRED, self::RULE_PHONE],
            'City' => [self::RULE_REQUIRED],
            'Suburb' => [self::RULE_REQUIRED],
            'Location' => [self::RULE_REQUIRED],
            'ShopName' => [self::RULE_REQUIRED],
            'ShopDesc' => [self::RULE_REQUIRED,[self::RULE_MAX,'max'=>30]],
            'Category' => [self::RULE_REQUIRED,[self::RULE_ONEOF,'oneof'=>[0,1,2,3,4]]]
        ];
    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }

    public function jsonarray(): array
    {
        return ['ShopID','Name', 'Address', 'ContactNo', 'Location', 'City', 'Suburb','ShopName', 'ShopDesc','Category','PlaceID'];
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function getUserID(): int
    {
        return $this->ShopID;
    }


}