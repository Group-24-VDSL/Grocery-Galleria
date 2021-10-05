<?php

namespace app\models;

use app\core\db\DBModel;

class Cart extends DBModel
{
    public int $CartID;
    public string $Date = '';
    public string $Time = '';
    public int $CustomerID = 0;

    public static function tableName(): string
    {
        return 'cart';
    }

    public function attributes(): array
    {
        return ['Date','Time','CustomerID'];
    }

    public static function primaryKey(): string
    {
        return 'CartID';
    }

    public function rules(): array
    {
        return [
            'Date' => [self::RULE_REQUIRED],
            'Time' => [self::RULE_REQUIRED],
            'CustomerID' => [self::RULE_REQUIRED]
        ];
    }

    public function jsonarray(): array
    {
        return ['CartID','Date','Time','CustomerID'];
    }
}