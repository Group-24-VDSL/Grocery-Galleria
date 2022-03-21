<?php

namespace app\core\form;

use app\core\Model;

class ImageField
{
    public Model $model;
    public string $attribute;
    public $classes = [];


    public function __construct(Model $model, string $attribute, $classes = []){
        $this->model = $model;
        $this->attribute = $attribute;
        $this->classes=$classes;
    }

    public function __toString(): string
    {
        return sprintf('<img id="%s" src="%s">',
        $this->attribute,
        $this->model->{$this->attribute} ?? '/img/placeholder-150.png');
    }
}