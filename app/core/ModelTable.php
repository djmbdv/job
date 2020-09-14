<?php
	
/**
 * 
 */

require_once "../../constants/connection.php";
require_once "Model.php";

class ModelTable{
	public $atributes;

	function __construct($model,$visible_columns, $order_column, $order_type,$num, $page) {
		$this->atributes = [];
		foreach ($visible_columns as $col) {
			$this->atributes[] = $model->getAtribute($col);
		}
	}

	function get_rows(){
		$sql = "select ";
		foreach ($this->atributes as $key => $att) {
			$sql.= $key?','.$att->name:$att->name;
		}
		
	}
	function get_headers(){
		$headers = [];
		foreach ($this->atributes as $key => $att) {
			$headers[] = is_string($att->alias)?$att->alias:$att->name;
		}
		return $headers;
	}
}