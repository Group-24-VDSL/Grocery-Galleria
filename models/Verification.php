<?php

namespace app\models;

use app\core\db\DBModel;

class Verification extends DBModel
{
    public int $UserID = 0;
    public string $VerificationCode = '';
    public string $UniqueID = '';

    public static function tableName(): string
    {
        return 'verification';
    }

    public function attributes(): array
    {
        return ['UserID', 'VerificationCode', 'UniqueID'];
    }

    public static function primaryKey(): array
    {
        return ['UserID'];
    }

    public function rules(): array
    {
        return [
            'UserID' => [[self::RULE_UNIQUE,'class'=> self::class]],
            'VerificationCode' => [[self::RULE_UNIQUE,'class'=> self::class]],
            'UniqueID' => [[self::RULE_UNIQUE,'class'=> self::class]]
        ];
    }

    public function jsonarray(): array
    {
        return [];
    }

    public function excludeonupdateattributes(): array
    {
        return [];
    }
}