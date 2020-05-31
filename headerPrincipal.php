<?php 
	require_once "constants/check-login.php";
	global $tags_share; 
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
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


	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css?7" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin">
	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="css/style.css?9" >
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
	<script type="text/javascript" src="js/wow.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
	<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
	<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
	<script type="text/javascript" src="js/handlebars.min.js"></script>
	<script type="text/javascript" src="js/slick.min.js"></script>
	<script type="text/javascript" src="js/easy-ticker.js"></script>
	<script type="text/javascript" src="js/validator.min.js"></script>
	<script type="text/javascript" src="js/customs.js?1"></script>
</head>
<style type="text/css">
.navbar-sticky > .container > .logo-wrapper > .logo > img {
	max-height: 3rem;
}
.navbar-sticky {
	background-color: black;
}
.navbar-default{
	box-shadow: 0px 3px 7.92px 0.08px rgba(0, 0, 0, 0.1);
}
.navbar-default > .container > .logo-wrapper > .logo > img {
	max-height: 3.5rem;
}
.img-footer{
	margin-right: auto;
    margin-left: auto;
    max-height: 3rem;
}
.bottom-footer {
    background: black;
    color: white;
    line-height: 22px;
    font-size: 11px;
    padding-top: 27px;
    padding-bottom: 17px;
}
#category-inputautocomplete-list{
	padding: 0.5rem;
	border-radius: 3px;
	width: 150%;
	box-shadow: 0 0 4px rgba(0,0,0,0.5);
}
.list-item-title{
	text-shadow: 1px;
	padding: 1px;
	text-align: center;
}
.suggarrow, .suggarrow-shadow {
    border: 10px solid;
    border-color: transparent transparent #fff transparent;
    left: 145px;
    position: absolute;
    top: -20px;
}
</style>
<header id="header">
	<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">
		<div class="container">
			<div class="logo-wrapper">
				<div class="logo">
					<img class="img img-responsive" src="images/logo4.png"   alt="Logo" />
				</div>
			</div>
			<div id="navbar" class="navbar-nav-wrapper navbar-arrow">
				<ul class="nav navbar-nav" id="responsive-menu">
					<li>
						<a  href="./">Inicio</a>
					</li>
					<li>
						<a  href="job-list.php">Lista de Servicios</a>
					</li>
					<li> 
						<a href="contact.php">Contacto</a>
					</li>
				</ul>
			</div>

			<div  class="nav-mini-wrapper">
				<ul  class="nav-mini sign-in">
<?php if (isset($user_online ) && $user_online == true): ?>
				    <li><a  href="logout.php">Cerrar Sesión</a></li>
					<li><a  href="<?=$myrole?>">Perfil</a></li>
<?php else: ?>
					<li><a  href="login.php">Ingresar</a></li>
					<li><a data-toggle="modal" href="#registerModal">Registro</a></li>
<?php endif;?>
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