<?php
function admin_router($nombre){
	if(file_exists("view_$nombre.php")){
		include_once("view_$nombre.php");
		return true;
	}
	return false;
}