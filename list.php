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
	<div class="container-wrapper" style="padding-top: 8em;">
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
						<li><span><?=$title?></span></li>
					</ol>
				</div>
			</div>

			
			<div class="section sm">
				<div class="container">

					<div class="result-wrapper">
						<div class="row">
							<div class="col-md-3">
							<div class="settings">
          <h2 class="settings__header">B&uacute;squeda</h2>
          <div class="setting-group">
            <h3 class="setting-group__title c-gray">Datos a Buscar</h3>
            <ul class="setting-container min-list">
              <li class="setting">
                <i class="fa fa-user setting__icon"></i>
                <a href="profile.html" class="setting__link">Servicios</a>
              </li>
              <li class="setting">
                <i class="fa fa-cog setting__icon"></i>
                <a href="profile.html" class="setting__link">Empresas</a><input type="check" name="">
              </li>
              <li class="setting">
                <i class="fa fa-user setting__icon"></i>
                <a href="profile.html" class="setting__link">Perfiles</a>
              </li>
              <li class="setting">
                <i class="fa fa-user setting__icon"></i>
                <a href="profile.html" class="setting__link">Productos</a>
              </li>

            </ul><!-- .setting-container -->
          </div><!-- setting-group -->

          <div class="setting-group">
            <h3 class="setting-group__title c-gray">Manage Listings</h3>
            <ul class="setting-container min-list">
              <li class="setting setting--current">
                <i class="fa fa-clipboard setting__icon"></i>
                <a href="my-listings.html" class="setting__link">My Listings</a>
              </li>
              <li class="setting">
                <i class="fa fa-upload setting__icon"></i>
                <a href="create-listing.html" class="setting__link">Submit New Listing</a>
              </li>
            </ul><!-- .setting-container -->
          </div><!-- setting-group -->

          <div class="setting-group">
            <ul class="setting-container min-list">
              <li class="setting">
                <i class="fa fa-lock setting__icon"></i>
                <a href="change-password.html" class="setting__link">Change Password</a>
              </li>
              <li class="setting">
                <i class="fa fa-power-off setting__icon"></i>
                <a href="index.html" class="setting__link">Log Out</a>
              </li>
            </ul><!-- .setting-container -->
          </div><!-- setting-group -->
        </div><!-- .settings -->
						</div>
							<div class="col-sm-12 col-md-9 col-lg-9 mt-25">
						<div class="bg-dark">
							<h5 class="sorting-title "><?=$title?></h5>
					</div>
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
		$member_no =$rowb['member_no'];
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
										<center><img class="autofit3" alt="image" title="<?= $thecompname ?>" width="180" height="100" src="app/image-profiles.php?id=<?=$member_no?>"/></center>
<?php
	endif;?>
										</div>
										
										<div class="content">
											<div class="job-item-list-info">
												<div class="row">
													<div class="col-sm-7 col-md-8">
														<h4 class="heading"><?=$row['title']?></h4>
														<div class="meta-div clearfix mb-25">
															<span>por <a href="company.php?ref=<?=$compid?>">  <?= $thecompname ?> - Disponibilidad</a></span>
															<?=$sta?>
														</div>
														<p class="texing character_limit"><?=$row['description']?></p>
												<span class="stars-outer" data-rating="5">
                  <span class="stars-inner" style="width: 50%;"></span>
                </span>
                <span>(5 Reviews)</span>
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
																<?=$row['country']?>
															</li>
															<li>
																<span>Municipio:</span>
																<?=$row['city']?>
															</li>
															<li>
																<span>Experiencia:</span>
																<?=$row['experience'] ?>
															</li>
															<li>
																<span>Telefono: </span>
																<?=$row['telefono']?>
															</li>
														</ul>
													</div>
													
												</div>
											
											</div>
										
											<div class="job-item-list-bottom">
											
												<div class="row">
												
													<div class="col-sm-7 col-md-8">
														<div class="sub-category">
															<a><?= $row['category'] ?></a>
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
</body>
</html>
<?php ob_flush();