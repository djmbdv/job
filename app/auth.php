<?php

date_default_timezone_set('UTC');
require '../constants/connection.php';

global $conn;


$last_login = date('d-m-Y h:m A [T P]');

$myemail = $_POST['email'];
$mypass = md5($_POST['password']);


$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = :myemail AND login = :mypassword");
$stmt->bindParam(':myemail', $myemail);
$stmt->bindParam(':mypassword', $mypass);
$stmt->execute();

$rec = $stmt->rowCount();

if ($rec != 1){
	header('location: ../login.php?r=0346');
	die();
}
session_start();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row['verified']){
	header('location: ../login.php?r=0446');
	die();
}



$role = $row['role'];



$_SESSION['logged'] = true;
$_SESSION['myid'] = $row['member_no'];
$_SESSION['myemail'] = $row['email'];
$_SESSION['mycity'] = $row['city'];
$_SESSION['mystreet'] = $row['street'];
$_SESSION['role'] = $role;
$_SESSION['avatar'] = $row['avatar'];
$_SESSION['mycountry'] = $row['country'];
$_SESSION['mydesc'] = $row['about'];
$_SESSION['myzip'] = $row['zip'];
$_SESSION['lastlogin'] = $row['last_login'];
$_SESSION['myphone'] = $row['phone'];

if ($role == "employee"){
	$_SESSION['myfname'] = $row['first_name'];
	$_SESSION['mylname'] = $row['last_name'];
	$_SESSION['mydate'] = $row['bdate'];
	$_SESSION['mymonth'] = $row['bmonth'];
	$_SESSION['myyear'] = $row['byear'];
	$_SESSION['myedu'] = $row['education'];
	$_SESSION['mytitle'] = $row['title'];
	$_SESSION['gender'] = $row['avatar'];
}else{
	$_SESSION['compname'] = $row['first_name'];
	$_SESSION['established'] = $row['byear'];
	$_SESSION['comptype'] = $row['title'];
	$_SESSION['myserv'] = $row['services'];
	$_SESSION['myexp'] = $row['expertise'];
	$_SESSION['website'] = $row['website'];
	$_SESSION['people'] = $row['people'];
}

session_commit();

$stmt = $conn->prepare("UPDATE tbl_users SET last_login = :lastlogin WHERE email= :email");
$stmt->bindParam(':lastlogin', $last_login);
$stmt->bindParam(':email', $myemail);
$stmt->execute();

header("location: ../profile");