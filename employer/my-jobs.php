	<!doctype html>
<html lang="es_ES">
<?php 
require '../constants/settings.php'; 
require 'constants/check-login.php';

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");		
}
}else{
header("location:../");	
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
						<li><span>Mis Publicaciones</span></li>
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
										
										<h3><?=$compname?></h3>
										
									</div>
									
									<div class="admin-user-action text-center">
									
										<a href="post-job.php" class="btn btn-primary btn-sm btn-inverse">Publicar Servicio</a>
										<a href="post-job.php?p=1" class="btn btn-primary btn-sm btn-inverse" style="margin:3em; ">Publicar Producto</a>
										
									</div>
									
									<ul class="admin-user-menu clearfix">
										<li >
											<a href="./"><i class="fa fa-user"></i> Perfil</a>
										</li>
										<li class="">
										<a href="change-password.php"><i class="fa fa-key"></i> Cambiar Contraseña</a>
										</li>
			
										<li>
											<a href="../company.php?ref=<?php echo "$myid"; ?>"><i class="fa fa-briefcase"></i> Descripción Empresa</a>
										</li>
										<li  class="active">
											<a href="my-jobs.php"><i class="fa fa-bookmark"></i> Empleos Publicados</a>
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
									
										<h2>Posted Jobs</h2>
										
									</div>
									<?php require 'constants/check_reply.php'; ?>
										<div class="job-item-grid-wrapper">
										

					
										<div class="GridLex-gap-30">
										
											<div class="GridLex-grid-noGutter-equalHeight">
									<?php
										require '../constants/db_config.php';
										try {
                                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = '$myid' ORDER BY enc_id DESC LIMIT $page1,5");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
   
                                        foreach($result as $row)
                                        {
										   $jobcity = $row['city'];
										   $jobcountry = $row['country'];
										   $type = $row['type'];
										   $title = $row['title'];
										   $deadline = $row['closing_date'];
										   if ($type == "Freelance") {
											 $sta = '<span class="label label-success">Freelance</span>';
											  
										   }
										   if ($type == "Part-time") {
											 $sta = '<span class="label label-danger">Part-time</span>';
											  
										   }
										   if ($type == "Full-time") {
											 $sta = '<span class="label label-warning">Full-time</span>';
											  
										   }
										   
										   ?>
										   										  <div class="GridLex-col-4_sm-6_xs-6_xss-12">
												
											<div class="job-item-grid">
													

											<div class="labeling">
											<?php echo "$sta"; ?>
											</div>
														
											<a target="_blank" href="../explore-job.php?jobid=<?php echo $row['job_id']; ?>">
														
											<div class="image">
															
											<div class="vertical-middle">
																
											<?php 
										    if ($logo == null) {
										     print '<center>Company Logo Here</center>';
										    }else{
										    echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
										     }
										     ?>
																
											</div>
																
											</div>
														
											<div class="content">
											<h4 class="heading"><?php echo "$title"; ?></h4>
											<p class="location"><i class="fa fa-map-marker text-primary"></i> <strong class="text-primary"><?php echo "$jobcountry" ?></strong> - <?php echo "$jobcity" ?></p>
											<p class="date text-muted font12 font-italic">Deadline - <?php echo "$deadline"; ?></p>
											</div>
															
											</a>
														
											<div class="content-bottom">
											<div class="sub-category">
											<a target="_blank" href="view-applicants.php?jobid=<?php echo $row['job_id']; ?>">Applicants</a>
											<a href="edit-job.php?jobid=<?php echo $row['job_id']; ?>">Edit Job</a>
											<a onclick = "return confirm('Are you sure you want to delete this job ?')" href="app/drop-job.php?id=<?php echo $row['job_id']; ?>">Delete Job</a>
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
											
										</div>
										
									</div>
									
								<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								require '../constants/db_config.php';
								try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = '$myid' ORDER BY enc_id");
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
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="my-jobs.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" <?php if ($b == $page ) { print 'class="active"'; } ?> ><a href="my-jobs.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="my-jobs.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>
									
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


<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="../js/bootstrap-modal.js"></script>
<script type="text/javascript" src="../js/smoothscroll.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="../js/wow.min.js"></script>
<script type="text/javascript" src="../js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="../js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="../js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="../js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../js/jquery-filestyle.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-select.js"></script>
<script type="text/javascript" src="../js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="../js/handlebars.min.js"></script>
<script type="text/javascript" src="../js/jquery.countimator.js"></script>
<script type="text/javascript" src="../js/jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="../js/slick.min.js"></script>
<script type="text/javascript" src="../js/easy-ticker.js"></script>
<script type="text/javascript" src="../js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="../js/jquery.responsivegrid.js"></script>
<script type="text/javascript" src="../js/customs.js"></script>


</body>



</html>