<?php

require_once 'constants/settings.php'; 
require_once 'constants/check-login.php';
require_once 'constants/connection.php';


global $conn;

if (!isset($_GET['ref'])){
	header("location:./");
	die();
}


$company_id = $_GET['ref'];



try {


	$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = :memberno AND role = 'employer'");
	$stmt->bindParam(':memberno', $company_id);
	$stmt->execute();
//	$result = $stmt->fetchAll();
	$rec = $stmt->rowCount();
	
if ($rec == 0) {
	header("location:./");
	die();	
}else{
	$row = $stmt->fetchObject();
	$compname = $row->first_name;
	$compesta = $row->byear;
	$compmail  = $row->email;
	$comptype = $row->title;
	$compphone = $row->phone;
	$compcity = $row->city;
	$compstreet = $row->street;
	$compzip = $row->zip;
	$compcountry = $row->country;
	$compbout = $row->about;
	$complogo = $row->avatar;
	$compserv = $row->services;
	$compexp = $row->expertise;
	$compweb = $row->website;
	$comppeopl = $row->people;
}

				  
}catch(PDOException $e){

}



if (isset($_GET['page'])) {
	$page = $_GET['page'];
	if ($page=="" || $page=="1"){
		$page1 = 0;
		$page = 1;
	}else{
		$page1 = ($page*5)-5;
	}					
}else{
	$page1 = 0;
	$page = 1;	
}

require 'headerPrincipal.php';
?><body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list booking-step">
						<li><a href="employers.php">Empresas</a></li>
						<li><span><?=$compname?></span></li>
					</ol>
				</div>
			</div>
			<div class="section sm" >
				<div class="container">
					<div class="container">
						<div class="resume">
						    <header class="page-header">
						    <h1 class="page-title">Resumen de <?=$compname?></h1>
						  </header>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
								<div class="panel panel-default">
									<div class="panel-heading resume-heading">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-xs-12 col-sm-4">
													<div class="img-circle img-responsive">
			<?php 
if ($complogo == null):?>
														<center>Company Logo Here</center>
<?php
	else:?>
														<center>
															<img alt="image" title="<?=$compname?>" width="180" height="100" src="app/image-profiles.php?id=<?=$company_id?>"/>
														</center>
<?php
	endif; ?>
													</div>
													<div class="row">
		                								<div class="col-xs-12 social-btns">
		               
		                								</div>
	              									</div>              
												</div>
									            <div class="col-xs-12 col-sm-8">
									              <ul class="list-group">
									                <li class="list-group-item"><?=$compname?></li>
									                <li class="list-group-item">	<i class="fa fa-map-marker"></i>	<?=$compzip?> <?=$compcity?>. , <?=$compcountry?> <?=$compstreet?></li>
									                <li class="list-group-item"> NIT:	<?php echo "$comptype"; ?> </li>
									                <li class="list-group-item"><i class="fa fa-phone"></i> 	  <?= $user_online?  $compphone:  '<a class="only-logged" href="#">Ver tel&eacute;fono</a>' ?> </li>
									                <li class="list-group-item"><i class="fa fa-amp"></i> pagina web: <a target="_blank" href="//<?=$compweb?>"><?=$compweb?></a></li>
									              </ul>
									            </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="section-title mb-40">
					<h4 class="text-left">Trabajos ofrecidos por <?=$compname?></h4>
				</div>
				<div class="result-list-wrapper">
					<?php
try {

	$stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = :compid ORDER BY enc_id DESC LIMIT 5");
	$stmt->bindParam(':compid', $company_id);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach($result as $row):
		$type = $row['type'];

?>
										<div class="job-item-list">
										
											<div class="image">
												<?php 
	if ($complogo == null) {
		echo '<center><img class="autofit3" alt="image"  src="images/blank.png"/></center>';
	}else{
		echo '<center><img class="autofit3" alt="image" title="'.$compname.'" width="180" height="100" src="http://127.0.0.1/job/app/image-profiles.php?id='.$company_id .'"/></center>';	
}?>
											</div>
											<div class="content">
												<div class="job-item-list-info">
													<div class="row">													
														<div class="col-sm-7 col-md-8">
														
															<h4 class="heading"><?= $row['title']?></h4>
															<div class="meta-div clearfix mb-25">
															<span>a <a href="company.php?ref=<?=$company_id?>"><?=$compname?></a></span>
															</div>
															
															<p class="texing"><?=$row['description']?></p>
														</div>
														
														<div class="col-sm-5 col-md-4">
															<ul class="meta-list">
																<li>
																	<span>Departamento:</span>
																	<?= $row['country']; ?>
																</li>
																<li>
																	<span>Ciudad:</span>
																	<?= $row['city']; ?>
																</li>
																<li>
																	<span>Experiencia:</span>
																	<?= $row['experience']; ?>
																</li>
																<li>
																	<span>Tel&eacute;fono:</span>
																	<?= $user_online?   $row['telefono']: '<a class="only-logged" href="#">Ver tel&eacute;fono</a>' ?>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="job-item-list-bottom">
												
													<div class="row">
														<div class="col-sm-7 col-md-8">
															<div class="sub-category">
																<a><?=$row['category']?></a>
															</div>
														</div>
														<div class="col-sm-5 col-md-4">
															<a target="_blank" href="explore-job.php?jobid=<?php echo $row['job_id']; ?>" class="btn btn-primary">Ver Servicio</a>
														</div>
													</div>
												</div>
											</div>
										</div>
<?php endforeach;}catch(PDOException $e){}?>
									</div>
								<div class="pager-wrapper">
						            <ul class="pager-list">
<?php
$total_records = 0;
try {
	$stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = :compid ORDER BY enc_id DESC");
	$stmt->bindParam(':compid', $company_id);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$total_records = $stmt->rowCount();
}catch(PDOException $e){
}

$records = $total_records/5;
$records = ceil($records);
if ($records > 1 ) {
$prevpage = $page - 1;
$nextpage = $page + 1;
								
print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="company.php?ref='.$company_id.'&page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
for ($b=1;$b<=$records;$b++){?>
									<li  class="paging-nav" >
										<a <?= ($b == $page)?' style="background-color:#33B6CB; color:white" ':"" ?>  href="company.php?ref=<?=$company_id?>&page=<?=$b?>"><?= $b." "?></a>
									</li>
								<?php
}	
	echo '<li class="paging-nav"'; if ($page == $records) { echo 'class="disabled"'; } echo '><a '; if ($page == $records) { echo ''; } else { echo 'href="company.php?ref='.$company_id .'&page='.$nextpage.'"';} echo '><i class="fa fa-chevron-right"></i></a></li>';
}?>
						        	</ul>
					            </div>
							</div>						
						</div>						
					</div>
				</div>
			</div>
			<?php include_once "footer.php";?>
		</div>
	</div>
	<div id="back-to-top">
	   <a href="#"><i class="ion-ios-arrow-up"></i></a>
	</div>
</body>
</html>