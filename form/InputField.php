<?php

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    const TYPE_EMAIL = 'email';
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password'; //add more types lists, checkboxes etc
    const TYPE_NUMBER = 'number';
    const TYPE_RADIO = 'radio';
    CONST TYPE_DATE = 'date' ;


    public string $type;

    public function __construct(Model $model, string $attribute){
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
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

    public function renderInput(): string
    {
       return sprintf('<input type="%s" name="%s" value="%s" style="%s">
<div><small style="color: red">%s</small></div>',
           $this->type,
           $this->attribute,
           $this->model->{$this->attribute},
           $this->model->hasError($this->attribute) ? "border: 1px solid red;" : '',
           $this->model->getFirstError($this->attribute)

       );
    }
}