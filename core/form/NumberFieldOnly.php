<?php


namespace app\core\form;
use app\core\Model;

class NumberFieldOnly extends InputFieldOnly
{
    public string $min;
    public string $max;
    public string $step;

    public function __construct(Model $model, string $attribute,$min,$max,$step,$classes=[]){
        parent::__construct($model, $attribute, $classes);
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->type = self::TYPE_NUMBER;
    }

    public function __toString()
    {
        return sprintf('
<input type="%s" id="%s" name="%s" style="%s" value="%s" class="%s" min="%s" max="%s" step="%s">
<div><small style="color: red">%s</small></div>',
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->setStyle(),
            $this->value,
            $this->classes ? implode(" ",$this->classes): "",
            $this->min,
            $this->max,
            $this->step,
            $this->model->getFirstError($this->attribute)
        );
    }



}