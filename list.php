<?php 
require_once 'constants/settings.php';
require_once 'constants/connection.php';
require_once 'constants/check-login.php';

global $conn;
global $actual_link;
global $isHttps;


require 'headerPrincipal.php';
$slc_country =urldecode(isset($_GET['country'])?$_GET['country']:"");
?>
<div class="modal fade" id="modal-galery" role="dialog">
    
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
  </div>



<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="second-search-result-wrapper">
				<div class="container">
					<form action="list.php" method="GET" autocomplete="off">
						<div class="second-search-result-inner">
							<span class="labeling">Buscar</span>
							<div class="row">
								<div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
									<div class="form-group form-lg autocomplete">
										<input class="form-control" name="category" id="category-input" placeholder="Producto, Empresa, Servicio..."  name="">
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
										<option <?php if ($slc_country == "$cnt") { print ' selected '; } ?> value="<?= $row['country_name']; ?>"><?= $row['country_name']?></option>
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
								<div id="job-list" page="1" max-count="" <?= isset($_GET['category'])?"category='".$_GET['category']."'":""  ?>  <?= isset($_GET['country'])?"country='".$_GET['country']."'":""  ?> >
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
	function tel(){
			$(".only-logged").click(e=>{
	        e.preventDefault();
	        window.location.href = "<?=$prefix?>login.php";
    	});
	}
	$(document).ready((e)=>{
		$.get("job-list.php",{
			page: 1,
			category:$("#job-list").attr("category"),
			country:$("#job-list").attr("coutry")
		}).done((data)=>{
		//	alert(data);
			$("#job-list").html(data);
			$(".num-page").text($("#job-list").attr("page"));
			tel();
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
			tel();
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
			tel();
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
			tel();
		});
	});
	function autocomplete(inp) {
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
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
      cola.setAttribute("class", "col-md-6");
      colb = document.createElement("div");
      colb.setAttribute("class", "col-md-6");
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
				/*insert a input field that will hold the current array item's value:*/
				b.innerHTML += "<input type='hidden' value='" +  empresa + "'>";
				/*execute a function when someone clicks on the item value (DIV element):*/
				  b.addEventListener("click", function(e) {
				  /*insert the value for the autocomplete text field:*/
				  inp.value = this.getElementsByTagName("input")[0].value;
				  /*close the list of autocompleted values,
				  (or any other open lists of autocompleted values:*/
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
		          /*insert a input field that will hold the current array item's value:*/
		          b.innerHTML += "<input type='hidden' value='" + servicio + "'>";
		          /*execute a function when someone clicks on the item value (DIV element):*/
		        b.addEventListener("click", function(e) {
		              /*insert the value for the autocomplete text field:*/
		              inp.value = this.getElementsByTagName("input")[0].value;
		              /*close the list of autocompleted values,
		              (or any other open lists of autocompleted values:*/
		              closeAllLists();
		          });
		          cola.appendChild(b);
      		});
      });

      flecha = document.createElement("div");
      flecha.setAttribute("class","suggarrow");
      a.appendChild(flecha);
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed*/
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
</html>
<?php ob_flush();
