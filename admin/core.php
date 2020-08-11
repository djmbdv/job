<?php 
	
require_once "../constants/connection.php";


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