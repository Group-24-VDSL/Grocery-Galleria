<?php

namespace app\models;

use app\core\db\DBModel;

class Cart extends DBModel
{
    public int $CartID = 0;
    public string $DateTime = '';
    public int $CustomerID = 0;

    public static function tableName(): string
    {
        return 'cart';
    }

    public function attributes(): array
    {
        return ['DateTime','CustomerID'];
    }

    public static function primaryKey(): array
    {
        return ['CartID'];
    }

    public function rules(): array
    {
        return [
            'DateTime' => [self::RULE_REQUIRED,self::RULE_DATETIME],
            'CustomerID' => [self::RULE_REQUIRED]
        ];
    }

    public function jsonarray(): array
    {
        return ['CartID','DateTime','CustomerID'];
    }
}