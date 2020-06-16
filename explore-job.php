<?php

require_once 'constants/settings.php'; 
require_once 'constants/connection.php'; 

global $conn;
global $actual_link;
$closingdate = "";

if(!isset($_GET['jobid']) || !is_numeric($_GET['jobid'])){
	header('location: ./');
	die();
}
$jobid = $_GET['jobid'];

$stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE job_id = :jobid");
$stmt->bindParam(':jobid', $jobid);
$stmt->execute();
$result = $stmt->fetchAll();
$rec = count($result);
if ($rec == "0") {
	header("location:./");	
}else{
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
		$opendate = $row['date_posted'];
		$compid = $row['company'];
	}
}
	
$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$compid'");
$stmt->execute();
$result = $stmt->fetchAll();

$member_no =  $compid;
foreach($result as $row){
    $compname = $row['first_name'];
	$complogo = $row['avatar'];
	$compbout = $row['about'];
}

					

$protocol = $isHttps? 'https://':'http://';
$local = LOCAL ? "/job" : "";
$tags_share  = array(
	"og:url"    => $protocol.$actual_link."$local/explore-job.php?jobid=".$jobid,
    "og:type"  => "article",
    "og:title" => $jobtitle,
    "og:description" => $jobdescription, 
    "og:image" => "$protocol$actual_link$local/app/image-profiles.php?id=$member_no" );
include_once 'headerPrincipal.php';

?>

<div>

</div>
<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list booking-step">
						<li><a href="/">Inicio</a></li>
						<li><a target="_blank" href="company.php?ref=<?= $compid ?>"><?= $compname ?></a></li>
						<li><span><?= $jobtitle ?></span></li>
					</ol>
				</div>
			</div>
			
			<div class="section sm">
				<div class="container">
					<div class="row">
						<div class="col-md-9 ">
							<div class="job-detail-wrapper">
								<div class="job-detail-header text-center">
									<h2 class="heading mb-15"><?=$jobtitle?></h2>
									<div class="meta-div clearfix mb-25">
<?php
	$stmt2 = $conn->prepare("select count(value) as num, avg(value) as prom from tbl_votes where job_id = :job_id");
		$stmt2->bindValue(":job_id",$jobid);
		$stmt2->execute();
		$votos = $stmt2->fetchObject();
	if($user_online):


	 ?>
										<div class="line-stars">
											<div class="ec-stars-wrapper">
												<a href="#" data-value="1" class="fa fa-star star" title="Votar con 1 estrellas"></a>
												<a href="#" data-value="2" class="fa fa-star star" title="Votar con 2 estrellas"></a>
												<a href="#" data-value="3" class="fa fa-star star" title="Votar con 3 estrellas"></a>
												<a href="#" data-value="4" class="fa fa-star star" title="Votar con 4 estrellas"></a>
												<a href="#" data-value="5" class="fa fa-star star" title="Votar con 5 estrellas"></a>
											</div>
										</div>
<?php
	else:
	
		?>
										<span class="stars-outer" data-rating="5">
					              			<span class="stars-inner" style="width: <?=(($votos->prom/5)*100)."%" ?>;" ></span>
					            		</span>
					            		<span>(<?=$votos->num?> Votos)</span>
<?php
	endif; ?>										
									
									</div>
									
									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Ubicaci&oacute;n:</h4>
											<?=$jobcity?> , <?=$jobcountry?>
										</li>
										<li>
											<h4 class="heading">Publicado el: </h4>
											<?=$opendate ?>
										</li>
									</ul>
								</div>
								<div class="job-detail-company-overview clearfix">
									<h3>Un resumen sobre la empresa</h3>
									<div class="row">
										<div class="col col-3">
											<div class="image">
<?php
	if($complogo == null): ?>
												<center>No Company Logo</center>
<?php
	else: ?>
												<center>
												
													<img class="autofit2" alt="image" title="<?= $compname ?>" width="180" height="100" src="app/image-profiles.php?id=<?=$member_no?>"/>

													<div class="col col-9">
														<br>
														<p><?=$compbout?></p>
													</div>
												</center>
											</div>			
<?php
	endif;?>
										</div>
									</div>
								
								<div class="job-detail-content mt-30 clearfix">
									<h3>Descripcion del servicio</h3>
									<p><?= $jobdescription ?></p>
									<hr>

							<!--		<h3>Actividades que puedo realizar</h3>
                                    <p><?= $jobrespo ?></p>
									<hr>

									<h3>Habilidades</h3>
                                    <p><?= $jobreq ?></p>
									<hr> -->

								</div>
								<div class="tab-style-01">
									<ul class="nav" role="tablist">
										<li role="presentation" class="active"><h4><a href="#relatedJob1" role="tab" data-toggle="tab">Mas servicios de  <?=$compname?></a></h4></li>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="relatedJob1">
											<div class="tab-content-inner">
												<div class="recent-job-wrapper alt-stripe mr-0">
<?php
	$stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = '$compid' AND job_id != :jobid ORDER BY rand() LIMIT 5");
	$stmt->bindParam(':jobid', $jobid);
	$stmt->execute();
	$result = $stmt->fetchAll();


	foreach($result as $row):
		$jobtype = $row['type'];

		$jobtype = $row['type'];
		$member_no = $row['member_no'];

?>
													<a href="explore-job.php?jobid=<?= $row['job_id']?>" class="recent-job-item clearfix">
														<div class="GridLex-grid-middle">
															<div class="GridLex-col-6_sm-12_xs-12">
																<div class="job-position">
																	<div class="image">
<?php
		if ($complogo == null): ?>
											                            <center>
											                            	<img class="autofit3" alt="image"  src="images/blank.png"/>
											                            </center>
<?php 
		else: ?>
											                           	<center>
											                           		<img class="autofit3" alt="image" title="'.$compname.'" width="180" height="100" src="app/image-profiles.php?id=<?=$member_no?>"/>
											                           	</center>
<?php
		endif; ?>
																	</div>
																	<div class="content">
																		<h4><?= $row['title']; ?></h4>
																		<p><?=  $compname ?></p>
																	</div>
																</div>
															</div>
															<div class="GridLex-col-3_sm-8-xs-8_xss-12 mt-10-xss">
																<div class="job-location">
																	<i class="fa fa-map-marker text-primary"></i>
																	<?= $row['country'] ?>
																</div>
															</div>
														</div>
													</a>
<?php															
	endforeach;
?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php 
	require_once 'footer.php'; ?>
		
	</div> 
	<div id="back-to-top">
	   <a href="#"><i class="ion-ios-arrow-up"></i></a>
	</div>
<script type="text/javascript">
	$(".star").click(e =>{
		$(e.srcElement).parent().addClass("voting");
		$(e.srcElement).parent().find("a:lt("+$(e.srcElement).attr("data-value")+  ")").addClass("is-selected");
		$(e.srcElement).parent().find("a:gt("+(parseInt( $(e.srcElement).attr("data-value"))-1) +")").removeClass("is-selected");
		$.get("app/starts.php",{
			"id":"<?=$jobid?>",
			"voto":$(e.srcElement).attr("data-value")
		}).done((data)=>{
			if(data== 1)$(e.srcElement).parent().removeClass("voting");
		});
	});
</script>
</body>


</html>
<?php ob_flush();