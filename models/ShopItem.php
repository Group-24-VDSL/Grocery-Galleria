<?php

namespace app\models;

use app\core\db\DBModel;

class ShopItem extends DBModel
{
    public int $ItemID = 0;
    public int $ShopID = 0;
    public float $UnitPrice = 0.0;
    public float $Stock = 0;
    public int $Enabled = 0;

    public static function tableName(): string
    {
        return 'shopitem';
    }

    public function attributes(): array
    {
        return ['ItemID','ShopID','UnitPrice','Stock','Enabled'];
    }

    public static function primaryKey(): string
    {
//        return ['ItemID','ShopID'];
        return '';
    }

    public function rules(): array
    {
        return [
            'UnitPrice' => [self::RULE_REQUIRED,self::RULE_INT,[self::RULE_MIN_VAL,'minValue'=>0],self::RULE_MRP],
            'Stock' => [[self::RULE_MIN_VAL,'minValue'=>5]]
        ];
    }

    public function jsonarray(): array
    {
        return ['ItemID','ShopID','UnitPrice','Stock','Enabled'];
    }
}