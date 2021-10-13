<?php

namespace app\core\form;

use app\core\Model;

class InputFile
{
    public Model $model;
    public string $attribute;
    public string $accept;
    public array $class;


    public function __construct(Model $model, string $attribute,array $class = [] ,string $accept=''){
        $this->model = $model;
        $this->attribute = $attribute;
        $this->accept= $accept;
        $this->class = $class;
    }

    public function __toString(): string
    {
        return sprintf('<input type="file" name="%s" id="%s" class="%s" accept="%s">
<div><small style="color: red">%s</small></div>',
            $this->attribute,
            $this->attribute,
            $this->class ? implode(" ",$this->class): "",
//            $this->model->{$this->attribute} ?? '/img/placeholder-150.png',
            $this->accept,
            $this->model->getFirstError($this->attribute));
    }
}