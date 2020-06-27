<?php

require_once "../constants/settings.php";
include_once "../constants/connection.php";
require_once "../mail/PHPMailerAutoload.php";
require_once '../constants/uniques.php';

function generate_verification_token($email){
	global $conn;
	$stmt = $conn->prepare("INSERT into tbl_tokens (email, token) VALUES (:email,:token);");
	$token = md5(rand().$email);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':token', $token);
	$stmt->execute();
	return $token;
}



function create_verification_email($email){
	global $smtp_host;
	global $smtp_user;
	global $smtp_pass;
	global $title_site;
	global $contact_email;
	global $actual_link;
	global $isHttps;
	$mail = new PHPMailer();
	$mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_user;                     
    $mail->Password   = $smtp_pass;
    $mail->Port       = 587;    

    $mail->setFrom($smtp_user, $title_site);
    $mail->addAddress($email); 
    $mail->addReplyTo($contact_email, $title_site);
    $mail->isHTML(true);
    $mail->Subject = 'Verificacion de Cuenta';
    $token = generate_verification_token($email);
    $protocol = $isHttps || !LOCAL ? "https" : "http";
    $local = LOCAL ? "/job" : "";
    $url ="$protocol://$actual_link$local";
    $mail->Body    = <<<EOD
    <html>
    <body>
<div style=3D"background: #f1bb13; width: 650px;  height:700px">
	<img  src="$url/images/email-check.jpg" style="width:100%; alt=3D"" >
	<div style=3D"margin-top: -60px; width: 300px; position: absolute;left: 42px;">
		<img src=3D"$url/images/email-check-text.jpg" style=3D"max-width: 100%;">
	</div>
    <div  style="border-radius: 20px;
    -webkit-transition: all .3s;
    -o-transition: all .3s;
    transition: all .3s;
    padding: 8px;
    margin-left: auto;
    margin-top: 30px;
    margin-right: 40px;
    font-weight: 400;
    width: 150px;
    background: #ffffff;
     box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-width: 2px;">
	    <a href="$url/app/email-verification.php?t=$token">
		    <img style="max-width :100%" src="$url/images/email-check-button.jpg">
        </a>
    </div>
</div>
</body>
</html>
EOD;

    $mail->send();
    return true;
}




function register_as_employee(){
	try{
		global $conn;
		$role = 'employee';
	    $last_login = date('d-m-Y h:m A [T P]');
		$member_no = 'EM'.get_rand_numbers(9).'';
	    $fname = ucwords($_POST['fname']);
	    $lname = ucwords($_POST['lname']);
	    $email = $_POST['email'];
	    $login = md5($_POST['password']);
		
	    $stmt = $conn->prepare(
	    "INSERT INTO tbl_users (first_name, last_name, email, last_login, login, role, member_no) 
		VALUES (:fname, :lname, :email, :lastlogin, :login, :role, :memberno, :verfiried)");
	    $stmt->bindParam(':fname', $fname);
	    $stmt->bindParam(':lname', $lname);
	    $stmt->bindParam(':email', $email);
		$stmt->bindParam(':lastlogin', $last_login);
	    $stmt->bindParam(':login', $login);
	    $stmt->bindParam(':role', $role);
		$stmt->bindParam(':memberno', $member_no);
		$stmt->bindParam(':verfiried', false );
	    $stmt->execute();			  
		echo true;
	}catch(PDOException $e){
		print_r($e);
		echo false;
	}
}

function register_as_employer() {
	try{
		global $conn;
		$role = 'employer';
		$last_login = date('d-m-Y h:m A [T P]');
	    $comp_no = 'CM'.get_rand_numbers(9).'';
	    $cname = ucwords($_POST['company']);
	    $email = $_POST['email'];
	    $login = md5($_POST['password']);
	    $verified = 0;
	    $stmt = $conn->prepare("INSERT INTO tbl_users (first_name, title, email, last_login, login, role, member_no,verified) 
		VALUES (:fname, :title, :email, :lastlogin, :login, :role, :memberno, :verified)");
	    $stmt->bindParam(':fname', $cname);
	    $vacio = '';
	    $stmt->bindParam(':title', $vacio);
	    $stmt->bindParam(':email', $email);
		$stmt->bindParam(':lastlogin', $last_login);
	    $stmt->bindParam(':login', $login);
	    $stmt->bindParam(':role', $role);
		$stmt->bindParam(':memberno', $comp_no);
		$stmt->bindParam(':verified', $verified);
	    $stmt->execute();
	    return true;
	}catch(PDOException $e){
		print_r($e);
		echo false;
	}		  
}

$email = $_POST['email'];
$account_type = $_POST['acctype'];

if ($account_type == "101") {
	$role = "Employee";	
}else{
	$role = "Employer";	
}
if ($account_type == "101" ? register_as_employee() :register_as_employer()) {
	if(create_verification_email($email)) echo "1"; //  Success Send vefification mail
	else echo "2"; // Error en email confirmacion de email
}else echo "0";
