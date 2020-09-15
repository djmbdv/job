<?php
	
/**
 * 
 */

require_once "../constants/connection.php";
require_once "Model.php";

class ModelTable{
	public $atributes;
	public $model;
	public $num;
	public $page;
	function __construct($model,$visible_columns, $order_column, $order_type,$num, $page) {
		$this->num = $num;
		$this->page = $page;
		$this->model = $model;
		$this->atributes = [];
		foreach ($visible_columns as $col) {
			$this->atributes[] = $model->get_atribute($col);
		}
	}

	function get_rows(){
		global $conn;
		$sql = "select ";
		$offset =  $this->num*$this->page;
		$num = $this->num;
		foreach ($this->atributes as $key => $att) {
			$sql.= $key?','.$att->name:$att->name;
		}
		$sql.="  from ".$this->model->table_name." LIMIT $offset,$num";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	function get_headers(){
		$headers = [];
		foreach ($this->atributes as $key => $att) {
			$headers[] = is_string($att->alias)?$att->alias:$att->name;
		}
		return $headers;
	}
}
/*
$model = new Model("tbl_users");
$model->make_alias("created_at","Fecha de Creacion");
$model->show_model();
$table =  new ModelTable($model,["email","created_at","bdate", "first_name"],[],1,10,1);*/
//print_r($table->get_headers());
//print_r($table->get_rows());
