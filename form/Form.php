<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($action, $method,$classes=[])
    {
        echo sprintf('<form action="%s" method="%s" class="%s">', $action, $method,implode(" ",$classes));
        return new Form();
    }

    public static function end(){
        echo '</form>';
    }

    public function field(Model $model,$attribute){
        return new InputField($model,$attribute);
    }

    public function fieldonly(Model $model,$attribute,$classes=[]){
        return new InputFieldOnly( $model,$attribute,$classes);
    }

    public function textArea(Model $model,$attribute){
        return new TextArea($model,$attribute);
    }
}