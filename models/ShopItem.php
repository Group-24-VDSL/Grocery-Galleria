<?php

namespace app\models;

use app\core\db\DBModel;

class ShopItem extends DBModel
{
    public int $ItemID = 0;
    public int $ShopID = 0;
    public float $UnitPrice = 0.0;
    public float $Stock = 0.0 ;
    public int $Enabled = 0 ;
    public int $MaxLeadTime = 1;
    public int $MinLeadTime = 1;
    public float $MinStock = 1;

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
        return ['ItemID','ShopID','UnitPrice','Stock','Enabled','MaxLeadTime','MinLeadTime','MinStock'];
    }

    public function labels(): array{
        return [
            'ItemID'=>'Item ID',
            'Name'=>'Item Name',
            'Stock'=>'Item Stock',
            'UPrice'=>'Item Unit Price',
            'Enable'=>'Item Enable',
            'Image'=>'Item Image',
            'MinStock'=>'Minimum Stock'
        ];
    }

    public static function primaryKey(): array
    {
        return ['ShopID','ItemID'] ;
    }

    public function rules(): array
    {
        return [
            'ShopID'=> [self::RULE_REQUIRED],
            'UnitPrice' => [self::RULE_REQUIRED,self::RULE_FLOAT,[self::RULE_MIN_VAL,'minValue'=>0],[self::RULE_MAX_VAL_CLASS,'class'=> Item::class,'checkattribute'=>'MRP','where'=>'ItemID']],
            'Stock' => [self::RULE_FLOAT,[self::RULE_MIN_VAL,'minValue'=>0]],
            'MinStock' => [[self::RULE_REQUIRED,self::RULE_FLOAT,[self::RULE_MIN_VAL,'minValue'=>1]]]
        ];
    }

    public function jsonarray(): array
    {
        return ['ItemID','ShopID','UnitPrice','Stock','Enabled','MaxLeadTime','MinLeadTime','MinStock'];
    }

    public function excludeonupdateattributes(): array
    {
        return [];
    }
}