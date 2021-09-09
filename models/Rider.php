<?php

namespace app\models;

class Rider extends \app\core\UserModel
{
    //
    public int $RiderID;
    public string $Name = '';
    public string $Address = '';
    public string $Email = '';
    public string $ContactNo = '';
    public string $NIC = '';
    public string $ProfilePic = '';


    public static function tableName(): string
    {
        return 'deliveryrider';
    }

    public function attributes(): array
    {
        return ['Name','Address','Email','ContactNo','NIC','ProfilePic'];
    }

    public static function primaryKey(): string
    {
        return 'RiderID';
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }
}