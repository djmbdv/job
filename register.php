<?php 
	include 'constants/settings.php'; 
	include 'constants/check-login.php';
	include 'headerPrincipal.php';
?><body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list">
						<li><a href="./">Inicio</a></li>
						<li><span>Registro</span></li>
					</ol>
				</div>
				
			</div>
			<div class="login-container-wrapper">	
				<div class="container">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
<?php
	if (isset($_GET['p']) && $_GET['p'] == "Employee") include 'constants/draw-employee.php';
	else include 'constants/draw-employer.php';
?>
						</div>
					</div>
				</div>
			</div>
<?php include_once 'footer.php'; ?>
		</div>
	</div> 
<div id="back-to-top">
   <a href="#"><i class="fa fa-arrow-up"></i></a>
</div>
</body>
</html>
<?php ob_flush();