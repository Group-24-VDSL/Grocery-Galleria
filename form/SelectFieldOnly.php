<?php

namespace app\core\form;

use app\core\Model;

class SelectFieldOnly
{

    public Model $model;
    public string $attribute;
    public $options = [];
    public $classes = [];

    public function __construct(Model $model, string $attribute,$options = [], $classes = [])
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->classes = $classes;
        $this->options = $options;
    }

    public function __toString()
    {
        $optionline = '';

        foreach ($this->options as $key => $value){
            $optionline .= '<option value="'.$key.'">'.$value.'</option>';
        }

        return sprintf('<select id="%s" name="%s"  class="%s">%s</select>',
            $this->attribute,
            $this->attribute,
            $this->classes ? implode(" ",$this->classes): "",
            $optionline
        );
    }


}