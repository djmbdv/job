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
                <a href="profile.html" class="checkbox-block">
                	<label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                </a>
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