<?php
	
if(!@include_once "../constants/connection.php"){
	require_once("constants/connection.php");
}


function servicios_mas_buscado(){
	global $conn;
	$stmt = $conn->prepare("SELECT *  from tbl_search order by numero desc limit 1");
	$stmt->execute();
	return $stmt->fetchObject();
}

function servicios_cantidad(){
	global $conn;
	$stmt = $conn->prepare("select count(*) as value from tbl_jobs ");
	$stmt->execute();
	$publicaciones = $stmt->fetchColumn();
	return $publicaciones;
}
function categorias_cantidad_servicios(){
	global $conn;
	$stmt =  $conn->prepare("SELECT tbl_categories.category as categoria, count(tbl_jobs.job_id) as numero from tbl_categories left join tbl_jobs on tbl_jobs.category = tbl_categories.category group by tbl_categories.category order by numero desc");
	$stmt->execute();
	return $stmt->fetchAll();
}

function clientes_cantidad(){
	global $conn;
	$stmt = $conn->prepare("SELECT count(*) from tbl_users");
	$stmt->execute();
	return $stmt->fetchColumn(0);
}

function get_users_page($page, $num){
	global $conn;
	$off = $page * $num;
	$stmt = $conn->prepare("SELECT  * from tbl_users limit $off,$num");
	$stmt->execute();
	return  $stmt->fetchAll();
}

function get_user_table($page, $num, $filters, $columns ){
	global $conn;
	//for()
}