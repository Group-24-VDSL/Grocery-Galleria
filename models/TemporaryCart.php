<?php

namespace app\models;

use app\core\db\DBModel;

class TemporaryCart extends DBModel
{
    public int $ItemID=0;
    public int $ShopID=0;
    public int $CustomerID=0;
    public float $Quantity=0;
    public int $Purchased=0;

    public static function tableName(): string
    {
        return 'temporarycart';
    }

    public function attributes(): array
    {
        return ['ItemID','ShopID', 'CustomerID', 'Quantity','Purchased'];
    }

    public static function primaryKey(): string
    {
        return '';
    }

    public function rules(): array
    {
        return [
            'ItemID' => [self::RULE_REQUIRED],
            'ShopID' => [self::RULE_REQUIRED],
            'CustomerID' => [self::RULE_REQUIRED],
            'Quantity' => [self::RULE_REQUIRED,[self::RULE_MAX_VAL_CLASS,'class'=>Item::class,'checkattribute'=>'MaxCount','where'=>'ItemID']] //max quantity check :)
        ];
    }

    public function jsonarray(): array
    {
        return ['ItemID','ShopID', 'CustomerID', 'Quantity'];
    }
}