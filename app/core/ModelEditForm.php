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
    }

}

class ModelEditForm{
    public $model;
    public $atributes;
    
    function __constructor($fields, $m){
      $this->model = $m;
    }
  function getFields(){
      return $this->model->items;      
   }
   function get_entity_fields($id){
        $array = $this->model->get_entity();
        return $array;
    }    
}