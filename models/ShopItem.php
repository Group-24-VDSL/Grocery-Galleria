<?php

namespace app\models;

use app\core\db\DBModel;

class ShopItem extends DBModel
{
    public int $ItemID = 0;
    public int $ShopID = 0;
    public float $UnitPrice = 0.0;
    public float $MinStock = 1.0;
    public float $Stock = 0.0 ;
    public int $Enabled = 0 ;
    public int $MaxLeadTime = 1;
    public int $MinLeadTime = 1;

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
            'UPrice'=>'Item U/Price',
            'Enable'=>'Item Enable',
            'Image'=>'Item Image',
            'MinStock'=>'MinStock',
            'MinLead' => 'Min Lead Time',
            'MaxLead' => 'Max LeadTime'
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
            'UnitPrice' => [self::RULE_REQUIRED,self::RULE_FLOAT,[self::RULE_MIN_VAL,'minValue'=>1],[self::RULE_IF_ONLY_THEN,'class'=> Item::class,'ValMatch'=>2,'CheckAttribute1'=>'MRP','matchAttribute1'=>'Category','where'=>'ItemID']],
             'Stock' => [self::RULE_REQUIRED,self::RULE_FLOAT,[self::RULE_MIN_VAL,'minValue'=>0]],
            'MinStock' => [self::RULE_REQUIRED,self::RULE_FLOAT,[self::RULE_MIN_VAL,'minValue'=>0]],
            'MinLeadTime' => [self::RULE_REQUIRED,self::RULE_INT,[self::RULE_MIN_VAL,'minValue'=>0]],
            'MaxLeadTime' => [self::RULE_REQUIRED,self::RULE_INT,[self::RULE_MIN_VAL,'minValue'=>0]],
        ];
    }

    public function jsonarray(): array
    {
        return ['ItemID','ShopID','UnitPrice','MinStock','Stock','Enabled','MaxLeadTime','MinLeadTime'];
    }

    public function excludeonupdateattributes(): array
    {
        return [];
    }
}