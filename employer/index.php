<?php

require_once '../constants/connection.php';
require_once '../constants/check-login.php';
require_once '../constants/settings.php';
global $conn;
global $title_site;

if (!$user_online  || $myrole != "employer") {
	header('location:../');
	die();
}
$deep_url = 1;
include "../headerPrincipal.php";
?>
<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Inicio</a></li>
						<li><span>perfil</span></li>
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
	if ($logo == null): ?>
											<center>Company Logo Here</center>
<?php 
	else: ?>
											<center>
												<img alt="image" title="<?=$compname?>" width="180" height="100" src="data:image/jpeg;base64,<?=base64_encode($logo) ?>"/>
											</center>	
<?php
	endif; ?>
											<br/>
										</div>
										<h4><?= $compname ?></h4>
									</div>
									<div class="admin-user-action text-center">
										<a href="post-job.php" class="btn btn-primary btn-sm "> <p style="color:black">Publicar servicio</p> </a>
										
									</div>
									<div class="admin-user-action text-center">
									
										<a href="post-job.php?p=true" class="btn btn-primary btn-sm "><p style="color:black">Publicar producto</p></a>
										
									</div>
									<ul class="admin-user-menu clearfix">
										<li  class="active">
											<a href="./"><i class="fa fa-user"></i>Perfil</a>
										</li>
										<li class="">
										<a href="change-password.php"><i class="fa fa-key"></i>Cambiar Contraseña</a>
										</li>
										<li>
											<a href="../company.php?ref=<?=$myid?>"><i class="fa fa-briefcase"></i>Descripción Empresa</a>
										</li>
										<li>
											<a href="my-jobs.php"><i class="fa fa-eye"></i>Ver Servicios y productos publicados</a>
										</li>
										<li>
											<a href="../logout.php"><i class="fa fa-sign-out"></i>Cerrar Sesi&oacute;n</a>
										</li>
									</ul>
								</div>
							</div>
							
							<div class="GridLex-col-9_sm-8_xs-12">
								<div class="admin-content-wrapper">
									<div class="admin-section-title">
										<h2>Perfil de su empresa</h2>
									</div>
									<form class="post-form-wrapper" action="app/update-profile.php" method="POST" autocomplete="off">
											<div class="row gap-20">
												<?php include 'constants/check_reply.php'; ?>
												<div class="clear"></div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Nombre de la empresa</label>
														<input name="company" placeholder="Enter Nombre de Empresa" type="text" class="form-control" value="<?= $compname ?>" required>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>NIT</label>
														<input class="form-control" placeholder="ingrese su nit" name="type"  type="text" value="<?= $mytitle ?>" /> 
													</div>
												</div>
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Ciudad</label>
														<input name="city" required type="text" class="form-control" value="<?php echo "$city"; ?>" placeholder="Ingresa tu city">
													</div>
												</div>
												
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Direccion</label>
														<input name="street" required type="text" class="form-control" value="<?=$street?>" placeholder="Ingresa tu street"  required>
													</div>
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Código Postal</label>
														<input name="zip"  type="text" class="form-control" value="<?=$zip ?>" placeholder="Ingresa tu zip">
													</div>
												</div>
												
												
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Departamento</label>
														<select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Seleccionar</option>
<?php

	$stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach($result as $row):?>
                                                           	<option <?= ($country == $row['country_name']) ? 'selected':'' ?> value="<?= $row['country_name']?>"><?=$row['country_name']?></option>
<?php
	endforeach;
	
														   ?>
														</select>
													</div>
												</div>
												<div class="clear"></div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Teléfono</label>
														<input type="tel" name="phone" required class="form-control" value="<?=$myphone?>" placeholder="Ingresa tu telefono"  required>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Correo Electrónico</label>
														<input type="email" name="email" required class="form-control" value="<?=$mymail?>" placeholder="Ingresa tu email">
													</div>
												</div>
												<div class="col-sm-6 mt-4">
													<label>Página Web</label>
														<input type="text" class="form-control" value="<?php echo "$myweb"; ?>" name="web" placeholder="Ingresa tu website">
												</div>
												<div class="col-sm-12 mt-10">
													<button type="submit" class="btn btn-primary"><p style="color:black">Guardar</p></button>
													<button type="reset" class="btn btn-warning"><p style="color:black">Cancelar</p></button>
												</div>
											</div>
										</form>
										<br>
										<form action="app/new-dp.php" method="POST" enctype="multipart/form-data">
											<div class="row gap-20">
											<div class="col-sm-12 col-md-12">
											<div class="form-group bootstrap3-wysihtml5-wrapper">
												<label><h1>Elija foto o logo para perfil</h1></label>
												<input  class="btn btn-warning" accept="image/*" type="file" name="image"  required >
											</div>
														
											</div>
													
											<div class="clear"></div>
								
											<div class="col-sm-12 mt-10">
											<button type="submit" class="btn btn-primary"><p style="color:black">Actualizar</p></button>
<?php if ($logo == null):?>
												<a onclick = "return confirm('Are you sure you want to delete your logo ?')" class="btn btn-primary btn-inverse" href="app/drop-dp.php"><p style="color:black">Eliminar</p></a>
<?php endif;?>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php include_once "../footer.php";?>
		</div>
	</div>
<div id="back-to-top">
   <a href="#"><i class="fa fa-arrow-up"></i></a>
</div>
</body>
</html>