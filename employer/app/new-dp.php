<?php
require_once "../../constants/connection.php";
$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

if ($_FILES["image"]["size"] > 1000000) {
    header("location:../?r=3478");
    die();
}
$stmt = $conn->prepare("UPDATE tbl_users SET avatar='$image' WHERE member_no='$myid'");
$stmt->execute();

$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE member_no='$myid'");
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row){
    $_SESSION['avatar'] = $row['avatar'];
    header("location:../");
    die();
}