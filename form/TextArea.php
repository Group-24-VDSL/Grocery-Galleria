<?php

namespace app\core\form;

class TextArea extends BaseField
{
    public array $classes=[];
    public function setClass($classes = [])
    {
        $this->classes=$classes;
    }
    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s"  style="%s" class="%s" >%s</textarea>
<div><small style="color: red">%s</small></div>',
            $this->attribute,
        $this->model->hasError($this->attribute) ? "border: 1px solid red;" : '',
            $this->classes? implode(' ',$this->classes): '',
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)
        );
    }
}