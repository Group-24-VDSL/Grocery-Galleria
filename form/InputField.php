<?php

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    const TYPE_EMAIL = 'email';
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_NUMBER = 'number';
    //add more types lists, checkboxes etc


    public string $type;
    public string $value;
    public $disabled;

    public function __construct(Model $model, string $attribute,$disabled = null){
        $this->type = self::TYPE_TEXT;
        $this->disabled = $disabled;
        parent::__construct($model, $attribute);
        $this->value = $this->model->{$this->attribute};
    }


    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function numberField(){
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    public function setValue(string $value){
        $this->value = $value;
        return $this;
    }

    public function renderInput(): string
    {
       return sprintf('<input type="%s" name="%s" style="%s" value="%s" %s >',
           $this->type,
           $this->attribute,
           $this->model->hasError($this->attribute) ? "border: 1px solid red;" : '',
       $this->value,
       !is_null($this->disabled) ? "disabled" : ''
       );
    }

}