<?php
	include_once 'db_config.php';
	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8;", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);