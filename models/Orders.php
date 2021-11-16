<?php

namespace app\models;

use app\core\db\DBModel;

class Orders extends DBModel
{
    public int $OrderID = 0;
    public string $OrderDate = '';
    public int $CartID = 0;
    public float $DeliveryCost = 0;
    public float $TotalCost = 0;


    public static function tableName(): string
    {
        return 'orders';
    }

    public function attributes(): array
    {
        return ['OrderDate','CartID','DeliveryCost','TotalCost'];
    }

    public static function primaryKey(): array
    {
        return ['OrderID'];
    }

    public function rules(): array
    {
        return [
            'OrderID'=> [self::RULE_REQUIRED,self::RULE_INT],
            'CartID'=> [self::RULE_REQUIRED,self::RULE_INT],
            'DeliveryCost' => [self::RULE_REQUIRED,self::RULE_FLOAT] ,
            'TotalCost' => [self::RULE_REQUIRED,self::RULE_FLOAT]
        ];
    }

    public function jsonarray(): array
    {
        return ['OrderID','CartID','DeliveryCost','TotalCost'];
    }
}