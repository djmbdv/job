<?php

require_once "../constants/settings.php";
include_once "../constants/connection.php";
require_once "../mail/PHPMailerAutoload.php";
require_once '../constants/uniques.php';


function generate_verification_token($email){
	$stmt = $conn->prepare("INSERT into tbl_tokens (email, token) VALUES (:email,:token);");
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':token', md5(rand().$email));

}



function create_verification_email($email){
	$mail = new PHPMailer();
	$mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'consultasacademicasuts@gmail.com';                     // SMTP username
    $mail->Password   = 'Marzo2020*';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; 
    $mail->Port       = 587;                            
    $mail->setFrom('consultasacademicasuts@gmail.com', 'Consultas Academicas');
    $mail->addAddress($email); 
    $mail->addReplyTo('consultasacademicasuts@gmail.com', 'Information');
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verificacion de Cuenta';
    $mail->Body    = "Link de Verificacion <a href='$actual_link/app/email-verificarion.php?t=$token'>$actual_link/app/email-verificarion.php?t=$token</a></b>";
    echo '<br>enviando...<br>\n';
    $mail->send();
    echo 'Message has been sent';
}




function register_as_employee(){
	try{
		$role = 'employee';
	    $account_type = $_POST['acctype'];
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
		echo 1;
	}catch(PDOException $e){
		echo 0;
	}
}

function register_as_employer() {
	try{
		$role = 'employer';
	    $account_type = $_POST['acctype'];
	    $last_login = date('d-m-Y h:m A [T P]');
	    $comp_no = 'CM'.get_rand_numbers(9).'';
	    $cname = ucwords($_POST['company']);
	    $email = $_POST['email'];
	    $login = md5($_POST['password']);
	    $stmt = $conn->prepare("INSERT INTO tbl_users (first_name, title, email, last_login, login, role, member_no,verified) 
		VALUES (:fname, :title, :email, :lastlogin, :login, :role, :memberno, :verified)");
	    $stmt->bindParam(':fname', $cname);
	    $stmt->bindParam(':title', '');
	    $stmt->bindParam(':email', $email);
		$stmt->bindParam(':lastlogin', $last_login);
	    $stmt->bindParam(':login', $login);
	    $stmt->bindParam(':role', $role);
		$stmt->bindParam(':memberno', $comp_no);
		$stmt->bindParam(':verified', false);
	    $stmt->execute();
	    echo 1;
	}catch(PDOException $e){
		echo 0;
	}		  
}
print_r($_POST);
$email = $_POST['email'];
$account_type = $_POST['acctype'];

if ($account_type == "101") {
	$role = "Employee";	
}else{
	$role = "Employer";	
}
if ($account_type == "101") {
	register_as_employee();
}else{
	register_as_employer();
}
