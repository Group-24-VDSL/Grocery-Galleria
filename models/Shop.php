<?php

namespace app\models;

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

    public static function tableName(): string
    {
        return 'shop';
    }

    public static function primaryKey(): string
    {
        return 'ShopID';
    }

    public function attributes(): array
    {
        return ['ShopID','Name', 'Address', 'Email', 'ContactNo', 'Location', 'City', 'Suburb', 'Location','ShopName', 'ShopDesc', 'ShopBanner'];
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL, self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]], //check if the user class has the same email or not.
            'Name' => [self::RULE_REQUIRED],
            'Address' => [self::RULE_REQUIRED],
            'ContactNo' => [self::RULE_REQUIRED, self::RULE_PHONE],
            'City' => [self::RULE_REQUIRED],
            'Suburb' => [self::RULE_REQUIRED],
            'Location' => [self::RULE_REQUIRED],
            'ShopName' => [self::RULE_REQUIRED],
            'ShopDesc' => [self::RULE_REQUIRED],
            'ShopBanner' => [self::RULE_REQUIRED]
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
}