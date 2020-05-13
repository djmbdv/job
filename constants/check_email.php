<?php
session_start();
include_once 'connection.php';
if(isset($_POST['email'])){
	$stmt = $conn->prepare("SELECT * FROM tbl_users where email = ? ");
	$stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR,255);
	$stmt->execute();
	echo ($stmt->rowCount() > 0)?0:1;
}