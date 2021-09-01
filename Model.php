<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public function loadData($data){
        foreach ($data as $key => $value){
            if(property_exists($this,$key)){
                $this->{$key} = $value; //assign key = value in the model class
            }
        }
    }

    abstract public function rules():array;

    public array $errors = [];

    private function addErrorForRule(string $attribute, string $rule,$params =[]){
        $message = $this->errorMessages()[$rule]?? ''; //get the error message for the rule
//        var_dump($params);
        foreach ($params as $key => $value){
            $message = str_replace("{{$key}}",$value,$message);
        }
        $this->errors[$attribute][] = $message;

    }
    public function addError(string $attribute, string $message){
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages():array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE=> 'You have already used this {field}'
        ];
    }

    public function validate(){
        foreach($this->rules() as $attribute =>  $rules){
            $value = $this->{$attribute};
            foreach ($rules as $rule){
                $ruleName = $rule;
                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED && !$value){
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL)){
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
                    $this->addErrorForRule($attribute, self::RULE_MIN,$rule);
                }
                if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']){ //remove this in production
                    $this->addErrorForRule($attribute, self::RULE_MAX,$rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorForRule($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqAttribute = $rule['attribute'] ?? $attribute ; //if the rule has a diffrent class and a attribute to match
                    $tableName = $className::tableName();
                    $db = Application::$app->db;
                    $statement = $db->prepare("SELECT * FROM $tableName WHERE $uniqAttribute = :$attribute");
                    $statement->bindValue(":$attribute", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE,['field' => $this->getLabel($attribute)]);
                    }
                }

            }
        }
        return empty($this->errors);
    }

    public function labels(){
        return [];
    }

    public function getLabel($attribute){
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function hasError($attribute){
        return $this->errors[$attribute] ?? false;
    }
    public function getFirstError($attribute) //get the first error of the array for the attribute.
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }

}