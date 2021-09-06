<?php

namespace app\core\form;

use app\core\Model;

class InputFieldOnly
{
    const TYPE_EMAIL = 'email';
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password'; //add more types lists, checkboxes etc

    public string $type;

    public Model $model;
    public string $attribute;
    public $classes = [];

    public function __construct(Model $model, string $attribute,$classes=[]){
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->classes=$classes;
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

    public function __toString()
    {
        return sprintf('<input type="%s" name="%s" style="%s" value="%s" class="%s">',
            $this->type,
            $this->attribute,
            $this->model->hasError($this->attribute) ? "border: 1px solid red;" : '',
            $this->model->{$this->attribute},
            $this->classes ? implode(" ",$this->classes): ""
        );
    }
}