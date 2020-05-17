<?php 
require_once 'constants/connection.php';
global $conn;

include 'headerPrincipal.php'; 
?>
<style>
	.autofit2 {
		height:70px;
		width:400px;
		object-fit:cover; 
	}
	.autofit3 {
		height:80px;
		width:100px;
		object-fit:cover; 
	}
</style>
<body class="home">
	<div id="introLoader" class="introLoading"></div>
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="hero" style="background-image:url('images/wallpaperflare.com_wallpaper.jpg');">
				<div class="container">
				<p><br><br><br></p>
				<p style="color:#d4bb03" >
				Busque con confianza en el directorio profesional mas actualizado de la web
				</p>
					<div class="main-search-form-wrapper">
						<form action="job-list.php" method="GET" autocomplete="on">
							<div class="form-holder">
								<div class="row gap-0">
									<div  class="col-xss-6 col-xs-6 col-sm-6">
										<select class="form-control" name="category" required/>
										<option   value="">- Selecciona categoria -</option>
										<?php
										 try {
                                         $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
                                         $stmt->execute();
                                         $result = $stmt->fetchAll();
                                         foreach($result as $row):?>
										<option style="color:black" value="<?= $row['category']; ?>">
											<?=$row['category']; ?></option>
										<?php
	                                     endforeach;
					  
	                                     }catch(PDOException $e){
	                                     	print_r($e);
                                         }
										?>			   
										</select>
									</div>
									<div class="col-xss-6 col-xs-6 col-sm-6">
										<select class="form-control"  name="country" required/>
										<option value="">- Selecciona ciudad -<option>
										<?php
										try{
	                                        $stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
	                                        $stmt->execute();
	                                        $result = $stmt->fetchAll();
                                        	foreach($result as $row): ?>
										<option style="color:black" value="<?= $row['country_name']; ?>">
											<?=$row['country_name']; ?>
										</option>
										<?php
	                                     	endforeach;
					  
	                                    }catch(PDOException $e){
	                                    	print_r($e);
										}
										?>
										</select>
									</div>
								</div>
							</div>
							<div class="btn-holder">
								<button name="search" value="✓" type="submit" class="btn">
									<i class="ion-android-search"></i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="post-hero bg-light">
				<div class="container">
					<div class="process-item-wrapper mt-20">
						<div class="row">
							<div class="col-sm-4">
								<div class="process-item clearfix">
									<div class="icon">
										<i class="flaticon-line-icon-set-magnification-lens"></i>
									</div>
									<div class="content">
										<h5>01 / Busca un servicio</h5>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="process-item clearfix">
									<div class="icon">
										<i class="flaticon-line-icon-set-pencil"></i>
									</div>
									<div class="content">
										<h5>02 / Llama</h5>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="process-item clearfix">
									<div class="icon">
										<i class="flaticon-line-icon-set-calendar"></i>
									</div>
									<div class="content">
										<h5>03 /Contrata</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="bg-light pt-80 pb-80">
				<div class="container">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
							<div class="section-title">
								<h2>Servicios Recientes</h2>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-12">
						
							<div class="recent-job-wrapper alt-stripe mr-0">
						<?php
							try {
                            $stmt = $conn->prepare("SELECT * FROM tbl_jobs ORDER BY enc_id DESC LIMIT 8");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach($result as $row):
								$jobcity = $row['city'];
								$jobcountry = $row['country'];
								$type = $row['type'];
								$title = $row['title'];
								$closingdate = $row['closing_date'];
								$company_id = $row['company'];
								$telefono = $row['telefono'];
								$stmtb = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$company_id' and role = 'employer'");
	                            $stmtb->execute();
	                            $resultb = $stmtb->fetchAll();
								foreach($resultb as $rowb) {
									$complogo = $rowb['avatar'];
									$thecompname = $rowb['first_name'];	
									
								}
							
								if ($type == "Freelance") {
								$sta = '<div class="job-label label label-success">
										Freelance
										</div>';
								}
								if ($type == "Part-time") {
								$sta = '<div class="job-label label label-danger">
										Part-time
										</div>';
												  
								}
								if ($type == "Full-time") {
								$sta = '<div class="job-label label label-warning">
										Full-time
										</div>';
												  
								}
							?>
							<a class="recent-job-item clearfix" target="_blank" href="explore-job.php?jobid=<?php echo $row['job_id']; ?>">
								<div class="GridLex-grid-middle">
									<div class="GridLex-col-5_xs-12">
										<div class="job-position">
											<div class="image">
								<?php 
								if ($complogo == null) {
									print '<center><img alt="image"  src="images/blank.png"/></center>';
								}else{
									echo '<center><img alt="image" title="'.$thecompname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
								}
								?>
											</div>
											<div class="content">
												<h4><?php echo "$title"; ?></h4>
												<p><?php echo "$thecompname"; ?></p>
											</div>
										</div>
									</div>
									<div class="GridLex-col-5_xs-8_xss-12 mt-10-xss">
										<div class="job-location">
											<i class="fa fa-map-marker text-primary"></i>
											<?= "$jobcountry" ?></strong> - <?= "$jobcity" ?>
										</div>
									</div>
									<div class="GridLex-col-2_xs-4_xss-12">
										<?= "$sta"; ?>
										<span class="font12 block spacing1 font400 text-center">Apto - <?php echo "$telefono"; ?></span>
									</div>
								</div>
							</a>
						<?php
                            endforeach;
	                        }catch(PDOException $e){ 
                   				print_r($e);
                            }
                             ?>
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