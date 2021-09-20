<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($action, $method,$classes=[],$enctype = '')
    {
        echo sprintf('<form action="%s" method="%s" class="%s" enctype="%s">', $action, $method,implode(" ",$classes),$enctype);
        return new Form();
    }

    public static function end(){
        echo '</form>';
    }

    public function field(Model $model,$attribute,$disabled = null){
        return new InputField($model,$attribute,$disabled);
    }

    public function fieldonly(Model $model,$attribute,$classes=[]){
        return new InputFieldOnly( $model,$attribute,$classes);
    }

    public function textarea(Model $model,$attribute){
        return new TextArea($model,$attribute);
    }

    public function selectfield(Model $model,$attribute,$options=[],$classes=[])
    {
        return new SelectField($model,$attribute,$options,$classes);
    }

    public function imagefield(Model $model,$attribute){
        return new ImageField($model,$attribute);
    }

    public function inputfile($model,$attribute,$class=[],$accept='')
    {
        return new InputFile($model,$attribute,$class,$accept);
    }

}