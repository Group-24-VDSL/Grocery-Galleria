<?php

namespace app\models;

use app\core\UserModel;

class Rider extends UserModel
{
    //
    public int $RiderID = 0;
    public string $Name = '';
    public string $Address = '';
    public string $Email = '';
    public string $ContactNo = '';
    public string $Password = ''; //need this two
    public string $ConfirmPassword = ''; //need this two
    public string $NIC = '';
    public string $ProfilePic = '';
    public int $RiderType = 0; //0 = bike , 1 = threewheel


    public static function tableName(): string
    {
        return 'deliveryrider';
    }

    public function attributes(): array
    {
        return ['RiderID','Name','Address','Email','ContactNo','NIC','ProfilePic','City','Suburb','RiderType'];
    }

    public function labels(): array{
        return [
            'Name'=>'Name',
            'Address'=>'Address',
            'Email'=>'Email',
            'ContactNo'=>'Contact Number',
            'NIC'=>'National ID',
            'ProfilePic' => 'Profile Picture',
            'RiderType' => 'Vehicle Type',
            'Password' => 'Enter password',
            'ConfirmPassword'=> 'Confirm password',
            'City' => 'City',
            'Suburb' => 'Suburb'
        ];
    }

    public static function primaryKey(): array
    {
        return ['RiderID'];
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
            'Name' => [self::RULE_REQUIRED],
            'Address'=>[self::RULE_REQUIRED],
            'ContactNo'=>[self::RULE_REQUIRED, self::RULE_PHONE],
            'NIC' =>[self::RULE_REQUIRED,self::RULE_NIC],
            'City' =>[self::RULE_REQUIRED],
            'Suburb' =>[self::RULE_REQUIRED]
        ];
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
        return $this->RiderID;
    }
}