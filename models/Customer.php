<?php

namespace app\models;


use app\core\UserModel;

class Customer extends UserModel
{
    public int $CustomerID = 0;
    public string $Name = '';
    public string $Address = '';
    public string $ContactNo = '';
    public string $Location = '';
    public string $PlaceID = '';

    public string $Email = '';
    public string $Password = '';
    public string $ConfirmPassword = '';

    public function save()
    {
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'customer'; //table name
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
            'Password' => [[self::RULE_MIN,'min' => 8],self::RULE_REQUIRED],
            'ConfirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'Password']],
            'Name' => [self::RULE_REQUIRED],
            'Address'=>[self::RULE_REQUIRED],
            'ContactNo'=>[self::RULE_REQUIRED],
            'City'=>[self::RULE_REQUIRED],
            'Suburb' =>[self::RULE_REQUIRED],
            'Location'=>[self::RULE_REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['CustomerID','Name','Address','Email','ContactNo','City','Suburb','Location','PlaceID'];
    }

    public static function primaryKey():array
    {
        return ['CustomerID'];
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
        return $this->CustomerID;
    }
}