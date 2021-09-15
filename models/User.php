<?php

namespace app\models;



use app\core\UserModel;

class User extends UserModel
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 1;
    const STATUS_NOTDELETED = 0;

    public string $Email = '';
    public string $Password = ''; //always have to use capitalized names
    public string $PasswordHash = '';
    public string $Name = '';
    public int $Verify_Flag = self::STATUS_INACTIVE; //email is not validated
    public int $Delete_Flag = self::STATUS_NOTDELETED;
    public int $UserID = 0;
    public string $Role = '';
    public string $ConfirmPassword = '';


    public function save()
    {
        $this->PasswordHash = password_hash($this->Password,PASSWORD_BCRYPT);
        return parent::save(); //call the parent DBModel::save
    }

    public static function tableName(): string
    {
        return 'login'; //table name
    }

    public function rules(): array
    {
        return [
            'Email' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_UNIQUE,'class'=> self::class]], //check if the user class has the same email or not.
            'Password' => [[self::RULE_MIN,'min' => 8],self::RULE_REQUIRED],
            'ConfirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'Password']]
        ];
    }

    public function attributes(): array
    {
        return ['Email','PasswordHash','Verify_Flag','Delete_Flag','Role'];
    }

    public function labels(): array{
        return [
            'Email' => 'Email',
            'Password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public static function primaryKey():string
    {
        return 'UserID';
    }



    public function getDisplayName(): string
    {
        return $this->Name;
    }
}