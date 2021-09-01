<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{


    public Model $model;
    public string $attribute;

    public function __construct(model $model, string $attribute)
    {

        $this->model = $model;
        $this->attribute = $attribute;
    }


    abstract public function renderInput():string;

    public function __toString(){
        return sprintf(
            '<div>
        <label>%s</label>
        %s
        <div style="color:red;">
            %s
        </div>
                   </div>'
            ,$this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->renderInput(),
            $this->model->getFirstError($this->attribute) //errors print
        );
    }
}