<?php

namespace app\core\form;

use app\core\Model;

class InputFieldOnly
{
    const TYPE_EMAIL = 'email';
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_NUMBER = 'number';
    const TYPE_HIDDEN = 'hidden'; //add more types lists, checkboxes etc

    public string $type;

    public Model $model;
    public string $attribute;
    public string $value;
    public $classes = [];

    public function __construct(Model $model, string $attribute,$classes=[]){
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->classes=$classes;
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

    public function hiddenField()
    {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }

    public function setValue(string $value){
        $this->value = $value;
        return $this;
    }

    public function __toString()
    {
        return sprintf('<input type="%s" name="%s" style="%s" value="%s" class="%s" >',
            $this->type,
            $this->attribute,
            $this->model->hasError($this->attribute) ? "border: 1px solid red;" : '',
            $this->value,
            $this->classes ? implode(" ",$this->classes): ""
        );
    }
}