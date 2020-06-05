<?php

require_once 'constants/settings.php';
require_once 'constants/connection.php';
require_once 'constants/check-login.php';
global $conn;
global $actual_link;
global $isHttps;

$fromsearch = false;
$numlist = 12;


$page = isset($_GET["page"])? intval($_GET["page"]) >= 1 ?intval($_GET["page"]):1:1;
$offset = ($page - 1) * $numlist;
$cate = "";
$country = "";

//	echo "Entro aqui";
$cate = urldecode(isset($_GET['category'])?$_GET['category']:"");
$country =urldecode(isset($_GET['country'])?$_GET['country']:"");
$cate.='%';
$country.='%';	
$query1 = isset($_GET['category']) ? "SELECT * FROM tbl_jobs WHERE category like :cate ": "SELECT * FROM tbl_jobs ";
if(isset($_GET['country']))$query1.= "AND country like :country ";
$query2 = (string)$query1;
$query1.="ORDER BY enc_id DESC LIMIT $offset,12";
$stmt = $conn->prepare($query1);
$stmt->bindParam(':cate', $cate);
if(isset($_GET['country']))$stmt->bindParam(':country', $country);
$slc_country = $country;
$slc_category = $cate;
$title = "$slc_category empleos en $slc_country";
$stmt->execute();
$result = $stmt->fetchAll();?>

<div class="result-list-wrapper" id->
<?php
foreach($result as $row):
	$type = $row['type'];
	$compid = $row['company'];
	$stmtb = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$compid' and role = 'employer'");
	$stmtb->execute();
	$resultb = $stmtb->fetchAll();
	foreach($resultb as $rowb){
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
			<center>
				<img class="autofit3" alt="image"  src="images/blank.png"/>
			</center>';
<?php
	else: ?>
			<center>
				<img class="autofit3" alt="image" title="<?= $thecompname ?>" width="180" height="100" src="app/image-profiles.php?id=<?=$member_no?>"/>
			</center>
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
						<p class="texing character_limit">
							<?=$row['description']?>
						</p>
						<span class="stars-outer" data-rating="5">
	              			<span class="stars-inner" style="width: 50%;"></span>
	            		</span>
	            		<span>(5 Reviews)</span>
					</div>
					<div class="col-sm-5 col-md-4">
						<div class="social meta-list" style="padding-bottom: 1em; ">
<?php
	$url = urldecode(($isHttps?'https://':'http://' ).$actual_link.'/explore-job.php?jobid='.$row['job_id']);?>
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
endforeach;?>
</div>
