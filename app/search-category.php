<?php
	if(!isset($_GET['s']))die();
	require_once "../constants/connection.php";

	global $conn;

	$s = $_GET["s"];
	$l = $_GET["len"];
	header("Content-type:application/json");
	$stmt = $conn->prepare("select distinct category from tbl_categories limit 10");

	$stmt->bindValue(":bus","%$s%");
	$stmt->execute();
	$ou = new stdClass();
	$ou->categories = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
	$ou->len = $l;
	echo json_encode($ou);