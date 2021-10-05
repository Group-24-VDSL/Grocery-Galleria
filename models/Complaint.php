<?php

namespace app\models;

use app\core\db\DBModel;

class Complaint extends DBModel
{
    public int $ComplaintID = 0;
    public int $CustomerID = 0;
    public int $StaffID = 0;
    public int $OrderID = 0;
    public string $Description = '';
    public string $Date = '';

    public static function tableName(): string
    {
        return 'complaint';
    }

    public function attributes(): array
    {
        return ['CustomerID','StaffID','OrderID','Description','Date'];
    }

    public static function primaryKey(): string
    {
        return 'ComplaintID';
    }

    public function rules(): array
    {
        return [
            'Description' => [self::RULE_REQUIRED]
        ];
    }

    public function jsonarray(): array
    {
        return $this->attributes();
    }
}