<?php
require_once "../constants/check-login.php";
require_once "../constants/connection.php";

global $myID;
global $conn;

if(!$user_online || !isset($_GET["voto"]) || !isset($_GET['id']))die();
$id = $_GET["id"];
$voto = $_GET["voto"];
$stmt = $conn->prepare("DELETE FROM `tbl_votes` where member_no = :myID and job_id = :job_id");
$stmt->bindParam(":job_id",$id);
$stmt->bindParam(":myID",$myID);
$stmt->execute();
$stmt = $conn->prepare("INSERT INTO `tbl_votes` (`member_no`, `job_id`, `value`) VALUES (:myID, :job_id, :voto)");
$stmt->bindParam(":myID",$myID);
$stmt->bindParam(":job_id",$id);
$stmt->bindParam(":voto",$voto);
$stmt->execute();
echo 1;