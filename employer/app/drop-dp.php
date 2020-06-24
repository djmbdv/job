<?php
require_once '../../constants/connection.php';
require '../../constants/check-login.php';

$stmt = $conn->prepare("UPDATE tbl_users SET avatar='' WHERE member_no=:myid");
$stmt->bindParam(":myid",$myID);
$stmt->execute();
$_SESSION['avatar'] = '';
 
 
