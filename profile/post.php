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
						<li><span>Publicar <?=$producto?"Producto":"Servicio" ?> </span></li>
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
								
								<h2 class="heading mb-15"><h4><?= "$compname"?></h4>
								<hr>

								<p class="location"><i class="fa fa-map-marker"></i> <?= "$zip"; ?> <?php echo "$city"; ?>. <?php echo "$street"; ?>, <?= "$country"; ?> <span class="block"> <i class="fa fa-phone"></i> <?php echo "$myphone"; ?> </span></p>
								<hr>
								<ul class="meta-list clearfix">
									<li>
										<h4 class="heading">Website: </h4>
										<a target="_blank" href="//<?=$myweb?>"><?=$myweb?></a>
									</li>
									<hr>
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
											<?php include '../constants/check_reply.php'; ?>
												<div class="col-sm-8 col-md-8">
													<div class="form-group">
														<label>T&iacute;tulo del <?=$producto?"Producto":"Servicio"?></label>
														<input name="title" required type="text" class="form-control" placeholder="Escriba un nombre">
													</div>
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Municipio</label>
														<input name="city" required type="text" class="form-control" placeholder="Escriba el municipio">
													</div>

													<div class="form-group">
														<label>Telefono para este <?=$producto?"Producto":"Servicio"?></label>
														<input name="telefono" required type="tel" class="form-control" placeholder="Escriba su numero de telefono">
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
													<div class="form-group autocomplete">
														<label>Categor&iacute;a del <?=$producto?"Producto":"Servicio"?></label>
														<input name="category" id="category-input" required class="form-control" data-live-search="true" placeholder="Escribe una categoria">
													</div>
													<div>
														<p style="color:red">Si no encuentras tu categoria, presiona el boton</p>
														<a class="btn btn-sm btn-warning"  data-toggle="modal" data-target=".bd-example-modal-lg" href="">
														agregar mi categor&iacute;a</a>
													</div>
												</div>
												<div class="clear"></div>
												<div class="col-sm-4 col-md-4">
												</div>
												<div class="clear"></div>
												<div class="clear"></div>
												<div class="col-sm-12 col-md-12">
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Describa el <?=$producto?"Producto":"Servicio"?></label>
														<textarea class="form-control bootstrap3-wysihtml" name="description" required placeholder="Escriba una descripcion" style="height: 100px;"></textarea>
													</div>
												</div>
												
<?php
	if($producto): ?>
												<div class="clear"></div>
												<div class="col-md-4">
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Precio del Producto</label>
														<input class="form-control" name="precio" type="number" required placeholder="Ingrese precio" required="" />
													</div>
												</div>
<?php endif;?>
												<div class="clear"></div>
												<div class="form-group group-file">
											        <label>Ingrese imagenes del <?=$producto?"Producto":"Servicio"?>:</label>
											        <div class="card text-center" id="file-zone">
											        <span style="padding-top:auto;">+</span>	
											        </div>
											        
											    </div>
												<div class="clear mb-10"></div>
												<div class="clear mb-15"></div>
												<div class="clear"></div>
												<?=$producto?'<input type="hidden" name="producto" value="1"/>':''?>
												<div class="col-sm-6 mt-30">
													<button type="submit"  onclick = "validate(this)" class="btn btn-primary btn-lg">Publicar <?=$producto?"Producto":"Servicio"?></button>
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
			<div>					
			<?php include_once "../footer.php"; ?>
		</div>
<div id="back-to-top">
   <a href="#"><i class="fa fa-arrow-up"></i></a>
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


function cambiarfondo(){
	var fondo =document.getElementById('fondito');
	console.log(fondo);
	fondo.style.backgroundImage = 'url(images/background-index.jpg)';
}
function cambiarfondo2(){
	var fondo =document.getElementById('fondito');
	console.log(fondo);
	fondo.style.backgroundImage = 'url(images/fondo-productos.jpg)';
}
function cambiarfondo3(){
	var fondo =document.getElementById('fondito');
	console.log(fondo);
	fondo.style.backgroundImage = 'url(images/fondo-empresas.jpg)';
}
function autocomplete(inp) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      cola = document.createElement("div");
      t = document.createElement("h6");
      t.setAttribute("class","list-item-title");
      cola.appendChild(t);
      cola.setAttribute("class", "col-md-12 col-xs-12");
      t = document.createElement("h6");
      t.setAttribute("class","list-item-title");
      a.appendChild(cola);
      var rval = RegExp(val,'i');
      $.get("<?=$prefix?>app/search-category.php",{s : val,len:val.length}).done(data=>{      	
      		if(data.len != document.getElementById("category-input").value.length)return;
      		data.categories.forEach(servicio=>{
      			b = document.createElement("DIV");
      			b.classList.add("text-center");
      				b.innerHTML = servicio.substr(0,servicio.search(rval));
		          b.innerHTML += "<strong>" +val+ "</strong>";
		          b.innerHTML += servicio.substr(servicio.search(rval)+val.length);
		          b.innerHTML += "<input type='hidden' value='" + servicio + "'>";
		        b.addEventListener("click", function(e) {
		              inp.value = this.getElementsByTagName("input")[0].value;
		              closeAllLists();
		          });
		          cola.appendChild(b);
      		});
      });
      flecha = document.createElement("div");
      flecha.setAttribute("class","suggarrow");
      a.appendChild(flecha);
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}
autocomplete(document.getElementById("category-input"));
</script>
</body>




<!-- Large modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="text-align: center;">
  
<?php 

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = 'SELECT * from tbl_categories';

if (mysqli_query($conn, $sql)) {
	echo "conectado satisfactoriamente";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} ?>
  <div class="modal-dialog modal-sm" style="text-align: center;">
   <h3>Agregar nueva categoia</h3>
	<form action="post.php" method="POST">
	 <input type="text" required name="categoria" value="" placeholder="Escriba su categoria" aria-label="Example text with button addon" aria-describedby="button-addon1">
   </div> 
	
   <button class="btn btn-warning" type="submit" name="agregar"> agregar categoria</button>  </div>
  
	
	
	</form>
	<script>
<?php 
            if(isset($_POST['agregar'])){
                
                $nuevaCategoria = $_POST['categoria'];

            $insertar = "INSERT INTO tbl_categories (category) VALUES ('$nuevaCategoria')";
            $ejecutar = mysqli_query($conn,$insertar);

                if($ejecutar){
                    echo "<h3> insertado correctamente</h3>";
                }

                if($ejecutar){
                    echo"<script> alert('datos agregados')</script>";
                    echo"<script>window.open('post.php','_self')</script>";
                  }

            }
        
            ?>
</script>
   
   </div>
	

    </div>
  </div>
</div>
</html>