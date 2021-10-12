<?php

namespace app\models;

use app\core\db\DBModel;

class Complaint extends DBModel
{
    public int $ComplaintID = 0;
    public int $CustomerID = 0;
    public string $ComplaintDate = '';
    public int $OrderID = 0;
    public string $OrderDate = '';
    public int $Regarding = 0 ; /**[0-shop , 1-delivery] */
    public int $Priority = 0; /**[0-high , 1-low] */
    public int $Status = 0; /**[0-new , 1-attended] */
    public string $Nature = '';
    public string $SpecialDetails = '';

    public static function tableName(): string
    {
        return 'complaint';
    }

    public function attributes(): array
    {
        return ['ComplaintDate','OrderID','OrderDate','Regarding','Priority','Status','Nature','SpecialDetails'];
    }

    public static function primaryKey(): string
    {
        return 'ComplaintID';
    }

    public function rules(): array
    {
        return [
            'Nature' => [self::RULE_REQUIRED]
        ];
    }

    public function jsonarray(): array
    {
        return $this->attributes();
    }
}