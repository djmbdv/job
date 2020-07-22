<?php 
require_once 'constants/connection.php';
include 'headerPrincipal.php';
 
global $conn;

$x = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT COUNT(*) total FROM tbl_users";
$result = mysqli_query($x, $sql);
$fila = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) total FROM tbl_jobs";
$result = mysqli_query($x, $sql);
$fila_servicios = mysqli_fetch_assoc($result);



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
@media (max-width:  600px) {
	.autocomplete-items{
		width: 100% !important;
	}
}
</style>

<body class="home" id="home" style="padding-top: 0;">


	<div id="introLoader" class="introLoading"></div>
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="hero" id="fondito" style="background-image:url('images/background-index.jpg');background-size: cover;">
				
			
				
			
				<div class="container">

				<div class="row ">
						<div class="col-xss-11 col-xs-11 col-sm-4">
						<div> <p> <b  class="counter">0 + </b> </p> 
								<p>Clientes</p>

						</div>
						</div>

						<div class="col-xss-11 col-xs-11 col-sm-4">
						<div >
						<p> <b class="counter1">0 +</b> </p> 
								<p>Servicios</p>
						</div>
						</div>

						<div class="col-xss-11 col-xs-11 col-sm-4">
						<div class="counter2">
						<p> <b>100+</b> </p> 
								<p>Busquedas</p>
						</div>
						</div>
					</div>

				</div>
				







				<div class="container">
					
						
					<h2 class=" text-center text-shadow" style="text-shadow: 3px black;color: whitesmoke;"> <b> <p > Encuentra lo que necesitas en un click</p></b>
					</h1>
					<div class="main-search-form-wrapper" class="text-center">
						<form action="list.php" method="GET" autocomplete="off">
							<div class="form-holder">
								<div class="row gap-0">
									<div  class="autocomplete col-xss-11 col-xs-11 col-sm-5">
										<small style="font-size:24px" class="text-white">Qu&eacute; Buscas?</small>
										<input style="font-size:17px" class="form-control" style="display: inline-block;" name="category" id="category-input" placeholder="Producto, Empresa, Servicio..."  name="">
									</div>
									<div class="col-xss-11 col-xs-11 col-sm-5">
										<small  style="font-size:24px" class="text-white">D&oacute;nde lo necesitas?</small>
										<select style="font-size:17px"  class="form-control"  name="country"/>
											<option value="">- Selecciona ciudad -<option>
<?php
    $stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
    $stmt->execute();
    $result = $stmt->fetchAll();
	foreach($result as $row): ?>
											<option style="color:black" value="<?= $row['country_name']; ?>">
												<?=$row['country_name']; ?>
											</option>
