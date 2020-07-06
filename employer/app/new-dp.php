<?php
require_once "../../constants/connection.php";
require_once '../../constants/check-login.php';
$image = file_get_contents($_FILES['image']['tmp_name']);

if ($_FILES["image"]["size"] > 1000000) {
    header("location:../?r=3478");
    die();
}
$stmt = $conn->prepare("UPDATE tbl_users SET avatar=:image WHERE member_no=:myid");
$stmt->bindParam(":myid",$myID);
$stmt->bindParam(":image",$image);
$stmt->execute();


session_start();
$_SESSION['avatar'] = $image;
session_commit();
header("location:../");
    
