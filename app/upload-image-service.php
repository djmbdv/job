<?php
	include_once "../constants/check-login.php";
	if($user_online)die();
	include_once "../constants/connection.php";
	

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));