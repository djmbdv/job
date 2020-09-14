<?php
require_once "../../constants/connection.php";

require_once "Atribute.php";
class Model
{
	
	public $items;
	public $table_name;
	function __construct($table_name,$column_index = "id"){
		global $conn;
		$this->items = [];
		$this->table_name = $table_name;
		$stmt = $conn->prepare("select * from $table_name limit 1");
		$stmt->execute();
		$cc = $stmt->columnCount();
		for($i = 0; $i < $cc;$i++){
			$meta = $stmt->getColumnMeta($i);
			print_r($meta);
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

	function show_model(){
		print_r($this->items);
	}
}

$model = new Model("tbl_jobs");
$model->make_alias("created_at","Fecha de Creacion");
//$model->show_model();