<?php

namespace app\models;

use app\core\db\DBModel;

class Item extends DBModel
{

    public int $ItemID;
    public string $Name = '';
    public string $ItemImage = '';
    public string $Brand = '';
    public float $UWeight = 0;
    public float $MRP = 0;

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
        return ['ItemID','Name','ItemImage','Brand','UWeight','MRP'];
    }

    public function labels(): array{
        return [
            'Name'=>'Name',
            'Address'=>'Address',
            'Email'=>'Email',
            'ContactNo'=>'Contact Number',
            'NIC'=>'National ID',
            'ProfilePic' => 'Profile Picture'
        ];
    }

    public static function primaryKey(): string
    {
        return 'ItemID';
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }
}