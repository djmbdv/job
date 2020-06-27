<?php
	if(!isset($_GET['s']))die();
	require_once "../constants/connection.php";

	global $conn;

	$s = $_GET["s"];
	$l = $_GET["len"];
	header("Content-type:application/json");
	$stmt = $conn->prepare("select distinct IF(tbl_jobs.title like :bus,tbl_jobs.title, IF(category like :bus, category,NULL )) as busqueda from tbl_jobs where tbl_jobs.title  like :bus or category like :bus  limit  10");

	$stmt->bindValue(":bus","%$s%");
	$stmt->execute();
	$stmt2 = $conn->prepare("select distinct first_name from tbl_users where first_name like :bus limit 10");
	$stmt2->bindValue(":bus","%$s%");
	$stmt2->execute();
	$ou = new stdClass();
	$ou->servicios = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
	$ou->empresas = $stmt2->fetchAll(PDO::FETCH_COLUMN,0);
	$ou->len = $l;
	echo json_encode($ou);