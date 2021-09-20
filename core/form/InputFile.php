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
        return sprintf('<input type="file" id="%s" class="%s" src="%s" accept="%s">',
            $this->attribute,
            $this->class ? implode(" ",$this->class): "",
            $this->model->{$this->attribute} ?? '/img/placeholder-150.png',
            $this->accept);
    }
}