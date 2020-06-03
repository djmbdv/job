<?php
$stmt = $conn->prepare($query1);
if ($fromsearch == true) {
	$stmt->bindParam(':cate', $slc_category);
	$stmt->bindParam(':country', $slc_country);
}
$stmt->execute();
$result = $stmt->fetchAll();?>
<div class="col-sm-12 col-md-9 col-lg-9 mt-25">
	<div class="bg-dark">
		<h5 class="sorting-title "><?=$title?></h5>
	</div>
	<div class="result-list-wrapper">
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
<?php endforeach;

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
							<div class="pager-wrapper">
								
						<ul class="pager-list">
							<li class="paging-nav"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
							<li class="paging-nav"><a href="#"><i class="fa fa-angle-left"></i></a></li>