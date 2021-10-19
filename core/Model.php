<?php

namespace app\core;

use JsonSerializable;
use app\models\Item;
use PDO;

abstract class Model implements JsonSerializable
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_INT = 'int';
    public const RULE_PHONE = 'phone';
    public const RULE_FLOAT = 'float';
    public const RULE_ONEOF = 'oneof'; //input should be one of the items in the given array.
    public const RULE_NIC = 'nic';
    public const RULE_MIN_VAL = 'minValue';
    public const RULE_MAX_VAL = 'maxValue';
    public const RULE_MRP = 'MRP';
    public const RULE_MAX_VAL_CLASS = 'maxValueClass';

    public const REGEXP_PHONE_NL = "/(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)/";
    public const REGEXP_NIC = "/([0-9]){9}V$|(^(19[0-9][0-9]|20[0-9][0-9])([0-9]){8}$)/";

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if (gettype($this->{$key}) === "double" || gettype($this->{$key}) === "integer") { //ints or floats
                    if (filter_var($value, FILTER_VALIDATE_FLOAT) && gettype($this->{$key}) === "double") {
                        $this->{$key} = (float)$value; //value is float.
                    } elseif (filter_var($value, FILTER_VALIDATE_INT) && gettype($this->{$key}) === "integer") {
                        $this->{$key} = (int)$value; //value is int.
                    }
                } else {
                    $this->{$key} = $value; //assign key = value in the model class
                }
            }
        }
    }

    abstract public function rules(): array;

    public array $errors = [];

    abstract public function jsonarray(): array;

    private function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? ''; //get the error message for the rule
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;

    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'You have already used this {field}',
            self::RULE_INT => 'This field should only contain numbers',
            self::RULE_FLOAT => 'This field should be a float',
            self::RULE_PHONE => 'This field should be a valid phone number',
            self::RULE_ONEOF => 'Invalid Value Given',
            self::RULE_NIC => 'Invalid NIC',
            self::RULE_MIN_VAL => 'Min value of this field must greater than {minValue}',
            self::RULE_MAX_VAL => 'Max value of this field must be {maxValue}',
            self::RULE_MRP => 'Unit Price Should be less than or equal to MRP',
            self::RULE_MAX_VAL_CLASS => 'Value should be less than {maxValue}'
        ];
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value && $value !== 0 && $value !== '0') {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) { //remove this in production
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_INT && !filter_var($value, FILTER_VALIDATE_INT)) {
                    $this->addErrorForRule($attribute, self::RULE_INT);
                }
                if ($ruleName === self::RULE_FLOAT && !filter_var($value, FILTER_VALIDATE_FLOAT)) {
                    $this->addErrorForRule($attribute, self::RULE_FLOAT);
                }
                if ($ruleName === self::RULE_PHONE && !filter_var($value, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => self::REGEXP_PHONE_NL)))) {
                    $this->addErrorForRule($attribute, self::RULE_PHONE);
                }
                if ($ruleName === self::RULE_NIC && !filter_var(strtoupper($value), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => self::REGEXP_NIC)))) {
                    $this->addErrorForRule($attribute, self::RULE_NIC);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorForRule($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
                }
                if ($ruleName === self::RULE_ONEOF && !in_array($value, $rule['oneof'], true)) {
                    $this->addErrorForRule($attribute, self::RULE_ONEOF);
                }
                if ($ruleName === self::RULE_MIN_VAL && $value < (float)(is_string($rule['minValue']) ? $this->{$rule['minValue']} : $rule['minValue'])) {
                    $this->addErrorForRule($attribute, self::RULE_MIN_VAL, ['minValue' => is_string($rule['minValue']) ? $this->{$rule['minValue']} : $rule['minValue']]);//$this->>Uweight;
                }
                if ($ruleName === self::RULE_MAX_VAL && $value > (float)(is_string($rule['maxValue']) ? $this->{$rule['maxValue']} : $rule['maxValue'])) {
                    $this->addErrorForRule($attribute, self::RULE_MAX_VAL, ['maxValue' => is_string($rule['maxValue']) ? $this->{$rule['maxValue']} : $rule['maxValue']]);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqAttribute = $rule['attribute'] ?? $attribute; //if the rule has a diffrent class and a attribute to match
                    $tableName = $className::tableName();
                    $db = Application::$app->db;
                    $statement = $db->prepare("SELECT * FROM $tableName WHERE $uniqAttribute = :$attribute");
                    $statement->bindValue(":$attribute", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute)]);
                    }
                }

                if($ruleName===self::RULE_MAX_VAL_CLASS){
                    $className = $rule['class'];
                    $checkAttribute = $rule['checkattribute']; //if the rule has a different class and a attribute to match
                    $where = $rule['where'];
                    $tableName = $className::tableName();

                    $db = Application::$app->db;
                    $statement = $db->prepare("SELECT $checkAttribute FROM $tableName WHERE $where = :$where");
                    $statement->bindValue(":$where", $this->{$where});
                    $statement->execute();
                    $record = $statement->fetch(PDO::FETCH_ASSOC);
                    if($record){
                        if($this->{$attribute} > $record[$checkAttribute]){
                            $this->addErrorForRule($attribute, self::RULE_MAX_VAL_CLASS, ['maxValue' => $record[$checkAttribute]]);
                        }
                    }

                }




            }
        }
        return empty($this->errors);
    }

    public function labels()
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute) //get the first error of the array for the attribute.
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function jsonSerialize()
    {
        $attributes = $this->jsonarray();
        $dataobj = [];
        foreach ($attributes as $attribute) {
            $dataobj += [$attribute => $this->{$attribute}];
        }
        return $dataobj;
    }

}