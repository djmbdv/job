<!doctype html>
<html lang="es_ES">
<?php 
	include 'constants/settings.php'; 
	include 'constants/check-login.php';
	include 'headerPrincipal.php';
?>

<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list">
						<li><a href="./">Inicio</a></li>
						<li><span>Registrarse</span></li>
					</ol>
				</div>
				
			</div>


			<div class="login-container-wrapper">	
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3">
								
                                <?php
							
								if (isset($_GET['p'])) {
									$position = $_GET['p'];
	                                if ($position == "Employee") {
		                                include 'constants/draw-employee.php';
									}	

	                                if ($position == "Employer") {
		                                include 'constants/draw-employer.php';
									}								
								}
								
								?>
								</div>
							
							</div>
							
						</div>
						
					</div>
					
				</div>
			
			</div>
			<footer class="footer-wrapper">
			
				<div class="main-footer">
				
					<div class="container">
					
						<div class="row">
						
							<div class="col-sm-12 col-md-9">
							
								<div class="row">
								
									<div class="col-sm-6 col-md-4">
									
										<div class="footer-about-us">
											<h5 class="footer-title">Sobre Platea21</h5>
											<p>platea21 es un portal dedicado a la programacion web y escritorio 2018.</p>
										
										</div>

									</div>
									
									<div class="col-sm-6 col-md-5 mt-30-xs">
										<h5 class="footer-title">Enlaces Rapidos</h5>
										<ul class="footer-menu clearfix">
											<li><a href="./">Inicio</a></li>
										
									
											<li><a href="contact.php">Contacto</a></li>
											<li><a href="#">Ir Arriba</a></li>

										</ul>
									
									</div>

								</div>

							</div>
							
							<div class="col-sm-12 col-md-3 mt-30-sm">
							
								<h5 class="footer-title">Contacto Platea21</h5>
								
								<p>Dirección : Tacna - Perú</p>
								<p>Correo Electrónico : <a href="mailto:gorchor@gmail.com">gorchor@gmail.com</a></p>
								<p>Teléfono: <a href="tel:+51948445199">+51948445199</a></p>
								

							</div>

							
						</div>
						
					</div>
					
				</div>
				
				<div class="bottom-footer">
				
					<div class="container">
					
						<div class="row">
						
							<div class="col-sm-4 col-md-4">
					
								<p class="copy-right">&#169; Copyright <?php echo date('Y'); ?> Platea21</p>
								
							</div>
							
							<div class="col-sm-4 col-md-4">
							
								<ul class="bottom-footer-menu">
									<li><a >Desarrollado por @gorchor</a></li>
								</ul>
							
							</div>
							
							<div class="col-sm-4 col-md-4">
								<ul class="bottom-footer-menu for-social">
									<li><a href="<?php echo "$tw"; ?>"><i class="ri ri-twitter" data-toggle="tooltip" data-placement="top" title="twitter"></i></a></li>
									<li><a href="<?php echo "$fb"; ?>"><i class="ri ri-facebook" data-toggle="tooltip" data-placement="top" title="facebook"></i></a></li>
									<li><a href="<?php echo "$ig"; ?>"><i class="ri ri-instagram" data-toggle="tooltip" data-placement="top" title="instagram"></i></a></li>
								</ul>
							</div>
						
						</div>

					</div>
					
				</div>
			
			</footer>
			
		</div>


	</div> 
<script type="text/javascript">
function val(){
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

if((frm.password.value).length > 20)
{
	alert("La contraseña debe tener como maximo 20 caracteres");
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













}







</script>

<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>





</body>

</html>