<?php
 	endforeach;
 ?>
                    					</select>
									</div>
				                    <div class="col-lg-2 col-md-2 col-xs-11" style="margin-top:30px;"  >
					                    <button type="submit"  class="btn button--medium  btn-primary"  style="margin-left: 40px;"  >
							              <i class="fa fa-search"></i> Buscar
					            		</button>  
				                    </div>
								</div>
							</div>
						</form>
					</div>
					<div>


						<br>
						<div class="locations-container t-center">
					        <ul class="min-list inline-list locations locations--layout-1">
					        	<li class="location">
						            <a href="register.php" class="c-white"><i class="fa fa-book" style="font-size:30px"></i><b  style="font-size:20px">Crea tu servicios ahora</b></a>
								</li>
								<li class="location">
									<a href="register.php" class="c-white"><i class="fa fa-user" style="font-size:30px"></i><b  style="font-size:20px">Publica tus servicios</b></a>
								</li>
	         
					        </ul>
					    </div>
					</div>
				</div>
			</div>
			<section id="cubos" class="container">
				<div class="row" >
	                <div class="col col-md-4 col-xs-12  container" style="text-align: -webkit-center;">
	                    <a href="#home"  onclick="cambiarfondo3();">  <img class="loguito"   src="images/empresas.png?2"></a> 
	                    <br>
	                    <p style="font-size:25px">Empresas</p>
	                    <br>
	                </div>
	                <div class="col col-md-4 col-xs-12  container" style="text-align: -webkit-center;">
	                    <a href="#home" onclick="cambiarfondo();"> <img  class="loguito"  src="images/servicios.png?2"/></a>
	                    <br>
	                    <p style="font-size:25px"> Servicios   </p>
						<br>
	                </div>
					<div class="col col-md-4 col-xs-12 container" style="text-align: -webkit-center;">
						<a href="#home" onclick="cambiarfondo2();">    <img class="loguito"  src="images/productos.png?2" alt="" >  </a>
						<br>
						<p style="font-size:25px">Productos</p>
					</div>
				</div>
	        </section>
			<section class="" id="franja"  style="background-color:#26272a;">
				<div class="text-center">
					<p id="blog-texto" style="color:white; font-size:20px"> Blog</p>
	            </div>
	        </section>
	        <section id="blog" class="container">
	<?php 
	 $url = "https://aquionline.co/blog/wp-json/wp/v2/posts"; $ch = curl_init();  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);?>
				<div class="row" >
					<div class="col col-md-4" style="text-align: -webkit-center;">
						<img class="thumbnail" src="images/a.jpg" alt="">
						<br> 
						<?php  print_r($post[0]["excerpt"]["rendered"]);?>
					</div>
					<div class="col col-md-4" style="text-align: -webkit-center;">
					</div>
					<div class="col col-md-4" style="text-align: -webkit-center;">
						<img class="thumbnail" src="images/b.jpg" alt="">
						<br> 
						<?php  print_r($post[1]["excerpt"]["rendered"]);?>
					</div>
				</div>
			</section>
		<?php require 'footer.php';?>
		</div> 
	</div>
	<div id="back-to-top">
	   <a href="#"><i class="fa fa-arrow-up"></i></a>
	</div>
<script type="text/javascript">
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
      t.innerHTML = "Servicios/Productos";
      cola.appendChild(t);
      cola.setAttribute("class", "col-md-6 col-xs-12");
      colb = document.createElement("div");
      colb.setAttribute("class", "col-md-6 col-xs-12");
      t = document.createElement("h6");
      t.setAttribute("class","list-item-title");
      t.innerHTML = "Empresas";
      colb.appendChild(t);
      a.appendChild(cola);
      a.appendChild(colb);
      var rval = RegExp(val,'i');
      $.get("app/search.php",{s : val,len:val.length}).done(data=>{      	
      		if(data.len != document.getElementById("category-input").value.length)return;
      		data.empresas.forEach(empresa => {
	      		b = document.createElement("DIV");
	      		b.classList.add("text-center");
	      		b.innerHTML = empresa.substr(0, empresa.search(rval));
				b.innerHTML += "<strong>" + val + "</strong>";
				b.innerHTML += empresa.substr(empresa.search(rval) + val.length);
				b.innerHTML += "<input type='hidden' value='" +  empresa + "'>";
				  b.addEventListener("click", function(e) {
				  inp.value = this.getElementsByTagName("input")[0].value;
				  closeAllLists();
				});
				colb.appendChild(b);
      		});
      		data.servicios.forEach(servicio=>{
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


				
<script>
//FUNCION CONTADOR
			function count(){
  var counter = { var: 0 };
  TweenMax.to(counter, 3, {
    var: <?php echo $fila['total']?>, 
    onUpdate: function () {
      var number = Math.ceil(counter.var);
      $('.counter').html(number);
      if(number === counter.var){ count.kill(); }
	  

    },
    onComplete: function(){
      count();
    },    
    ease:Circ.easeOut
  });
}

count();
				</script>	

<script>
			function count(){
  var counter = { var: 0 };
  TweenMax.to(counter, 3, {
    var: <?php echo $fila_servicios['total']?>, 
    onUpdate: function () {
      var number = Math.ceil(counter.var);
      $('.counter1').html(number);
      if(number === counter.var){ count.kill(); }
	  

    },
    onComplete: function(){
      count();
    },    
    ease:Circ.easeOut
  });
}

count();
				</script>	
</body>
</html>
<?php ob_flush();
