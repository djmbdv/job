<?php
date_default_timezone_set('UTC');
require '../../constants/connection.php';
require '../constants/check-login.php';
require '../../constants/uniques.php';

global $conn;


if(!$user_online){
	header('location: ../../');
	die();
}

$postdate = date('F d, Y');
$job_id = ''.get_rand_numbers(10).'';
$title  = ucwords($_POST['title']);
$city  = ucwords($_POST['city']);
$country = $_POST['country'];
$category = $_POST['category'];
$desc = ucfirst($_POST['description']);
$deadline = $_POST['deadline'];
$telefono= $_POST['telefono'];


$stmt = $conn->prepare("INSERT INTO tbl_jobs (job_id, title, city, country, category, description, company, date_posted, closing_date, telefono)
 VALUES (:jobid, :title, :city, :country, :category,  :description, :company, :dateposted, :closingdate, :telefono)");
$stmt->bindParam(':jobid', $job_id);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':country', $country);
$stmt->bindParam(':category', $category);
//$stmt->bindParam(':type', $type);
//$stmt->bindParam(':experience', $exp);
$stmt->bindParam(':description', $desc);
//$stmt->bindParam(':responsibility', $res);
//$stmt->bindParam(':requirements', $rec);
$stmt->bindParam(':company', $myid);
$stmt->bindParam(':dateposted', $postdate);
$stmt->bindParam(':closingdate', $deadline);
$stmt->bindParam(':telefono', $telefono);
$stmt->execute();
header("location:../post-job.php?r=9843");		  
