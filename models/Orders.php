<?php

namespace app\models;

use app\core\db\DBModel;

class Orders extends DBModel
{
    public int $OrderID = 0;
    public string $OrderDate = '';
    public int $CartID = 0;
    public string $CustomerID = '' ;
    public float $DeliveryCost = 0;
    public string $RecipientName='';
    public string $Note = '';
    public float $RecipientContact = 0;
    public float $TotalCost = 0;
    public int $Status = 0 ; /**[0-new , 1-completed] */


    public static function tableName(): string
    {
        return 'orders';
    }

    public function attributes(): array
    {
        return ['OrderDate','CartID','CustomerID','DeliveryCost','TotalCost','Status'];
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
            'DeliveryCost' => [self::RULE_REQUIRED,self::RULE_FLOAT],
            'RecipientContact'=>[self::RULE_PHONE],
            'TotalCost' => [self::RULE_REQUIRED,self::RULE_FLOAT],
            'Status' => [self::RULE_INT, self::RULE_REQUIRED]
        ];
    }

    public function jsonarray(): array
    {
        return ['OrderID','CartID','CustomerID','DeliveryCost','OrderDate','TotalCost','Status'];
    }
}