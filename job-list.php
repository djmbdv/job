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
$cate= '%'.$cate.'%';
$country ='%'.$country.'%';	
$query1 = isset($_GET['category']) ? "SELECT * FROM tbl_jobs join tbl_users on tbl_jobs.company = tbl_users.member_no WHERE category like :cate or tbl_jobs.title like :cate or tbl_users.first_name like :cate ": "SELECT * FROM tbl_jobs  ";
if(isset($_GET['country']))$query1.= "AND country like :country ";
$query2 = (string)$query1;
$query1.="ORDER BY enc_id DESC LIMIT $offset,12";


if(isset($_GET['count'])){
	$smtm2 = $conn->prepare($query2);
	$stmt2->bindParam(':cate', $cate);
	if(isset($_GET['country']))$stmt2->bindParam(':country', $country);
	$smtm2->execute();
	echo $smtm2->rowCount();
	die(); 
}

$stmt = $conn->prepare($query1);
$stmt->bindParam(':cate', $cate);
if(isset($_GET['country']))$stmt->bindParam(':country', $country);
$slc_country = $country;
$slc_category = $cate;
$title = "$slc_category en $slc_country";
$stmt->execute();
$result = $stmt->fetchAll();?>

<div class="result-list-wrapper">
<?php
foreach($result as $row):
	$jobid = $row['job_id'];
	$type = $row['type'];
	$compid = $row['company'];
	$stmtb = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$compid' and role = 'employer'");
	$stmtb->execute();
	$o = $stmtb->fetchObject();
	$complogo = $o->avatar;
	$thecompname = $o->first_name;
	$member_no =$o->member_no;
	$telefono = isset($o->telefono)? $o->telefono :"";
	$producto = $row['producto'];
?>
	<div class="job-item-list">
		<div class="image">
<?php 
	if ($complogo == null): ?>
			<center>
				<img class="autofit3" alt="image"  src="images/blank.png"/>
			</center>
<?php
	else: ?>
			<center>
				<!-- <img class="autofit3" alt="image" title="<?= $thecompname ?>" src="app/image-profiles.php?id=<?=$member_no?>"/> -->
				<img class="autofit3" alt="image" title="<?= $thecompname ?>" width="180" height="100" src="app/image-profiles.php?id=<?=$member_no?>"/>
			</center>
<?php
	endif;
	?>
		</div>

		<div class="content">
			<div class="job-item-list-info">
				<div class="row">
					<div class="col-sm-7 col-md-8">
						<h4 class="heading"><?=$row[1]?></h4>
						<div class="meta-div clearfix mb-25">
							<span>ofrecido por <a href="company.php?ref=<?=$compid?>">  <?= $thecompname ?> </a></span>
						</div>
						<p class="texing character_limit">
							<?=$row['description']?>
						</p>
<?php
	$stmt2 = $conn->prepare("select count(value) as num, avg(value) as prom from tbl_votes where job_id = :job_id");
	$stmt2->bindValue(":job_id",$jobid);
	$stmt2->execute();
	$votos = $stmt2->fetchObject();
	?>	
						<span class="stars-outer" data-rating="5">
	              			<span class="stars-inner" style="width: <?=(($votos->prom/5)*100)."%"?>;"></span>
	            		</span>
	            		<small>(<?=$votos->num ?> Votos)</small>
					</div>
					<div class="col-sm-5 col-md-4">
						<div class="social meta-list" style="padding-bottom: 1em; ">
<?php
	$local = LOCAL ? "/job" : "";
	$url = urldecode(($isHttps?'https://':'http://' ).$actual_link.$local.'/explore-job.php?jobid='.$row['job_id']);?>
							<a href="whatsapp://send?text=<?=$url?>" id="share-wa" class="sharer button">
								<i class="fa fa-2x fa-whatsapp"></i>
							</a>
							<a href="<?='https://www.facebook.com/sharer/sharer.php?u='.$url ?>" id="share-fb" class="sharer button"><i class="fa fa-2x fa-facebook-square"></i></a>

							<a href="https://instagram.com/AquiOnline" id="share-li" class="sharer button"><i class="fa fa-2x fa-instagram-square"></i></a>
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
								<span>Telefono: </span>
								<?= $user_online?   $row['telefono']: '<a class="only-logged" href="#">Ver tel&eacute;fono</a>' ?>
							</li>
<?php
	if($producto): ?>
							<li>
								<span>Precio: </span>
								 <?=$row['precio'] ?>
							</li>
<?php endif?>
						</ul>
					</div>										
				</div>
			</div>
			<div class="job-item-list-bottom">
				<div class="row">
					<div class="col-sm-7 col-md-8">
						<div class="sub-category col-xss-12 col-xs-12 col-sm-8">
							<a><?= $row['category'] ?></a>
						</div>
						<div class="thumbails-modal col-xss-12 col-xs-8 col-sm-6" >
<?php 
	$smtm3 = $conn->prepare("select * from tbl_image_service where service = :service");
	$smtm3->bindValue(":service", $row['job_id']);
	$smtm3->execute();
	foreach ($smtm3->fetchAll() as $thumb):
 ?>
						
							<div class="thumb">
								<img class="img img-responsive img-thumb" otro="<?=$thumb['path']?>" src="app/thumb.php?id=<?=$thumb['id']?>"/>
							</div>
<?php
	endforeach; ?>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-5 col-md-4">
						<a target="_blank" href="explore-job.php?jobid=<?= $row['job_id']; ?>" class="btn btn-primary">Ver este <?=$producto?"producto":"servicio" ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
endforeach;?>
</div>
<style>
	.thumbails {
	    right: 0;
	    display: inline-block;
	    position: absolute;
	}
	.thumbails::after {
	  content: "";

	  display: table;
	}

	.thumb{
	  float: right;
	  width: 24.2%;
	  padding: 1px;
	  background: none;
	  /*margin-top: auto;*/
	}
	.img-thumb{
		width: 100%;
	}
	.thumb:hover{
		border: 1px solid yellow;
		transition: all 0.3s ease;
	}
</style>
<script type="text/javascript">
	$(".thumb").click(e =>{
		console.log(e);
		console.log($(e.srcElement).attr("otro"));
	var image = $("<img>").attr("src",$(e.srcElement).attr("otro"));
	$("#modal-galery > .modal-content").children(".modal-body").html(image);
	$("#modal-galery").modal();
	});
</script>




