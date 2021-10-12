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
    public string $ShopBanner= '';
    public string $ShopDesc = '';

    public string $Password = '';
    public string $ConfirmPassword = '';
    public static function tableName(): string
    {
        return 'shop';
    }

    public static function primaryKey(): string
    {
        return 'ShopID';
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
            'ShopBanner' =>'Shop Banner',
            'ShopDesc' =>'Shop Label',
            'Password' => 'Password',
            'ConfirmPassword' => 'Confirm-Password'
        ];
    }
    public function attributes(): array
    {
        return ['ShopID','Name', 'Address', 'Email', 'ContactNo', 'Location', 'City', 'Suburb','ShopName','ShopBanner', 'ShopDesc'];
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL, self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
            'Password' => [[self::RULE_MIN,'min' => 8],self::RULE_REQUIRED],
            'ConfirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'Password']],//check if the user class has the same email or not.
            'Name' => [self::RULE_REQUIRED],
            'Address' => [self::RULE_REQUIRED],
            'ContactNo' => [self::RULE_REQUIRED, self::RULE_PHONE],
            'City' => [self::RULE_REQUIRED],
            'Suburb' => [self::RULE_REQUIRED],
            'Location' => [self::RULE_REQUIRED],
            'ShopName' => [self::RULE_REQUIRED],
            'ShopBanner' =>[self::RULE_REQUIRED],
            'ShopDesc' => [self::RULE_REQUIRED,[self::RULE_MAX,'max'=>30]]
        ];
    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }

    public function jsonarray(): array
    {
        return $this->attributes();
    }
    public function setErrors():Model{

    }
}