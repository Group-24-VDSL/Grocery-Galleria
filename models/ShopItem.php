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

    public function save()
    {
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'shopitem';
    }

    public function attributes(): array
    {
        return ['ItemID','ShopID','UnitPrice','Stock','Enabled'];
    }

    public static function primaryKey(): array
    {
        return ['ShopID','ItemID'] ;
    }

    public function rules(): array
    {
        return [
            'UnitPrice' => [self::RULE_REQUIRED,self::RULE_INT,[self::RULE_MIN_VAL,'minValue'=>0],[self::RULE_MAX_VAL_CLASS,'class'=> Item::class,'checkattribute'=>'MRP','where'=>'ItemID']],
            'Stock' => [[self::RULE_MIN_VAL,'minValue'=>5]]
        ];
    }

    public function jsonarray(): array
    {
        return ['ItemID','ShopID','UnitPrice','Stock','Enabled'];
    }
}