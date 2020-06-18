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
die();	
$stmt = $conn->prepare("UPDATE tbl_jobs SET title = :title, city = :city, country = :country, category = :category, type = :type, experience = :experience, description = :description, responsibility = :responsibility, requirements = :requirements WHERE job_id = :jobid AND company = '$myid'");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':country', $country);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':experience', $exp);
$stmt->bindParam(':description', $desc);
$stmt->bindParam(':responsibility', $res);
$stmt->bindParam(':requirements', $rec);
$stmt->bindParam(':jobid', $job_id);
$stmt->execute();

header("location:../edit-job.php?r=0369&jobid=$job_id");
