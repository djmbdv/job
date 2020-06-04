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
						<li><span>Lista</span></li>
					</ol>
				</div>
			</div>

			
			<div class="section sm">
				<div class="container">

					<div class="result-wrapper">
						<div class="row">						
							<?php include_once 'job-list.php';?>
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