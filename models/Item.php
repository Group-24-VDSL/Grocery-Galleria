<?php

namespace app\models;

use app\core\db\DBModel;

class Item extends DBModel
{

    public int $ItemID = 0;
    public string $Name = '';
    public string $ItemImage = '';
    public string $Brand = '';
    public float $UWeight = 0;
    public int $Unit = 0; //[kg = 0, g = 1, l = 2]
    public float $MRP = 0;
    public int $Category = 0;//['0'=>'Grocery','1'=>'Vegetable','2'=>'Meat','3'=>'Fruit']
    public float $MaxCount = 0;

    public function save()
    {
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'item';
    }

    public function attributes(): array
    {
        return ['Name','ItemImage','Brand','UWeight','Unit','MRP','MaxCount','Category'];
    }

    public function labels(): array{
        return [
            'Name'=>'Item Name',
            'ItemImage'=>'Item Image',
            'Brand'=>'Brand (if any)',
            'UWeight'=>'Unit Weight',
            'Unit'=>'Unit',
            'MRP'=>'Maximum Retail Price(MRP)',
            'MaxCount' => 'Maximum Count'
        ];
    }

    public static function primaryKey(): string
    {
        return 'ItemID';
    }

    public function rules(): array
    {
        return [
            'Name' => [self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]],
            'UWeight' => [self::RULE_REQUIRED,[self::RULE_MIN,'min'=>0]],
            'MRP' => [[self::RULE_MIN,'min'=>0]],
            'MaxCount' => [[self::RULE_MIN,'min'=> 0]],
            'Unit' => [self::RULE_REQUIRED,[self::RULE_ONEOF,'oneof'=>[0,1,2]]],
            'Category' => [self::RULE_REQUIRED,[self::RULE_ONEOF,'oneof'=>[0,1,2,3]]]
        ];
    }

    public function jsonarray(): array
    {
        return ['ItemID','Name','ItemImage','Brand','UWeight','Unit','MRP','MaxCount','Category'];
    }
}