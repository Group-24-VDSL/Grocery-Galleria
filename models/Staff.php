<?php

namespace app\models;

use app\core\UserModel;


class Staff extends UserModel
{

    public int $StaffID = 0;
    public string $Name = '';
    public string $ContactNo = '';
    public string $Email = '';

    public function save()
    {
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'staff'; //table name
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
            'Password' => [[self::RULE_MIN,'min' => 8]],
            'ConfirmPassword' => [[self::RULE_MATCH,'match' => 'Password']],
            'Name' => [self::RULE_REQUIRED],
            'ContactNo'=>[self::RULE_REQUIRED,[self::RULE_MAX,'max' => 10],[self::RULE_MIN,'min' => 10]],
        ];
    }

    public function attributes(): array
    {
        return ['StaffID','Name','Email','ContactNo'];
    }

    public static function primaryKey():array
    {
        return ['StaffID'];
    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }

    public function jsonarray(): array
    {
        return $this->attributes();
    }
}