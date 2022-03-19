<?php

namespace app\models;

use app\core\db\DBModel;

class OrderCart extends DBModel
{
    public int $CartID = 0;
    public int $ShopID = 0;
    public int $CustomerID = 0 ;
    public int $ItemID = 0;
    public int $Quantity = 0;
    public float $ShopTotal = 0 ;

    public static function tableName(): string
    {
        return 'ordercart';
    }

    public function attributes(): array
    {
        return ['ShopID','CustomerID','ItemID','Quantity','ShopTotal'];
    }

    public static function primaryKey(): array
    {
        return ['CartID'];
    }

    public function rules(): array
    {
        return [
            'ItemID' => [self::RULE_REQUIRED,self::RULE_INT],
            'CustomerID' => [self::RULE_REQUIRED,self::RULE_INT,[self::RULE_IFEXISTS,'class'=> Customer::class,'attribute' => 'CustomerID']],
            'Quantity' => [self::RULE_REQUIRED,[self::RULE_MIN_VAL,'minValue'=> 0]],
            'Total' => [self::RULE_REQUIRED,self::RULE_FLOAT,[self::RULE_MIN_VAL,'minValue'=> 0.0]]
        ];
    }

    public function jsonarray(): array
    {
        return ['CartID','ShopID','CustomerID','ItemID','Quantity','ShopTotal'];
    }

    public function excludeonupdateattributes(): array
    {
        return [];
    }
}