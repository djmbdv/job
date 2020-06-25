<?php 
	require_once "constants/settings.php";
	require_once "constants/check-login.php";
	global $tags_share;
	global $title_site;
	$prefix = isset($deep_url)?str_repeat("../",$deep_url):"";
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title_site?></title>
	<meta name="description" content="Portal de empleos / Bolsa de trabajo" />
	<meta name="keywords" content="trabajo, empleos, cv, curriculum, empresas, carrera,servicios profesionales, tecnicos, bolsa de trabajo, servicios" />
	<meta name="author" content="remotepcsolutions.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


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
	<link rel="shortcut icon" href="<?=$prefix?>images/SOLOLOGO.png">
	<link rel="stylesheet" type="text/css" href="<?=$prefix?>bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="<?=$prefix?>css/animate.css" rel="stylesheet">
	<link href="<?=$prefix?>css/main.css?24" rel="stylesheet">
	<link href="<?=$prefix?>css/component.css?1" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
	<link rel="stylesheet" href="<?=$prefix?>icons/linearicons/style.css">
	<link rel="stylesheet" href="<?=$prefix?>icons/font-awesome/css/font-awesome.min.css">
	<!--link rel="stylesheet" href="<?=$prefix?>icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="<?=$prefix?>icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="<?=$prefix?>icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="<?=$prefix?>icons/rivolicons/style.css"-->
	<link rel="stylesheet" href="<?=$prefix?>css/style.css?31" >
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;1,100;1,400&display=swap" rel="stylesheet">
	<script type="text/javascript" src="<?=$prefix?>js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery.easing.1.3.js"></script>
	<!--script type="text/javascript" src="<?=$prefix?>js/jquery.waypoints.min.js"></script>
	
	<script type="text/javascript" src="<?=$prefix?>js/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery-filestyle.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery.countimator.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery.countimator.wheel.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery.responsivegrid.js"></script-->
	<script type="text/javascript" src="<?=$prefix?>js/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery.slicknav.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/jquery.responsivegrid.js"></script>
	<script type="text/javascript" src="<?=$prefix?>bootstrap/js/bootstrap.min.js"></script>
	<!--script type="text/javascript" src="<?=$prefix?>js/bootstrap-modalmanager.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/bootstrap-modal.js"></script-->
	<script type="text/javascript" src="<?=$prefix?>js/jquery.introLoader.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/wow.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/bootstrap-tokenfield.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/bootstrap3-wysihtml5.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/handlebars.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/slick.min.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/easy-ticker.js"></script>
	<script type="text/javascript" src="<?=$prefix?>js/validator.min.js"></script>
</head>
<style type="text/css">
.navbar-sticky > .container > .logo-wrapper > .logo > img {
	max-height: 5rem;

}
.navbar-sticky {
	background-color: white;
}
.navbar-sticky{
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
.ec-stars-wrapper {
  font-size: 0;
  display: inline-block;
}
.ec-stars-wrapper a {
  text-decoration: none;
  display: inline-block;
  color: #888;
}
.ec-stars-wrapper:hover a {
  color: #e9ab28;
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-color: #e9ab28;
}
.ec-stars-wrapper a:hover ~ a {
  color: gray;
  -webkit-text-fill-color: gray;
}

.stars-outer {
  font-size: 16px;
  position: relative;
  display: inline-block;
  color: blue;
  font-family: 'FontAwesome';
}

.stars-outer:before {
  content: '\f005 \f005 \f005 \f005 \f005';
  color: gray;
}

.stars-inner {
  position: absolute;
  top: 0;
  left: 0;
  white-space: nowrap;
  overflow: hidden;
  width: 0;
}

.stars-inner:before {
  content: '\f005 \f005 \f005 \f005 \f005';
  color: #e9ab28;
}

.stars {
  font-size : 20px;
  color: gray;
  cursor: pointer;
}

.star.hover {
  color: #e9ab28;
}

.star.is-selected {
  color: #e9ab28;
}
.ec-stars-wrapper > a{
	content: '\f005 ';
	color: gray;
	font-family: 'FontAwesome';
	font-size: 16px;
	display: inline-block;
}
.autocomplete {
  position: relative;
}

.autocomplete-items {
  position: absolute;
  border: 2px solid black;
  z-index: 99;
  margin-top: 2px;
  background: white;
  top: 100%;
  left: 0;
  right: 0;
  padding-bottom: 1em;
}
.autocomplete-items {
  padding: 10px;
  background-color: #fff;
}

.autocomplete-active {
  background-color: DodgerBlue !important;
  color: #ffffff;
  cursor: pointer;
}
.navbar-default > .container > .logo-wrapper > .logo-negro{
	display: none;
}
.navbar-sticky > .container > .logo-wrapper > .logo-blanco{
	display: none;
}
.not-transparent-header .navbar-default > .container > .logo-wrapper > .logo-negro{
	display: block;
}
.not-transparent-header .navbar-default > .container > .logo-wrapper > .logo-blanco{
	display: none;
}
.navbar-default  > .container > .navbar-nav-wrapper  > .nav li a {
	color: white;
}
.not-transparent-header  .navbar-default  > .container > .navbar-nav-wrapper > .nav > li > a  {
	color: black;
}
.navbar-sticky  > .container > .navbar-nav-wrapper > .nav > li > a {
	color: black;
}
.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
    color: #e9ab28 !important;
    background-color: transparent;
}

.navbar-default  > .container >  .nav-mini-wrapper > ul.nav-mini.sign-in li a {
	color: white;
	border-color: white;
}
.not-transparent-header  .navbar-default  > .container > .nav-mini-wrapper > ul.nav-mini.sign-in li a   {
	color: black;
	border-color: black;
}
.navbar-sticky  > .container > .nav-mini-wrapper > ul.nav-mini.sign-in li a  {
	color: black;
	border-color: black;
}

body{
	padding-top: 3em;
}


</style>
<header id="header">

	<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">
		<div class="container">
			<div class="logo-wrapper">
				<div class="logo logo-negro">
					<img class="img img-responsive" id="logo-logo" src="<?=$prefix?>images/LOGOFINAL.png"   alt="Logo" />
				</div>
				<div class="logo logo-blanco">
					<img class="img img-responsive" id="logo-logo"  src="<?=$prefix?>images/LOGOFINALBLANCO.png"   alt="Logo" />
				</div>
			</div>
			<div id="navbar" class="navbar-nav-wrapper navbar-arrow">
				<ul class="nav navbar-nav" id="responsive-menu">
					<li>
						<a  href="<?=$prefix?>./">Inicio</a>
					</li>
					<li>
						<a  href="<?=$prefix?>list.php"> Lista de servicios </a>
					</li>
					<li> 
						<a href="<?=$prefix?>contact.php">Contacto</a>
					</li>
				</ul>
			</div>

			<div class="nav-mini-wrapper">
				<ul  class="nav-mini sign-in">
<?php if (isset($user_online ) && $user_online == true): ?>
				    <li><a  href="<?=$prefix?>logout.php">Cerrar Sesión</a></li>
					<li><a  href="<?=$prefix?><?=$myrole?>">Perfil</a></li>
				
					
<?php else: ?>
					<li><a href="<?=$prefix?>login.php">Ingresar</a></li>
					<li><a href="<?=$prefix?>register.php">Registro</a></li>

				
<?php endif;?>
				</ul>
			</div>
		</div>
				
		<div id="slicknav-mobile"></div>
	</nav>
</header>