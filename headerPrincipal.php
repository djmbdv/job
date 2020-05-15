<!DOCTYPE html>
<html lang="es">

<head>
	<?php 
	global $tags_share;?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Directorio Profesional</title>
	<meta name="description" content="Portal de empleos / Bolsa de trabajo" />
	<meta name="keywords" content="trabajo, empleos, cv, curriculum, empresas, carrera,servicios profesionales, tecnicos, bolsa de trabajo, servicios" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php
		if(!isset($tags_share)):?>
	    <meta property="og:image:type" content="image/jpeg" />
	    <meta property="og:image:width" content="500" />
	    <meta property="og:image:height" content="300" />
	    <meta property="og:description" content="Portal de empleos / Bolsa de trabajo" />
	<?php
		else:
			foreach ($tags_share as $property => $content):
			?>
			<meta property="<?=$property?>" content="<?=$content?>" />
	<?php
			endforeach;
		endif;
	?>
	<link rel="shortcut icon" href="images/ico/favicon.png">

	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="js/jquery.slicknav.min.js"></script>
	<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
	<script type="text/javascript" src="js/jquery.countimator.js"></script>
	<script type="text/javascript" src="js/jquery.countimator.wheel.js"></script>
	<script type="text/javascript" src="js/jquery.introLoader.min.js"></script>
	<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
	<script type="text/javascript" src="js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="js/smoothscroll.js"></script>

	<script type="text/javascript" src="js/wow.min.js"></script>

	<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
	<script type="text/javascript" src="js/typeahead.bundle.min.js"></script>
	<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.min.js"></script>

	<script type="text/javascript" src="js/bootstrap-select.js"></script>
	<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
	<script type="text/javascript" src="js/handlebars.min.js"></script>

	<script type="text/javascript" src="js/slick.min.js"></script>
	<script type="text/javascript" src="js/easy-ticker.js"></script>
	<script type="text/javascript" src="js/validator.min.js"></script>
	<script type="text/javascript" src="js/customs.js"></script>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">
	
	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="icons/flaticon-ventures/flaticon-ventures.css">

	<link href="css/style.css" rel="stylesheet">
</head>
<header id="header">
	<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

				<div class="container">
					
					<div class="logo-wrapper">
						<div class="logo">
							<a href="./"> <img style="height:80px" src="images/logo4.png"   alt="Logo" /></a>
						</div>
					</div>
					
					<div id="navbar" class="navbar-nav-wrapper navbar-arrow">
					
						<ul class="nav navbar-nav" id="responsive-menu">
						
							<li>
							
								<a style="color:#d4bb03"  href="./">Inicio</a>
								
							</li>
							
							<li>
								<a style="color:#d4bb03"  href="job-list.php">Lista de Servicios</a>

							</li>
						<!--	
							<li>
								<a href="employers.php">Empresa</a>
							</li>
							
							<li>
								<a href="employees.php">Personal</a>
							</li>
							
							<li> -->
								<a style="color:#d4bb03"  href="contact.php">Contacto</a>
							</li>

						</ul>
				
					</div>

					<div  class="nav-mini-wrapper">
						<ul  class="nav-mini sign-in">
						<?php
						if (isset($user_online ) && $user_online == true) {
						print '
						    <li><a  href="logout.php">Cerrar Sesión</a></li>
							<li><a  href="'.$myrole.'">Perfil</a></li>';
						}else{
						print '
							<li><a style="color:#d4bb03"  href="login.php">Ingresar</a></li>
							<li><a style="color:#d4bb03"  data-toggle="modal" href="#registerModal">Registrate</a></li>';						
						}
						
						?>

						</ul>
					</div>
				
				</div>
				
				<div id="slicknav-mobile"></div>
				
			</nav>

			
			<div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-center">Registrate gratis</h4>
				</div>
				
				<div class="modal-body">
				
					<div class="row gap-20">
					
						<div class="col-sm-6 col-md-6">
							<a href="register.php?p=Employer" class="btn btn-facebook btn-block mb-5-xs">Registrarme</a>
						</div>
					
					</div>
				
				</div>
				
				<div class="modal-footer text-center">
					<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Cerrar</button>
				</div>
				
			</div>

			
		</header>
