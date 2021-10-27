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
    public string $interaction ='';

    public function __construct(Model $model, string $attribute,$classes=[]){
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->classes=$classes;
        $this->value = $this->model->{$this->attribute};

    }
    public function hasNoError(){
        return empty($this->model->hasError($this->attribute));
    }
    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailField()
    {
        $this->type =self::TYPE_EMAIL;
        return $this;
    }

    public function numberField(){
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    public function hiddenField()
    {
        $this->type =self::TYPE_HIDDEN;
        return $this;
    }

    public function setStyle(): string
    {
        return $this->hasNoError()? "" : "border: .1rem solid red;";
    }

    public function setValue(string $value){
        $this->value =$value;
        return $this;
    }

    public function setInteraction(string $interaction)
    {
        $this->interaction = $interaction;
        return $this;
    }
    public function __toString()
    {
        return sprintf('
    <input type="%s" id="%s" name="%s" style="%s" value="%s" class="%s" %s >
    <div><small style="color: red">%s</small></div>
    ',
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->setStyle(),
            $this->value,
            $this->classes ? implode(" ",$this->classes): "",
            $this->interaction,
            $this->model->getFirstError($this->attribute)
        );
    }
}