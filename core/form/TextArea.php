<?php

namespace app\core\form;

class TextArea extends BaseField
{

    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" style="%s">%s</textarea>',
            $this->attribute,
        $this->model->hasError($this->attribute) ? "border: 1px solid red;" : '',
            $this->model->{$this->attribute}
        );
    }
}