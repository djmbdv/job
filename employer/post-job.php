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

										<form class="post-form-wrapper" action="app/post-job.php" method="POST" autocomplete="off" enctype="multipart/form-data">
								
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

	foreach($result as $row):?>
															<option <?php if ($country == $row['country_name']) { print ' selected '; } ?> value="<?=$row['country_name']?>"><?=$row['country_name']?></option>
<?php
	endforeach;
}catch(PDOException $e){}?>
														</select>
													</div>
													<div class="form-group">
														<label>Categoria del servicio</label>
														<select name="category" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Seleccionar</option>
<?php
try{
   $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
   $stmt->execute();
   $result = $stmt->fetchAll();

   foreach($result as $row):?>
															<option value="<?=$row['category']?>"><?=$row['category']?></option>
<?php
	endforeach;
}catch(PDOException $e){}?>

														</select>
													</div>
												</div>
												<div class="clear"></div>
												<div class="col-sm-4 col-md-4">
												</div>
												<div class="clear"></div>
												<div class="clear"></div>
												<div class="col-sm-12 col-md-12">
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Describa el servicio</label>
														<textarea class="form-control bootstrap3-wysihtml" name="description" required placeholder="Escriba una descripcion" style="height: 100px;"></textarea>
													</div>
												</div>
												<div class="clear"></div>
												<div class="clear"></div>
												
												<div class="form-group group-file">
											        <label>Ingrese imagenes del servicio:</label>
											        <div class="card text-center" id="file-zone">
											        <span style="padding-top:auto;">+</span>	
											        </div>
											        
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
<style type="text/css">
#file-zone{
	border:dashed 0.25rem #e9ab28;
	color:black;
	padding: 1em;
	cursor: pointer;
	font-size: 25px;
	color: #e9ab28;
	width: 3em;
	display:inline-block;
	vertical-align: top;
	margin-right: 2px;
	height: 100px;
}
.input-zone{
	display: none !important;
}
.input-image{
	border:dashed 0.25rem #e9ab28;
	padding: 0.25rem;
	
	color: orange;
	min-width: 3em;
	
	background:#E6E6E6;
	max-height: 100px;
	vertical-align: top;
	

}
.group-file{
	width: 100%;
}
.close-span{
	float:right;
	right: 14px;
	top:-90px;
	position: relative;
	color:#e9ab28;
	font-weight:bolder;
	z-index: 100;
	cursor: pointer;
}
.close-span:hover{
	color:#337ab7
}
.container-image-upload{
	display: inline-block;
	margin-right: 2px;
}
</style>


<script type="text/javascript">

$("#file-zone").click(e=>{

	if($(e.srcElement).parents(".group-file").children("input").length >= 4)return;
	var container = $("<div></div>").addClass("container-image-upload");
	var deleteSpam = $("<span></span>").text("X").addClass("close-span");
	var inputFile = $("<input></input>").attr("type","file").addClass("input-zone").addClass("hidden");
	var inputImage = $("<img></img>").addClass("input-image");
	inputFile.attr("name","images[]");
	var erro = false;
	inputFile.change(e=>{
		console.log(e);
		var archivo = e.target.files[0];
		inputImage.attr("src",URL.createObjectURL(e.target.files[0]));
		if(archivo.type.split('/')[0] !== "image"){
			container.remove();
			inputFile.remove();
			erro = true;
		}
	});
	if(erro)return;
	inputFile.click();
	$(e.srcElement).parents(".group-file").append(inputFile);
	deleteSpam.click(e=>{
		inputFile.remove();
		container.remove();
	});
	container.append(inputImage);
	container.append(deleteSpam);
	$(e.srcElement).parents(".group-file").append(container);

});
$("input").change(e=>{
	//$(e.srcElement)
});
</script>
</body>

</html>