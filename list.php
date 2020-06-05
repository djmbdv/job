<?php 
require_once 'constants/settings.php';
require_once 'constants/connection.php';
require_once 'constants/check-login.php';

global $conn;
global $actual_link;
global $isHttps;


require 'headerPrincipal.php';
?>
<body class="not-transparent-header">
	<div class="container-wrapper" style="padding-top: 8em;">
		<div class="main-wrapper">
			<div class="second-search-result-wrapper">
				<div class="container">
					<form action="list.php" method="GET" autocomplete="off">
						<div class="second-search-result-inner">
							<span class="labeling">Buscar</span>
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
										<option <?php if ($slc_country == "$cnt") { print ' selected '; } ?> value="<?=$row['country_name']?>"><?= $row['country_name']?></option>
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
						<li><span>Lista</span></li>
					</ol>
				</div>
			</div>
			<div class="section sm">
				<div class="container">
					<div class="result-wrapper">
						<div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9 mt-25">
								<div id="job-list" page="1" <?= isset($_GET['category'])?"category='".$_GET['category']."'":""  ?>  <?= isset($_GET['country'])?"country='".$_GET['country']."'":""  ?> >
								</div>
								<div class="pager-wrapper">		
									<ul class="pager-list">
										<li class="paging-nav paging-nav-start">
											<a href="#"><i class="fa fa-angle-double-left"></i></a>
										</li>
										<li class="paging-nav paging-nav-prev">
											<a href="#"><i class="fa fa-angle-left"></i></a>
										</li>
										<li>
											<span class="num-page"></span>
										</li>
										<li class="paging-nav paging-nav-next">
											<a href="#"><i class="fa fa-angle-right"></i></a>
										</li>
										<li class="paging-nav paging-nav-last">
											<a href="#"><i class="fa fa-angle-double-right"></i></a>
										</li>
									</ul>							
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include_once 'footer.php';?>
		</div>
	</div> 
<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
<script type="text/javascript">
	$(document).ready((e)=>{
		$.get("job-list.php",{
			page: 1,
			category:$("#job-list").attr("category"),
			country:$("#job-list").attr("coutry")
		}).done((data)=>{
		//	alert(data);
			$("#job-list").html(data);
			$(".num-page").text($("#job-list").attr("page"));
		})
	});
	$("paging-nav").click(e=>{
		$("#job-list").html("<p>loading</p>");
	});
	$(".paging-nav-start > a").click((e)=>{
		e.preventDefault();
		$.get("job-list.php",{
			page: 1,
			category:$("#job-list").attr("category"),
			country:$("#job-list").attr("coutry")
		}).done((data)=>{
			$("#job-list").html(data);
			$("#job-list").attr("page",1);
			$(".num-page").text($("#job-list").attr("page"));
		})
	});
	$(".paging-nav-prev > a").click((e)=>{
		e.preventDefault();
		$.get("job-list.php",{
			page: parseInt($("#job-list").attr("page"))-1,
			category:$("#job-list").attr("category"),
			country:$("#job-list").attr("coutry")
		}).done((data)=>{
			$("#job-list").html(data);
			$("#job-list").attr("page",parseInt($("#job-list").attr("page"))-1);
			$(".num-page").text($("#job-list").attr("page"));
		});
	});
	$(".paging-nav-next > a").click((e)=>{
		e.preventDefault();
		$.get("job-list.php",{
			page: parseInt($("#job-list").attr("page"))+1,
			category:$("#job-list").attr("category"),
			country:$("#job-list").attr("coutry")
		}).done((data)=>{
			$("#job-list").html(data);
			$("#job-list").attr("page",parseInt($("#job-list").attr("page"))+1);
			$(".num-page").text($("#job-list").attr("page"));
		});
	});
</script>
</body>
</html>
<?php ob_flush();