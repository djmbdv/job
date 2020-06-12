<?php
require_once '../constants/settings.php';
require_once '../constants/connection.php';
require_once '../constants/check-login.php';

date_default_timezone_set($default_timezone);


$apply_date = date('m/d/Y');

if ($user_online) {
	$opt = $_GET['opt'];
}else die();

if ($myrole == "employee"){
    $stmt = $conn->prepare("SELECT * FROM tbl_job_applications WHERE member_no = '$myid' AND job_id = :jobid");
	$stmt->bindParam(':jobid', $opt);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $rec = count($result);
	
	if ($rec == 0):
	    $stmt = $conn->prepare("INSERT INTO tbl_job_applications (member_no, job_id, application_date)
	    VALUES (:memberno, :jobid, :appdate)");
	    $stmt->bindParam(':memberno', $myid);
	    $stmt->bindParam(':jobid', $opt);
	    $stmt->bindParam(':appdate', $apply_date);
	    $stmt->execute();
		?>
		 <div class="alert alert-success">
	     	You have successfully applied this job.
		 </div>
<?php
	else:
		foreach($result as $row):?>
			print '<br>
			<div class="alert alert-warning">
				You have already applied this job before , you can not apply again.
			</div>
			';
<?php
		endforeach;	
		
	endif;			  
}
