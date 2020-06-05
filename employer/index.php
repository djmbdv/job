<?php

require_once '../constants/settings.php';
require_once '../constants/connection.php';
require_once 'constants/check-login.php';

global $conn;
global $title_site;

if (!$user_online  || $myrole != "employer") {
	header('location:../');
	die();
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
									
										<a href="post-job.php" class="btn btn-primary btn-sm btn-inverse">Publicar Servicio</a>
										
									</div>
									<ul class="admin-user-menu clearfix">
										<li  class="active">
											<a href="./"><i class="fa fa-user"></i> Perfil</a>
										</li>
										<li class="">
										<a href="change-password.php"><i class="fa fa-key"></i> Cambiar Contraseña</a>
										</li>
			
										<li>
											<a href="../company.php?ref=<?php echo "$myid"; ?>"><i class="fa fa-briefcase"></i> Descripción Empresa</a>
										</li>
										<li>
											<a href="my-jobs.php"><i class="fa fa-bookmark"></i> Posted Jobs</a>
										</li>
										<li>
											<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
										</li>
									</ul>
								</div>
							</div>
							
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
									
										<h2>Perfil</h2>
										<p>
											&Uacute;ltimo inicio de sesi&oacute;n: <span class="text-info"><?= $mylogin ?></span>
										</p>
										
									</div>
									
									<form class="post-form-wrapper" action="app/update-profile.php" method="POST" autocomplete="off">
								
											<div class="row gap-20">
												<?php include 'constants/check_reply.php'; ?>
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-8">
												
													<div class="form-group">
														<label>Nombre</label>
														<input name="company" placeholder="Enter Nombre de Empresa" type="text" class="form-control" value="<?= $compname ?>" required>
													</div>
													
												</div>
												<div class="clear"></div>
								
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Rubro</label>
                                                    	<input class="form-control" placeholder="Ej: Ventas, Viajes" name="type" required type="text" value="<?= $mytitle ?>" required/> 
													</div>
													
												</div>
												
												<div class="clear"></div>

													<div class="form-group">
													<div class="col-sm-6 col-md-4">
														<label>Página Web</label>
														<input type="text" class="form-control" value="<?php echo "$myweb"; ?>" name="web" placeholder="Ingresa tu website">
													</div>
														
												</div>
												
												<div class="clear"></div>
												<br>
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Ciudad/Pueblo</label>
														<input name="city" required type="text" class="form-control" value="<?php echo "$city"; ?>" placeholder="Ingresa tu city">
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Calle</label>
														<input name="street" required type="text" class="form-control" value="<?=$street?>" placeholder="Ingresa tu street">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Código Postal</label>
														<input name="zip" required type="text" class="form-control" value="<?=$zip ?>" placeholder="Ingresa tu zip">
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
														<input type="tel" name="phone" required class="form-control" value="<?= $myphone ?>" placeholder="Ingresa tu phone">
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Correo Electrónico</label>
														<input type="email" name="email" required class="form-control" value="<?php echo "$mymail"; ?>" placeholder="Ingresa tu email">
													</div>
												</div>

												


												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Historia de ti o de tu Empresa</label>
														<textarea name="background" class="bootstrap3-wysihtml5 form-control" placeholder="Ingresa historia de la empresa ..." style="height: 200px;"><?= $desc ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Cuentanos un poco sobre tus Servicios</label>
														<textarea name="services" class="bootstrap3-wysihtml5 form-control" placeholder="Ingresa servicios de la empresa ..." style="height: 200px;">
															<?= $myserv ?>
														</textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Cuentanos un poco sobre tu Experiencia</label>
														<textarea name="expertise" class="bootstrap3-wysihtml5 form-control" placeholder="Ingresa experiencia de la empresa ..." style="height: 200px;">
															<?= $myex ?>
														</textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="col-sm-12 mt-10">
													<button type="submit" class="btn btn-primary">Guardar</button>
													<button type="reset" class="btn btn-warning">Cancelar</button>
												</div>
											</div>
										</form>

										<br>
										
										<form action="app/new-dp.php" method="POST" enctype="multipart/form-data">
										<div class="row gap-20">
										<div class="col-sm-12 col-md-12">
												
										<div class="form-group bootstrap3-wysihtml5-wrapper">
										<label><h1>Elija un logo para perfil</h1></label>
										<input  class="btn btn-success" accept="image/*" type="file" name="image"  required >
										</div>
													
										</div>
												
										<div class="clear"></div>

										<div class="col-sm-12 mt-10">
										<button type="submit" class="btn btn-primary">Actualizar</button>
										<?php 
										if ($logo == null) {

										}else{
										?><a onclick = "return confirm('Are you sure you want to delete your logo ?')" class="btn btn-primary btn-inverse" href="app/drop-dp.php">Eliminar</a> <?php
										}
										?>
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
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
</body>
</html>