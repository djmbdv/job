<!doctype html>
<html lang="es_ES">
<?php 
require 'constants/settings.php'; 
require 'constants/check-login.php';
require 'constants/db_config.php';

if (isset($_GET['ref'])) {

$company_id = $_GET['ref'];



    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = :memberno AND role = 'employer'");
	$stmt->bindParam(':memberno', $company_id);
    $stmt->execute();
    $result = $stmt->fetchAll();
	$rec = count($result);
	
	if ($rec == "0") {
	header("location:./");	
	}else{

    foreach($result as $row)
    {
		
    $compname = $row['first_name'];
	$compesta = $row['byear'];
    $compmail  = $row['email'];
	$comptype = $row['title'];
    $compphone = $row['phone'];
	$compcity = $row['city'];
	$compstreet = $row['street'];
	$compzip = $row['zip'];
    $compcountry = $row['country'];
    $compbout = $row['about'];
	$complogo = $row['avatar'];
	$compserv = $row['services'];
	$compexp = $row['expertise'];
	$compweb = $row['website'];
	$comppeopl = $row['people'];
	
	}
	
	}

					  
	}catch(PDOException $e)
    {
 
    }
	
}else{
header("location:./");
}

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*5)-5;
}					
}else{
$page1 = 0;
$page = 1;	
}
require 'headerPrincipal.php'

?>



<body class="not-transparent-header">

	<div class="container-wrapper">

	
	
		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="employers.php">Empresas</a></li>
						<li><span><?php echo "$compname"; ?></span></li>
					</ol>
					
				</div>
				
			</div>

			
			<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
							<div class="col-md-10 col-md-offset-1">
							
								<div class="company-detail-wrapper">
								
									<div class="company-detail-header text-center">
										
										<div class="image">
										<?php 
										if ($complogo == null) {
										print '<center>Company Logo Here</center>';
										}else{
										echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										}
										?>
										</div>
										
										<h2 class="heading mb-15"><?php echo "$compname"; ?></h2>
									
										<p class="location"><i class="fa fa-map-marker"></i> <?php echo "$compzip"; ?> <?php echo "$compcity"; ?>. <?php echo "$compstreet"; ?>, <?php echo "$compcountry"; ?> <span class="mh-5">|</span> <i class="fa fa-phone"></i> <?php echo "$compphone"; ?></p>
										
										<ul class="meta-list clearfix">
										<!--	<li>
												<h4 class="heading">Establecida en:</h4>
												<?php echo ""; ?>
											</li>  -->
											
											<li>
												<h4 class="heading"></h4>
												<?php echo ""; ?>
											</li>	
											<li>
												<h4 class="heading">Rubro:</h4>
												<?php echo "$comptype"; ?>
											</li>
											<li>
												<h4 class="heading">Página Web: </h4>
												<a target="_blank" href="https://<?php echo "$compweb"; ?>"><?php echo "$compweb"; ?></a>
											</li>
										</ul>
										
									</div>
						
									<div class="company-detail-company-overview clearfix">
									
										<h3>Descripción de la Empresa</h3>
										
										<p><?php echo "$compbout"; ?></p>

										
										<h3>Servicios</h3>
										
										<p><?php echo "$compserv"; ?></p>
										
										<h3>Experiencia</h3>
										
										<p><?php echo "$compexp"; ?></p>
										
									</div><br><br>

									
									<div class="section-title mb-40">
						
										<h4 class="text-left">trabajos ofrecidos en <?php echo "$compname"; ?></h4>
										
									</div>

									<div class="result-list-wrapper">
									<?php
									require 'constants/db_config.php';
									
									try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
                                    $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = :compid ORDER BY enc_id DESC LIMIT 5");
                                    $stmt->bindParam(':compid', $company_id);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();

                                    foreach($result as $row)
                                    {
									$post_date = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'd');
                                    $post_month = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'F');
                                    $post_year = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'Y');
									$type = $row['type'];
									if ($type == "Freelance") {
									$sta = '<span class="job-label label label-success">Freelance</span>';
											  
									}
									if ($type == "Part-time") {
									$sta = '<span class="job-label label label-danger">Part-time</span>';
											  
									}
									if ($type == "Full-time") {
									$sta = '<span class="job-label label label-warning">Full-time</span>';
											  
									}
									
									?>
										<div class="job-item-list">
										
											<div class="image">
										<?php 
										if ($complogo == null) {
										print '<center><img class="autofit3" alt="image"  src="images/blank.png"/></center>';
										}else{
										echo '<center><img class="autofit3" alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										}
										 ?>
											</div>
											
											<div class="content">
												<div class="job-item-list-info">
												
													<div class="row">
													
														<div class="col-sm-7 col-md-8">
														
															<h4 class="heading"><?php echo $row['title']; ?></h4>
															<div class="meta-div clearfix mb-25">
															<span>a <a href="company.php?ref=<?php echo "$company_id"; ?>"><?php echo "$compname"; ?></a></span>
															<?php echo "$sta"; ?>
															</div>
															
															<p class="texing"><?php echo $row['description']; ?></p>
														</div>
														
														<div class="col-sm-5 col-md-4">
														<ul class="meta-list">
															<li>
																<span>País:</span>
																<?php echo $row['country']; ?>
															</li>
															<li>
																<span>Ciudad:</span>
																<?php echo $row['city']; ?>
															</li>
															<li>
																<span>Experiencia:</span>
																<?php echo $row['experience']; ?>
															</li>
															<li>
																<span>Fecha Limite: </span>
																<?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?>
															</li>
														</ul>
														</div>
														
													</div>
												
												</div>
											
												<div class="job-item-list-bottom">
												
													<div class="row">
													
														<div class="col-sm-7 col-md-8">
														<div class="sub-category">
															<a><?php echo $row['category']; ?></a>

														</div>
														</div>
														
													<div class="col-sm-5 col-md-4">
														<a target="_blank" href="explore-job.php?jobid=<?php echo $row['job_id']; ?>" class="btn btn-primary">Ver empleo</a>
													</div>
														
													</div>
												
												</div>
											
											
											</div>
										
										</div>
										<?php
		
 
	                                }

					  
	                                }catch(PDOException $e)
                                    {

                                    }
	                                     ?>

									</div>
								<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								require'constants/db_config.php';
								try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
                                $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = :compid ORDER BY enc_id DESC");
                                $stmt->bindParam(':compid', $company_id);
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                foreach($result as $row)
                                {
		                        $total_records++;
	 
	                            }

					  
	                            }catch(PDOException $e)
                                {
                         
                                 }
	
								$records = $total_records/5;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="company.php?ref='.$company_id.'&page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="company.php?ref=<?php echo "$company_id"; ?>&page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="company.php?ref='.$company_id.'&page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
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
											<li><a href="../">Inicio</a></li>
											<li><a href="../job-list.php">Lista de empleos</a></li>
											<li><a href="../employers.php">Empresas</a></li>
											<li><a href="../employees.php">Personas</a></li>
											<li><a href="../contact.php">Contacto</a></li>
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
 

<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="js/handlebars.min.js"></script>
<script type="text/javascript" src="js/jquery.countimator.js"></script>
<script type="text/javascript" src="js/jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/easy-ticker.js"></script>
<script type="text/javascript" src="js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
<script type="text/javascript" src="js/customs.js"></script>


</body>


</html>