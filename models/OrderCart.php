<?php

namespace app\models;

use app\core\db\DBModel;

class OrderCart extends DBModel
{
    public int $CartID = 0;
    public int $ShopID = 0;
    public string $ItemIDList = '';
    public int $CustomerID = 0;
    public string $QuantityList = '';
    public float  $ShopTotal = 0;

    public static function tableName(): string
    {
        return 'ordercart';
    }

    public function attributes(): array
    {
        return ['ShopID','ItemIDList','CustomerID','QuantityList','ShopTotal'];
    }

    public static function primaryKey(): string
    {
        return 'CartID';
    }

    public function rules(): array
    {
        return [
            'ItemIDList' => [self::RULE_REQUIRED],
            'CustomerID' => [self::RULE_REQUIRED,self::RULE_INT],
            'QuantityList' => [self::RULE_REQUIRED],
            'ShopTotal' => [self::RULE_REQUIRED,self::RULE_FLOAT]
        ];
    }

    public function jsonarray(): array
    {
        return ['CartID','ShopID','ItemIDList','CustomerID','QuantityList','ShopTotal'];
    }
}