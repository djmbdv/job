<?php
require_once 'constants/connection.php';
require_once 'constants/settings.php'; 
require_once 'constants/check-login.php';

global $conn;
if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*16)-16;
}					
}else{
$page1 = 0;
$page = 1;	
}
require 'headerPrincipal.php';
?>

  <style>
  
    .autofit2 {
	height:100px;
	width:100px;
    object-fit:cover; 
  }
  
  </style>

<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="./">Inicio</a></li>
						<li><span>Empresas</span></li>
					</ol>
					
				</div>
			</div>
			<div class="section sm">
				<div class="container">
					<div class="sorting-wrappper alt">
						<div class="GridLex-grid-middle">
							<div class="GridLex-col-3_sm-12_xs-12">
								<div class="sorting-header">
									<h3 class="sorting-title">Employers</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="company-grid-wrapper top-company-2-wrapper">
						<div class="GridLex-gap-30">						
							<div class="GridLex-grid-noGutter-equalHeight">
<?php

	
                            $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employer' ORDER BY first_name LIMIT $page1,16");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach($result as $row):
		                    	$complogo = $row['avatar'];
							?>
							<div class="GridLex-col-3_sm-4_xs-6_xss-12">
								
							<div class="top-company-2">
							<a target="_blank" href="company.php?ref=<?php echo $row['member_no']; ?>">
										
							<div class="image">
							<?php 
							if ($complogo == null) {
							print '<center><img class="autofit2" alt="image"  src="images/blank.png"/></center>';
							}else{
							echo '<center><img class="autofit2" alt="image"  src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
							}
							?>
		
							</div>
											
							<div class="content">
							<h5 class="heading text-primary font700"><?=$row['first_name']?></h5>
							<p class="texting font600"><?=$row['title']?><p>
							<p class="mata-p clearfix"><span class="text-primary font700">25</span> <span class="font13">Publicaciones</span> <span class="pull-right icon"><i class="fa fa-long-arrow-right"></i></span></p>
							</div>
										
							</a>
										
							</div>
									
							</div>
							<?php
	
	                        endforeach; ?>
							</div>
						</div>
					</div>
					
								<div class="pager-wrapper">
								
						        <ul class="pager-list">
							<?php

	
                            $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employer' ORDER BY first_name");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $total_records = $stmt->rowCount();
	                        ?>
							 
								<?php
								$records = $total_records/16;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="employers.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="employers.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="employers.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						        </ul>	
					
					            </div>
				</div>
			</div>
			<?php include_once "footer.php"; ?>
		</div>


	</div>

<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
</body>


</html>