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
        $this->type = empty($this->model->hasError($this->attribute))? self::TYPE_PASSWORD:self::TYPE_TEXT ;
        return $this;
    }

    public function emailField()
    {
        $this->type =empty($this->model->hasError($this->attribute))? self::TYPE_EMAIL: self::TYPE_TEXT;
        return $this;
    }

    public function numberField(){
        $this->type = empty($this->model->hasError($this->attribute))? self::TYPE_NUMBER:self::TYPE_TEXT ;
        return $this;
    }

    public function hiddenField()
    {
        $this->type = empty($this->model->hasError($this->attribute))? self::TYPE_HIDDEN:self::TYPE_TEXT;
        return $this;
    }

    public function setValue(string $value){
        return $this->value =  empty($this->model->hasError($this->attribute))?$this->model->{$this->attribute}: $this->model->getFirstError($this->attribute);
//        return $this;
    }
    public function setStyle(): string
    {
        return empty($this->model->hasError($this->attribute))? "" : "border: .1rem solid red;";
    }

    public function __toString()
    {
        return sprintf('<input type="%s" name="%s" style="%s" value="%s" class="%s" >',
            $this->type,
            $this->attribute,
            $this->setStyle(),
            $this->setValue($this->value),
            $this->classes ? implode(" ",$this->classes): ""
        );
    }
}