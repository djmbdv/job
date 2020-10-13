<?php

require_once "../constants/connection.php";
require_once "Model.php";



class FieldModelEditForm{
    public $atribute;
    public $required;
    public $type;
    public $label;
    public $value;
    function __constructor($atribute){
        $this->atribute = $atribute;
        
        switch($atribute->type){
            case 'BLOB':
                $type = 'textarea';
            break;
            case 'VAR_STRING':
                $type = "text";
            break;
            default:
                $type = 'text';
        }
        
        $this->type
    }
}

class ModelEditForm{
    public $model;
    public $atributes;
    
    function __constructor($fields, $model){
      //  for
    }
  //  get 
}