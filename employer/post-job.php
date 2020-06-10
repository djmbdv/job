<?php

require_once '../constants/settings.php';
require_once '../constants/connection.php';
require_once '../constants/check-login.php';

if (!$user_online ||  !$myrole == "employer") header("location:../");
global $conn;
$deep_url = 1;
include_once "../headerPrincipal.php";
$producto = false;
if(isset($_GET["p"]))$producto = true;
?>
<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">
				<div class="container">
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Inicio</a></li>
						<li><a ><?=$compname?></a></li>
						<li><span>Publicar Servicio</span></li>
					</ol>
				</div>
			</div>
			<div class="section sm">
				<div class="container">
					<div class="row">
						<div class="col-sm-5 col-md-3">
						
							<div class="company-detail-sidebar">
								
								<div class="image">
									<?php 
									if ($logo == null) {
									print '<center>Company Logo Here</center>';
									}else{
									echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
									}
									?>
								</div>
								
								<h2 class="heading mb-15"><h4><?php echo "$compname"; ?></h4>
							
								<p class="location"><i class="fa fa-map-marker"></i> <?php echo "$zip"; ?> <?php echo "$city"; ?>. <?php echo "$street"; ?>, <?php echo "$country"; ?> <span class="block"> <i class="fa fa-phone"></i> <?php echo "$myphone"; ?></span></p>
								
								<ul class="meta-list clearfix">

									<li>
										<h4 class="heading">Website: </h4>
										<a target="_blank" href="//<?=$myweb?>"><?=$myweb?></a>
									</li>
									<li>
										<h4 class="heading">Email: </h4>
										<?=$mymail?>
									</li>

								</ul>
								
								
								<a href="./" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5" ></i> Editar</a>
									
								</div>
					
					
							</div>
							
							<div class="col-sm-7 col-md-8">
							
								<div class="company-detail-wrapper">

									<div class="company-detail-company-overview  mt-0 clearfix">
										
										<div class="section-title-02">
											<h3 class="text-left">Publicar Nuevo <?=$producto?"Producto":"Servicio"?></h3>
										</div>

										<form class="post-form-wrapper" action="app/post-job.php" method="POST" autocomplete="off">
								
											<div class="row gap-20">
											<?php include 'constants/check_reply.php'; ?>
										
												<div class="col-sm-8 col-md-8">
												
													<div class="form-group">
														<label>T&iacute;tulo del servicio</label>
														<input name="title" required type="text" class="form-control" placeholder="Escriba un titulo">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>municipio</label>
														<input name="city" required type="text" class="form-control" placeholder="Escriba el municipio">
													</div>

													<div class="form-group">
														<label>Telefono para este servicio</label>
														<input name="telefono" required type="text" class="form-control" placeholder="Escriba su numero de telefono">
													</div>
													
													
												</div>
												
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Departamento</label>
														<select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Seleccionar</option>
						                                   <?php
														   try {
                                                         

	
                                                           $stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option <?php if ($country == $row['country_name']) { print ' selected '; } ?> value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
													</div>
													<div class="form-group">
														<label>Categoria del servicio</label>
															<select name="category" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Seleccionar</option>
						                                   <?php
														   try {
                                                           

	
                                                           $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
											
														
													</div>
													
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-4 col-md-4">
												
													
												</div>
												
												<div class="clear"></div>
												<!--
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>C&oacute;mo ofrece su servicio?</label>
														<select name="jobtype" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected>Seleccionar</option>
															<option value="Full-time" data-content="<span class='label label-warning'>Full-time</span>">Full-time</option>
															<option value="Part-time" data-content="<span class='label label-danger'>Part-time</span>">Part-time</option>
															<option value="Freelance" data-content="<span class='label label-success'>Freelance</span>">Freelance</option>
														</select>
													</div>
													
												</div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>Experiencia:</label>
														<select name="experience" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected >Seleccionar</option>
															<option value="2 Years">1 Año</option>
															<option value="2 Years">2 Años</option>
															<option value="3 Years">3 Años</option>
															<option value="4 Years">4 Años</option>
															<option value="5 Years">5 Años</option>
															<option value="Expert">Experto(+5 Años)</option>
														</select>
													</div>
												</div>
-->
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Describa el servicio</label>
														<textarea class="form-control bootstrap3-wysihtml" name="description" required placeholder="Escriba una descripcion" style="height: 100px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
											<!--	<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Activiades que puede realizar</label>
														<textarea name="responsiblities" required class="form-control bootstrap3-wysihtml5" placeholder="Acividades" style="height: 100px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
										<!--		<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Describa sus Habilidades</label>
														<textarea name="requirements" required class="form-control bootstrap3-wysihtml5" placeholder="escriba sus habilidades" style="height: 200px;"></textarea>
													</div>
													
												</div> -->
												
												<div class="clear"></div>
												<div class="form-group">
												iv>
											        <label>Upload Image File:</label>
											        <input name="userImage" id="userImage" type="file" class="demoInputBox" />
											    </div>
											    <div><input type="submit" id="btnSubmit" value="Submit" class="btnSubmit" /></div>
											    <div id="progress-div"><div id="progress-bar"></div></div>
											    <div id="targetLayer"></div>
													
												</div>
												
												<div class="clear mb-10"></div>

												
												<div class="clear mb-15"></div>

												
												<div class="clear"></div>
												
												<div class="col-sm-6 mt-30">
													<button type="submit"  onclick = "validate(this)" class="btn btn-primary btn-lg">Postear el servicio</button>
												</div>

											</div>
											
										</form>
										   
										
									</div>
								</div>
							</div>
						
						</div>
						
					</div>
				</div>
			</div>
			<?php include_once "../footer.php"; ?>
	</div>
<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
<script type="text/javascript">
$(document).ready(function() { 
    $('#uploadForm').submit(function(e) {	
        if($('#userImage').val()) {
            e.preventDefault();
            $('#loader-icon').show();
            $(this).ajaxSubmit({ 
                target:   '#targetLayer', 
                beforeSubmit: function() {
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){	
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },
                success:function (){
                    $('#loader-icon').hide();
                },
                resetForm: true 
            }); 
            return false; 
        }
    });
});
</script>
<script type="text/javascript" src="../js/fileinput.min.js"></script>
<script type="text/javascript" src="../js/customs-fileinput.js"></script>
<script type="text/javascript" src="../js/jquery.sheepItPlugin.js"></script>
<script type="text/javascript" src="../js/customs-sheepItPlugin.js"></script>

</body>

</html>