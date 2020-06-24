<?php
require '../../constants/connection.php';
require '../constants/check-login.php';
$job_id = $_GET['id'];

global $conn;

	
$stmt = $conn->prepare("DELETE FROM tbl_jobs WHERE job_id= :jobid AND company = '$myid'");
$stmt->bindParam(':jobid', $job_id);
$stmt->execute();


header("location:../my-jobs.php?r=0173");					  
