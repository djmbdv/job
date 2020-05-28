<?php
require_once '../constants/connection.php';

if (isset($_GET['id'])) {
	global $conn;
	$id = $_GET['id'];
	$stmt = $conn->prepare("SELECT avatar FROM tbl_users WHERE member_no = :id");
	$stmt->bindValue(':id',$id);
    $stmt->execute();
    $o = $stmt->fetchObject();
    header("Content-type: image/jpeg");
    echo $o->avatar;
}