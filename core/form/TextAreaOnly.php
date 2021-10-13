<?php

namespace app\core\form;

use app\core\Model;

class TextAreaOnly
{

    public Model $model;
    public string $attribute;
    public $classes = [];

    public function __construct(Model $model, string $attribute, $classes = [])
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->classes = $classes;
    }

    public function __toString()
    {

        return sprintf('
<textarea  name="%s" class="%s">%s</textarea>
<div><small style="color: red">%s</small></div>',
            $this->attribute,
            $this->classes ? implode(" ",$this->classes): "",
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)
        );
    }