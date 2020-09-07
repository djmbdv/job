<?php 
require_once '../constants/settings.php'; 
require_once '../constants/check-login.php';
require_once '../constants/connection.php';

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}
$deep_url = 1;
include_once "../headerPrincipal.php";
?>
<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Profile</a></li>
						<li><span>Change Password</span></li>
					</ol>
				</div>
			</div>
			<div class="admin-container-wrapper">
				<div class="container">
					<div class="GridLex-gap-15-wrappper">
						<div class="GridLex-grid-noGutter-equalHeight">
							<div class="GridLex-col-3_sm-4_xs-12">
								<div class="admin-sidebar">
									<div class="admin-user-item for-employer">
										<div class="image">
										<?php 
										if ($logo == null) {
										print '<center>Company Logo Here</center>';
										}else{
										echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
										}
										?><br>
										</div>
										
										<h4><?=$compname?></h4>
										
									</div>
									
									<div class="admin-user-action text-center">
									
										<a href="post-job.php" class="btn btn-primary btn-sm btn-inverse">Publicar Empleo</a>
										
									</div>
									
									<ul class="admin-user-menu clearfix">
										<li  class="">
											<a href="./"><i class="fa fa-user"></i> Perfil</a>
										</li>
										<li class="active">
										<a href="change-password.php"><i class="fa fa-key"></i> Cambiar Contraseña</a>
										</li>
			
										<li>
											<a href="../company.php?ref=<?php echo "$myid"; ?>"><i class="fa fa-briefcase"></i> Descripción Empresa</a>
										</li>
										<li>
											<a href="my-posts.php"><i class="fa fa-bookmark"></i> Empleos Publicados</a>
										</li>
										<li>
											<a href="../logout.php"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
										</li>
									</ul>
									
								</div>

							</div>
							
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
										<h2>Cambiar Contraseña</h2>									</div>
									<form name="frm" class="post-form-wrapper" action="app/new-pass.php" method="POST">
										<div class="row gap-20">
                                        	<?php include 'constants/check_reply.php'; ?>
											<div class="col-sm-6 col-md-4">
												<div class="form-group">
													<label>Nueva Contraseña</label>
													<input type="password" class="form-control" name="password" required placeholder="Ingresa tu new password">
												</div>
											</div>
											<div class="clear"></div>
											<div class="col-sm-6 col-md-4">
												<div class="form-group">
													<label>Confirmar Contraseña</label>
													<input type="password" class="form-control"  name="confirmpassword" required placeholder="Confirm your new password">
												</div>
											</div>
											<div class="col-sm-12 mt-10">
												<button type="submit" onclick="return check_passwords();" class="btn btn-primary">Actualizar</button>
												<button type="reset" class="btn btn-primary btn-inverse">Cancelar</a>
											</div>
										</div>
									</form><br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include "../footer.php";?>
		</div>
	</div>
<div id="back-to-top">
    <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>

<script type="text/javascript">
function check_passwords(){
if(frm.password.value == "")
{
	alert("Ingrese su Contraseña.");
	frm.password.focus(); 
	return false;
}
if((frm.password.value).length < 8)
{
	alert("La contraseña debe tener como minimo 08 caracteres");
	frm.password.focus();
	return false;
}

if(frm.confirmpassword.value == "")
{
	alert("Ingrese otra vez su contraseña");
	return false;
}
if(frm.confirmpassword.value != frm.password.value)
{
	alert("Las contraseñas no son iguales");
	return false;
}

return true;
}
</script>
</body>



</html>