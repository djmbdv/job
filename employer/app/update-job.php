<?php
date_default_timezone_set('UTC');
require_once '../../constants/connection.php';
require_once '../constants/check-login.php';
require_once '../../constants/uniques.php';
require_once '../../constants/settings.php';
global $conn;



$protocol = $isHttps ? "https" : "http";
$local = LOCAL ? "/job" : "";

if(!$user_online){
	header('location: ../../login.php');
	die();
}

$job_id = $_POST['jobid'];
$title  = ucwords($_POST['title']);
$city  = ucwords($_POST['city']);
$country = $_POST['country'];
$category = $_POST['category'];
$desc = ucfirst($_POST['description']);
$telefono= $_POST['telefono'];
$stmt = $conn->prepare("UPDATE tbl_jobs SET title = :title, city = :city, country = :country, category = :category,telefono = :telefono, description = :description WHERE job_id = :jobid AND company = :myid");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':country', $country);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':description', $desc);
$stmt->bindParam(':jobid', $job_id);
$stmt->bindParam(':myid', $myId);
$stmt->bindParam(':telefono', $telefono);
$target_dir = "../../images/uploads/";
if(isset($_POST['delimg'])){
	$sql = "DELETE FROM tbl_image_service WHERE id in (".str_repeat("?,", count($_POST['delimg']) - 1)."?)";
	$stmt1 = $conn->prepare($sql);
	foreach ($_POST['delimg'] as $k => $img_id) {
		$stmt1->bindParam($k + 1,$img_id,PDO::PARAM_INT);
	}
	$stmt1->execute();
}
	

$stmt->execute();


if(isset($_FILES["images"])):

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
for($i = 0; $i < count($_FILES["images"]["name"]); $i++):
	$target_file = $target_dir . basename($_FILES["images"]["name"][$i]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$pathTotal = strtolower(pathinfo($target_file,PATHINFO_DIRNAME));
	$target_file =$target_dir.uniqid("img").".$imageFileType";
	if ($_FILES["images"]["size"][$i] > 1000000) {
	  $uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  $uploadOk = 0;
	}
	if($uploadOk == 1){
		if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file)) {


  } else {
    echo "Sorry, there was an error uploading your file.";
  }
	}
	$stmt = $conn->prepare("INSERT INTO `tbl_image_service` ( `path`, `service`) VALUES (:path, :service);");
	$stmt->bindValue(":path","$protocol://$actual_link$local/images/uploads/".basename($target_file));
	$stmt->bindValue(":service",$job_id);
	$stmt->execute();
endfor;
endif;

header("location:../edit-job.php?r=0369&jobid=$job_id");
