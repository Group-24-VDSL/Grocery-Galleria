<?php

namespace app\models;

use app\core\db\DBModel;

class Delivery extends DBModel
{
    public int $DeliveryID = 0;
    public int $RiderID = 0;
    public string $Date = '';
    public string $Status = '';
    public string $CompDate = '';
    public string $CompTime = '';
    public int $OrderID = 0;

    public static function tableName(): string
    {
        return 'delivery';
    }

    public function attributes(): array
    {
        return ['RiderID','Date','Status','CompDate','CompTime','OrderID' ];
    }

    public static function primaryKey(): array
    {
        return ['DeliveryID'];
    }

    public function rules(): array
    {
        return [];
    }

    public function jsonarray(): array
    {
        return $this->attributes();
    }

    public function excludeonupdateattributes(): array
    {
        return [];
    }
}