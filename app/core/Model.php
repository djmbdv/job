<?php
require_once "../constants/connection.php";

require_once "Atribute.php";
class Model
{
	
	public $items;
	public $table_name;
	public $model_name;
	public $column_index;
	function __construct($table_name,$column_index = "id", $prefix = "tbl_"){
		global $conn;
		$this->items = [];

		$this->column_index = $column_index;
		$this->table_name = $table_name;
		$this->model_name = substr_replace($table_name,"",0, strlen($prefix));
		$stmt = $conn->prepare("select * from $table_name limit 1");
		$stmt->execute();
		$cc = $stmt->columnCount();
		for($i = 0; $i < $cc;$i++){
			$meta = $stmt->getColumnMeta($i);
		//	print_r($meta);
			$this->items[] = new Atribute($meta["name"],$meta["native_type"],$meta["len"]);
		}
	}

	public $create_alias_item;
	public function get_atribute($name){
		foreach ($this->items as $item) {
			if($item->name == $name)return $item;
		}
		return null;
	}

	public function exist_alias($alias){
		foreach ($this->items as $item) {
			if($item->alias == $alias)return true;
		}
		return false;
	}

	public function make_alias($atribute_name, $alias){
		foreach ($this->items as $item) {
			if($item->name == $atribute_name){
				$item->alias = $alias;
				return true;
			}
		}
		return false;
	}

	public function len(){
		global $conn;
		$table_name = $this->table_name;
		$stmt = $conn->prepare("select count(*) from $table_name");
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function show_model(){
		print_r($this->items);
	}

	function get_entity($id){
		global $conn;
		$ci = $this->column_index;
		$str = "";
		$tn = $this->table_name;
		foreach($this->items  as $k=>$item){
			if($k == 0)$str.= "$tn.$item->name";
			else $str .= ",$tn.$item->name";
		}

		$stmt =  $conn->prepare("select $str from $tn where $ci = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}

/*$model = new Model("tbl_jobs");
$model->make_alias("created_at","Fecha de Creacion");
$model->show_model();*/