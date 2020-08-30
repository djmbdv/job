<?php
require '../constants/db_config.php';
if (isset($_GET['r'])) {
$error_code = $_GET['r'];

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
    $stmt = $conn->prepare("SELECT * FROM tbl_alerts WHERE code = :errorcode");
	$stmt->bindParam(':errorcode', $error_code);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $rowx): 
		
     $description = $rowx['description'];
     $type = $rowx['type'];
     print '
	 <div class="alert text-center alert-'.$type.'">
     '.$description.'
	 </div>
     ';
	endforeach;
}