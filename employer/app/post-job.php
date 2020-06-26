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

$postdate = date('F d, Y');
$job_id = ''.get_rand_numbers(10).'';
$title  = ucwords($_POST['title']);
$city  = ucwords($_POST['city']);
$country = $_POST['country'];
$category = $_POST['category'];
$desc = ucfirst($_POST['description']);
//$deadline = $_POST['deadline'];
$p = isset($_POST["producto"]);
$telefono= $_POST['telefono'];
$addQuery = $p? ", :producto, :precio":'';
$addQueryValue = $p? ", producto, precio":'';
$stmt = $conn->prepare("INSERT INTO tbl_jobs (job_id, title, city, country, category, description, company, date_posted, telefono $addQueryValue )
 VALUES (:jobid, :title, :city, :country, :category,  :description, :company, :dateposted, :telefono $addQuery)");
$stmt->bindParam(':jobid', $job_id);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':country', $country);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':description', $desc);
$stmt->bindParam(':company', $myid);
$stmt->bindParam(':dateposted', $postdate);
$stmt->bindParam(':telefono', $telefono);
if($p){
$precio = $_POST['precio'];
$stmt->bindParam(':producto', 1);
$stmt->bindParam(':precio',$precio);
}
$stmt->execute();

if(isset($_FILES["images"])):
$target_dir = "../../images/uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
for($i = 0; $i < count($_FILES["images"]["name"]); $i++):
	$target_file = $target_dir . basename($_FILES["images"]["name"][$i]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$pathTotal = strtolower(pathinfo($target_file,PATHINFO_DIRNAME));
	$target_file =$target_dir.uniqid("img").".$imageFileType";
	if ($_FILES["images"]["size"][$i] > 500000) {
	  $uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  $uploadOk = 0;
	}
	if($uploadOk == 1){
		move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file);
	}
	$stmt = $conn->prepare("INSERT INTO `tbl_image_service` ( `path`, `service`) VALUES (:path, :service);");
	$stmt->bindValue(":path","$protocol://$actual_link$local/images/uploads/".basename($target_file));
	$stmt->bindValue(":service",$job_id);
	$stmt->execute();
endfor;
endif;
if($p)
	 header("location:../post-job.php?r=9844");		
else header("location:../post-job.php?r=9843");		  
