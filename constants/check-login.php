<?php
	ob_start();
	if(!session_status())
	 session_start();
	if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		$user_online = true;	
		$myrole = $_SESSION['role'];
		$myID = $_SESSION['myid'];
	}else{
		$user_online = false;
	}
	session_commit();