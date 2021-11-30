<?php

namespace app\core\form;

use app\core\Model;

class HiddenFieldOnly
{

    const TYPE_HIDDEN = 'hidden'; //add more types lists, checkboxes etc

    public string $type;
    public Model $model;
    public string $attribute;
    public int $value;
    public string $interaction ='';

    public function __construct(Model $model, string $attribute,int $value){
        $this->type = self::TYPE_HIDDEN;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->value=$value ;

    }


    public function setStyle(): string
    {
        return $this->hasNoError()? "" : "border: .1rem solid red;";
    }

    public function setValue(string $value){
        $this->value =$value;
        return $this;
    }

    public function setInteraction(string $interaction)
    {
        $this->interaction = $interaction;
        return $this;
    }
    public function __toString()
    {
        return sprintf('
    <input type="%s" id="%s" name="%s" style="%s" value="%s" %s >
    <div><small style="color: red">%s</small></div>
    ',
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->setStyle(),
            $this->value,

            $this->interaction,
            $this->model->getFirstError($this->attribute)
        );
    }
}