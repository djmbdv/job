<?php 
require_once 'constants/settings.php';
require_once 'constants/connection.php';
require 'constants/check-login.php';

global $conn;
global $actual_link;
global $isHttps;

$fromsearch = false;


if (isset($_GET['page'])) {
	$page = $_GET['page'];
	if ($page=="" || $page=="1"){
		$page1 = 0;
		$page = 1;
	}else{
		$page1 = ($page*16)-16;
	}					
}else{
	$page1 = 0;
	$page = 1;	
}
$cate = "";
if (isset($_GET['country']) && ($_GET['category']) ){
	$cate = urldecode($_GET['category']);
	$country =urldecode($_GET['country']);	
	$query1 = "SELECT * FROM tbl_jobs WHERE category = :cate AND country = :country ORDER BY enc_id DESC LIMIT $page1,12";
	$query2 = "SELECT * FROM tbl_jobs WHERE category = :cate AND country = :country ORDER BY enc_id DESC";
	$fromsearch = true;

	$slc_country = $country;
	$slc_category = $cate;
	$title = "$slc_category empleos en $slc_country";
}else{
	$query1 = "SELECT * FROM tbl_jobs ORDER BY enc_id DESC LIMIT $page1,12";
	$query2 = "SELECT * FROM tbl_jobs ORDER BY enc_id DESC";	
	$slc_country = "NULL";
	$slc_category = "NULL";	
	$title = "Lista de Servicios";
}

require 'headerPrincipal.php';
?>
<body class="not-transparent-header">
	<div class="container-wrapper" style="padding-top: 14em;">
		<div class="main-wrapper">
			<div class="second-search-result-wrapper">
				<div class="container">
					<form action="job-list.php" method="GET" autocomplete="off">
						<div class="second-search-result-inner">
							<span class="labeling">Buscar </span>
							<div class="row">
								<div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
									<div class="form-group form-lg">
										<select class="form-control" name="category" required>
											<option value="">-Seleccionar Categoria-</option>
<?php

$stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row): ?>
											<option value="<?= $row['category'] ?>"  <?= ($cate == $row['category'])?'selected':'' ?> >
												<?=  $row['category'] ?>
											</option>
<?php
endforeach; ?>			   
										</select>
									</div>
								</div>
								
								<div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
									<div class="form-group form-lg">
										<select class="form-control"  name="country" required>
										<option value="">-Seleccionar departamento-</option>
<?php
							
$stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row):
	$cnt = $row['country_name']; ?>	
										<option <?php if ($slc_country == "$cnt") { print ' selected '; } ?> value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option>
<?php
endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
									<button name="search" value="✓" type="submit" class="btn btn-block">Buscar</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list booking-step">
						<li><a href="./">Inicio</a></li>
						<li><span><?php echo "$title"; ?></span></li>
					</ol>
				</div>
			</div>

			
			<div class="section sm">
				<div class="container">
					<div class="sorting-wrappper">
						<div class="sorting-header">
							<h3 class="sorting-title"><?php echo "$title"; ?></h3>
						</div>
					</div>
					<div class="result-wrapper">
						<div class="row">
							<div class="col-sm-12 col-md-12 mt-25">
								<div class="result-list-wrapper">
<?php


$stmt = $conn->prepare($query1);
if ($fromsearch == true) {
	$stmt->bindParam(':cate', $slc_category);
	$stmt->bindParam(':country', $slc_country);
}
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
	$type = $row['type'];
	$compid = $row['company'];

	$stmtb = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$compid' and role = 'employer'");
	$stmtb->execute();
	$resultb = $stmtb->fetchAll();
	foreach($resultb as $rowb) {
		$complogo = $rowb['avatar'];
		$thecompname = $rowb['first_name'];	
		$telefono = isset($rowb['telefono'])? $rowb['telefono'] :"";
		}
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
	if ($complogo == null): ?>
										<center><img class="autofit3" alt="image"  src="images/blank.png"/></center>';
<?php
	else: ?>
										<center><img class="autofit3" alt="image" title="<?= $thecompname ?>" width="180" height="100" src="data:image/jpeg;base64,<?=base64_encode($complogo) ?>"/></center>
<?php
	endif;?>
										</div>
										
										<div class="content">
											<div class="job-item-list-info">
												<div class="row">
													<div class="col-sm-7 col-md-8">
														<h4 class="heading"><?php echo $row['title']; ?></h4>
														<div class="meta-div clearfix mb-25">
															<span>por <a href="company.php?ref=<?php echo "$compid"; ?>">  <?= $thecompname ?> - Disponibilidad</a></span>
															<?php echo "$sta"; ?>
														</div>
														
														<p class="texing character_limit"><?php echo $row['description']; ?></p>
													</div>
													
													<div class="col-sm-5 col-md-4">
														<div class="social meta-list" style="padding-bottom: 1em; ">
															<?php
																$url = urldecode(($isHttps?'https://':'http://' ).$actual_link.'/explore-job.php?jobid='.$row['job_id']);
															?>
														    <a href="whatsapp://send?text=<?=$url?>" id="share-wa" class="sharer button">
														    	<i class="fa fa-2x fa-whatsapp"></i>
														    </a>
															<a href="<?='https://www.facebook.com/sharer/sharer.php?u='.$url ?>" id="share-fb" class="sharer button"><i class="fa fa-2x fa-facebook-square"></i></a>
															<a href="https://twitter.com/intent/tweet?text=<?= $url ?>" id="share-tw" class="sharer button"><i class="fa fa-2x fa-twitter-square"></i></a>
															<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$url?>&title=<?= $row['title'] ?>" id="share-li" class="sharer button"><i class="fa fa-2x fa-linkedin-square"></i></a>
														</div>
  
														<ul class="meta-list">
															<li>
																<span>Departamento:</span>
																<?php echo $row['country']; ?>
															</li>
															<li>
																<span>Municipio:</span>
																<?php echo $row['city']; ?>
															</li>
															<li>
																<span>Experiencia:</span>
																<?php echo $row['experience']; ?>
															</li>
															<li>
																<span>Telefono: </span>
																<?php echo $row['telefono']; ?>
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
														<a target="_blank" href="explore-job.php?jobid=<?= $row['job_id']; ?>" class="btn btn-primary">Ver este Servicio</a>
													</div>
													
												</div>
											
											</div>
										
										
										</div>
									
									</div>
									<?php
	 
	                            }

 ?>
                                </div>
								
					
								<div class="pager-wrapper">
								
						        <ul class="pager-list">
								<?php
								$total_records = 0;
								
							
	                                $stmt = $conn->prepare($query2);
									if ($fromsearch == true) {
									$stmt->bindParam(':cate', $slc_category);
	                                $stmt->bindParam(':country', $slc_country);	
									}
	                                $stmt->execute();
	                                $result = $stmt->fetchAll();
	 
		                            foreach($result as $row){
			                        	$total_records++;
	                                }
	                            
	
                                $records = $total_records/12;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="job-list.php?page='.$prevpage.''; ?> <?php if ($fromsearch == true) { print '&category='.$cate.'&country='.$country.'&search=✓'; }'';} print '"><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="job-list.php?page=<?php echo "$b"; ?><?php if ($fromsearch == true) { print '&category='.$cate.'&country='.$country.'&search=✓'; }?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="job-list.php?page='.$nextpage.''; ?> <?php if ($fromsearch == true) { print '&category='.$cate.'&country='.$country.'&search=✓'; }'';} print '"><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					                </div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
			<?php require 'footer.php';?>

			
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