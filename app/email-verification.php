<?php
	require_once '../constants/settings.php';
	require_once '../constants/connection.php';
	global $conn;
	global $actual_link;
	global $isHttps;
	if(!isset($_GET["t"])){
		header("location: .");
		die();
	}
	$protocol = $isHttps ? "https" : "http";
	$local = LOCAL ? "/job" : "";
	$token  = $_GET["t"];
	$stmt = $conn->prepare("update tbl_users join tbl_tokens on tbl_tokens.email = tbl_users.email set tbl_users.verified = '1' where tbl_tokens.token = ? ");
	$stmt->bindParam(1, $token, PDO::PARAM_STR,255);
	if ($stmt->execute()):?>
		hola
<script type="text/javascript">
	//window.location.href = '<?= "$protocol://$actual_link$local/login.php?r=570" ?>';
</script>
<?php
	else:
		echo "Error";
	endif;
