<?php

namespace app\models;

use app\core\db\DBModel;

class Item extends DBModel
{

    public int $ItemID = 0;
    public string $Name = '';
    public string $ItemImage = '';
    public string $Brand = '';
    public float $UWeight = 0.0;
    public int $Unit = 0; //[kg = 0, g = 1, l = 2]
    public float $MRP = 0.0;
    public int $Category = 0;//['0'=>'Vegetables','1'=>'Fruits','2'=>'Grocery','3'=>'Fish','4'=>'Meat']
    public int $MaxCount = 0; // cabbage: (250g/Unit)*8 = 2000g(max selling weigh) // MaxCount=8

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
            'Name'=>'Product Name',
            'ItemImage'=>'Item Image',
            'Brand'=>'Brand (if any)',
            'UWeight'=>'Unit Weight in gram',
            'Unit'=>'Unit',
            'Category'=>'Category',
            'MRP'=>'Maximum Retail Price(MRP)',
            'MaxCount' => 'Max Count'
        ];
    }

    public static function primaryKey(): array
    {
        return ['ItemID'];
    }

    public function rules(): array
    {
        return [
            'Name' => [self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]],
            'UWeight' => [self::RULE_REQUIRED,[self::RULE_MIN_VAL,'minValue'=>0]],
            'MRP' => [[self::RULE_MIN,'min'=>0]],
            'MaxCount' => [[self::RULE_MIN_VAL,'minValue'=>0],[self::RULE_MAX_VAL,'maxValue'=>50]],
            'Unit' => [self::RULE_REQUIRED,[self::RULE_ONEOF,'oneof'=>[0,1,2,3,4]]],
            'Category' => [self::RULE_REQUIRED,[self::RULE_ONEOF,'oneof'=>[0,1,2,3,4]]]
        ];
    }

    public function jsonarray(): array
    {
        return ['ItemID','Name','ItemImage','Brand','UWeight','Unit','MRP','MaxCount','Category'];
    }

}