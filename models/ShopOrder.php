<?php

namespace app\models;

use app\core\db\DBModel;

class ShopOrder extends DBModel
{
    public int $ShopID = 0;
    public int $CartID = 0;
    public string $Date = '';
    public float $ShopTotal = 0;
    public int $Status = 0 ;

    public static function tableName(): string
    {
        return 'shoporder';
    }

    public function attributes(): array
    {
        return ['ShopID','CartID','Date','ShopTotal','Status'];
    }

    public static function primaryKey(): array
    {
        return ['ShopID','CartID'];

    }

    public function rules(): array
    {
       return [
           'ShopID'=>[self::RULE_REQUIRED],
           'CartID'=>[self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]],
           'Date'=>[self::RULE_REQUIRED],
           'ShopTotal' => [self::RULE_REQUIRED]
       ];
    }

    public function jsonarray(): array
    {
        return $this->attributes();
    }
}