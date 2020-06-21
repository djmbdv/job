<?php
require_once "../../constants/connection.php";
require_once "../../constants/check-login.php";
$new_password = md5($_POST['password']);

$stmt = $conn->prepare("UPDATE tbl_users SET login = :newpassword WHERE member_no=:myId");
$stmt->bindParam(':newpassword', $new_password);
$stmt->bindParam(':myId',$myID);
$stmt->execute();
header("location:../change-password.php?r=9564");