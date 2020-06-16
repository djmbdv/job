<?php 
require_once '../constants/settings.php'; 
require_once '../constants/check-login.php';
require_once '../constants/connection.php';

global $conn;
if(!$user_online || !isset($_GET["jobid"])){
	header("location: ../../login.php");
	die();
}

require '../constants/db_config.php'; 
$jobid = $_GET['jobid'];


	
$stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE job_id = :jobid and company = :myID");
$stmt->bindParam(':jobid', $jobid);
$stmt->bindParam(':myID',$myID);
$stmt->execute();

$rec = $stmt->rowCount();
$result = $stmt->fetchAll();
if ($rec == "0") {
	header("location:./");
	echo $rec."  ".$myID;
	die();
}
	
foreach($result as $row){
    $jobtitle = $row['title'];
	$jobcity = $row['city'];
	$jobcountry = $row['country'];
	$jobcategory = $row['category'];
	$jobtype = $row['type'];
	$experience = $row['experience'];
	$jobdescription = $row['description'];
	$jobrespo = $row['responsibility'];
	$jobreq = $row['requirements'];
	$closingdate = $row['closing_date'];		
}
$deep_url = 1;
include_once "../headerPrincipal.php";
$producto = false;
if(isset($_GET["p"]))$producto = true;
?>
<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">		
			<div class="breadcrumb-wrapper">			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Inicio</a></li>
						<li><a ><?=$compname?></a></li>
						<li><span><?=$jobtitle?></span></li>
					</ol>
				</div>
			</div>
			<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
							<div class="col-sm-5 col-md-4">
							
								<div class="company-detail-sidebar">
									
									<div class="image">
										<?php 
										if ($logo == null) {
										print '<center>Company Logo Here</center>';
										}else{
										echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
										}
										?>
									</div>
									
									<h2 class="heading mb-15"><h4><?php echo "$compname"; ?></h4>
								
									<p class="location"><i class="fa fa-map-marker"></i> <?php echo "$zip"; ?> <?php echo "$city"; ?>. <?php echo "$street"; ?>, <?php echo "$country"; ?> <span class="block"> <i class="fa fa-phone"></i> <?php echo "$myphone"; ?></span></p>
									
									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Establecida en:</h4>
											<?php echo "$esta"; ?>
										</li>
										<li>
											<h4 class="heading">Rubro:</h4>
											<?php echo "$mytitle"; ?>
										</li>
										<li>
											<h4 class="heading">Personas:</h4>
											<?php echo "$mypeople"; ?>
										</li>
										<li>
											<h4 class="heading">Website: </h4>
											<a target="_blank" href="https://<?php echo "$myweb"; ?>"><?php echo "$myweb"; ?></a>
										</li>
										<li>
											<h4 class="heading">Correo Electronico: </h4>
											<?php echo "$mymail"; ?>
										</li>

									</ul>
									
									
									<a href="./" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Editar</a>
									
								</div>
					
					
							</div>
							
							<div class="col-sm-7 col-md-8">
							
								<div class="company-detail-wrapper">

									<div class="company-detail-company-overview  mt-0 clearfix">
										
										<div class="section-title-02">
											<h3 class="text-left"><?php echo "$jobtitle"; ?></h3>
										</div>

										<form class="post-form-wrapper" action="app/update-job.php" method="POST" autocomplete="off">
								
											<div class="row gap-20">
											<?php include 'constants/check_reply.php'; ?>
										
												<div class="col-sm-8 col-md-8">
												
													<div class="form-group">
														<label>titulo de Empleo</label>
														<input name="title" value="<?php echo "$jobtitle"; ?>" required type="text" class="form-control" placeholder="Enter job title">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>City</label>
														<input name="city" value="<?php echo "$jobcity"; ?>"  required type="text" class="form-control" placeholder="Enter city">
													</div>
													
												</div>
												
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Pais</label>
														<select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Seleccionar</option>
						                                   <?php
	
                                                           $stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option <?php if ($jobcountry == $row['country_name']) { print ' selected '; } ?> value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option> <?php
	 
	                                                        }
														   ?>
														</select>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Categoria empleo</label>
															<select name="category" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Seleccionar</option>
						                                   <?php

                                                           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
                                                           $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option <?php if ($jobcategory == $row['category']) { print ' selected '; } ?> value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option> <?php
	 
	                                                        }
														   ?>
														</select>
											
														
													</div>
													
												</div>
											    <div class="col-sm-4 col-md-4">
												
												</div>
												
												<div class="clear"></div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>Categoria Empleo:</label>
														<select name="jobtype" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected>Seleccionar</option>
															<option <?php if ($jobtype == "Full-time") { print ' selected '; } ?> value="Full-time" data-content="<span class='label label-warning'>Full-time</span>">Full-time</option>
															<option <?php if ($jobtype == "Part-time") { print ' selected '; } ?> value="Part-time" data-content="<span class='label label-danger'>Part-time</span>">Part-time</option>
															<option <?php if ($jobtype == "Freelance") { print ' selected '; } ?> value="Freelance" data-content="<span class='label label-success'>Freelance</span>">Freelance</option>
														</select>
													</div>
													
												</div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>Experiencia:</label>
														<select name="experience" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected >Seleccionar</option>
															<option <?php if ($experience == "Expert") { print ' selected '; } ?> value="Expert">Experto</option>
															<option <?php if ($experience == "2 Years") { print ' selected '; } ?> value="2 Years">2 Años</option>
															<option <?php if ($experience == "3 Years") { print ' selected '; } ?> value="3 Years">3 Años</option>
															<option <?php if ($experience == "4 Years") { print ' selected '; } ?> value="4 Years">4 Años</option>
															<option <?php if ($experience == "5 Years") { print ' selected '; } ?> value="5 Years">5 Años</option>
														</select>
													</div>
													
													
												</div>

												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Descripción del empleo</label>
														<textarea class="form-control bootstrap3-wysihtml5" name="description" required placeholder="Enter description ..." style="height: 200px;"><?php echo "$jobdescription"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Funciones del empleo</label>
														<textarea name="responsiblities" required class="form-control bootstrap3-wysihtml5" placeholder="Enter responsiblities..." style="height: 200px;"><?php echo "$jobrespo"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Requirimientos</label>
														<textarea name="requirements" required class="form-control bootstrap3-wysihtml5" placeholder="Enter requirements..." style="height: 200px;"><?php echo "$jobreq"; ?></textarea>
													</div>
													<input type="hidden" name="jobid" value="<?php echo "$jobid"; ?>">
												</div>
												
												<div class="clear"></div>
												

												
												<div class="clear"></div>
												

												
												<div class="clear mb-10"></div>

												
												<div class="clear mb-15"></div>

												
												<div class="clear"></div>
												
												<div class="col-sm-6 mt-30">
													<button type="submit"  class="btn btn-primary btn-lg">Guardar Cambios</button>
												</div>

											</div>
											
										</form>
										
									</div>
									
							


								</div>

							</div>
						
						</div>
						
					</div>
				
				</div>
			
			</div>

			<?php include_once "../footer.php"; ?>
		
	</div>

<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>

</body>

</html>