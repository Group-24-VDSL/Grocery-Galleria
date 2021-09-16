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
    public float $MRP = 0;
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
        return ['Name','ItemImage','Brand','UWeight','MRP','MaxCount'];
    }

    public function labels(): array{
        return [
            'Name'=>'Item Name',
            'ItemImage'=>'Item Image',
            'Brand'=>'Brand (if any)',
            'UWeight'=>'Unit Weight',
            'MRP'=>'Maximum Retail Price(MRP)',
            'ProfilePic' => 'Profile Picture',
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
            'Name' => [self::RULE_REQUIRED]
        ];
    }
}