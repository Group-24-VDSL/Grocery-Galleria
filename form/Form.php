<?php

namespace app\core\form;

use app\core\Model;


class Form
{
    public static function begin($action, $method,$id,$classes=[],$enctype = '')
    {
        echo sprintf('<form action="%s" method="%s" id="%s" class="%s"  enctype="%s">', $action, $method,$id,implode(" ",$classes),$enctype);
        return new Form();
    }

    public static function end(){
        echo '</form>';
    }

    public function field(Model $model,$attribute,$disabled = null){
        return new InputField($model,$attribute,$disabled);
    }

    public function fieldonly(Model $model,$attribute,$classes=[]){
        return new InputFieldOnly($model,$attribute,$classes);
    }
    public function numberfieldonly(Model $model,$attribute,$min,$max,$step,$classes=[]){
        return new NumberFieldOnly( $model,$attribute,$min,$max,$step,$classes);
    }

    public function textarea(Model $model,$attribute){
        return new TextArea($model,$attribute);
    }

    public function textAreaOnly(Model $model,$attribute,$classes=[]){
        return new TextAreaOnly($model,$attribute,$classes);
    }

    public function selectfieldonly(Model $model,$attribute,$options=[],$classes=[])
    {
        return new SelectFieldOnly($model,$attribute,$options,$classes);
    }

    public function selectfield(Model $model,$attribute,$options=[],$classes=[])
    {
        return new SelectField($model,$attribute,$options,$classes);
    }

    public function imagefield(Model $model,$attribute,$classes=[]){
        return new ImageField($model,$attribute,$classes);
    }

    public function inputfile(Model $model,$attribute,$class=[],$accept='')
    {
        return new InputFile($model,$attribute,$class,$accept);
    }

}