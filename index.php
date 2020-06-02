<?php 
require_once 'constants/connection.php';
include 'headerPrincipal.php';

global $conn;
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
			<div class="hero" style="background-image:url('https://i.ytimg.com/vi/OiyHs4rQh8s/maxresdefault.jpg');background-size: cover;">
				<div class="container">
					<h1 class=" text-center text-shadow" style="text-shadow: 3px black;color: whitesmoke;">Aqui<b>Online</b>
					</h1>
					
					<h6 class="text-center text-primary">Encuentra lo que buscas en una sola p&aacute;gina</h6>
					
					<div class="main-search-form-wrapper">
						<form action="job-list.php" method="GET" autocomplete="on">
							<div class="form-holder">
								<div class="row gap-0  ">
									<div  class="autocomplete col-xss-6 col-xs-6 col-sm-6">
										<small class="text-white">Qu&eacute;</small>
										<input class="form-control" name="category" id="category-input" placeholder="Producto, Empresa, Servicio..."  name="">
									</div>
									<div class="col-xss-6 col-xs-6 col-sm-6">
										<small class="text-white">D&oacute;nde</small>
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
			<?php require 'footer.php';?>
		</div> 
	</div>
<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
<style type="text/css">
.autocomplete {
  position: relative;
  display: inline-block;
}

.autocomplete-items {
  position: absolute;
  border: 2px solid black;
  z-index: 99;
  margin-top: 2px;
  background: white;
  top: 100%;
  left: 0;
  right: 0;
  padding-bottom: 1em;
}
.autocomplete-items {
  padding: 10px;
  background-color: #fff;
}

.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
  cursor: pointer;
}
</style>
<script type="text/javascript">
	function autocomplete(inp, arr) {
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      cola = document.createElement("div");
      t = document.createElement("h6");
      t.setAttribute("class","list-item-title");
      t.innerHTML = "Servicios";
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
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          cola.appendChild(b);
        }
      }

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
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
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
var categories = (
<?php
	 $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
	 $stmt->execute();
	 $result = $stmt->fetchAll();
	 echo  json_encode( $result); ?>).map(x => x.category);

autocomplete(document.getElementById("category-input"), categories);

</script>
</body>
</html>