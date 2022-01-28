<?php

namespace app\models;

use app\core\UserModel;

class DeliveryStaff extends UserModel
{
    public int $DelStaffID = 0;
    public string $Name = '';
    public string $ContactNo = '';
    public string $Email = '';
    public int $City = 0;
    public int $Suburb = 0;

    public function save()
    {
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'deliverystaff'; //table name
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
            'Name' => [self::RULE_REQUIRED],
            'ContactNo'=>[self::RULE_REQUIRED,[self::RULE_MAX,'max' => 10],[self::RULE_MIN,'min' => 10]],
        ];
    }

    public function attributes(): array
    {
        return ['DelStaffID','Name','Email','ContactNo'];
    }

    public static function primaryKey():array
    {
        return ['DelStaffID'];
    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }

    public function jsonarray(): array
    {
        return $this->attributes();
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function getUserID(): int
    {
        return $this->DelStaffID;
    }

}