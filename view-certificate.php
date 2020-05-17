<?php

require 'constants/connection.php';
$file_id = $_GET['id'];

$global $conn;

try {
	$stmt = $conn->prepare("SELECT * FROM tbl_professional_qualification WHERE id = :fileid");
	$stmt->bindParam(':fileid', $file_id);
	$stmt->execute();
	$result = $stmt->fetchAll();
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Platea21 - View Certificate</title>
		<link rel="shortcut icon" href="images/ico/favicon.png">
		<link href="css/main.css" rel="stylesheet">
	</head>
	<body>
<?php
	foreach($result as $row):
    	$certificate = $row['certificate'];
	?>
		<div style="width:100%">
		    <iframe  style="border:none;" src="ViewerJS/?title=CERTIFICATE#<?= 'data:application/pdf;base64,'.base64_encode($certificate).'' ?>" height="100%" width="100%">
		    </iframe>
	    </div>
	<?php
		endforeach;				  
	}catch(PDOException $e){
		print_r($e);
	} ?>
	</body>
</html>