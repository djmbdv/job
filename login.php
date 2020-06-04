<?php 
include 'headerPrincipal.php'; 
?>
<script type="text/javascript">
function update(str){
	if(document.getElementById('mymail').value == ""){
		alert("Please Ingresa tu email");
	}else{
		document.getElementById("data").innerHTML = "Please wait...";
		var xmlhttp;
		if (window.XMLHttpRequest){
	        xmlhttp=new XMLHttpRequest();
		}
		else{
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}	

		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById("data").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","app/reset-pw.php?opt="+str, true);
		xmlhttp.send();
	}
}

function reset_text(){  
	document.getElementById('mymail').value = "";
	document.getElementById("data").innerHTML = "";
}
</script>
</head>
<body class="not-transparent-header">
	<div class="container-wrapper">
		<div class="main-wrapper">
			<div class="breadcrumb-wrapper">			
				<div class="container">				
					<ol class="breadcrumb-list">
						<li><a href="./">Inicio</a></li>
						<li><span>Login</span></li>
					</ol>					
				</div>				
			</div>
			<div class="login-container-wrapper">
				<div class="container">
					<div class="row">

						<div class="col-sm-4 col-sm-offset-4">
                        <?php
							include 'constants/check_reply.php';	
						?>
                            <form name="frm" action="app/auth.php" method="POST" autocomplete="off">
                            	<div class="login-box-wrapper">
                            		<div class="modal-body">
                            		<h4 class="text-center" style="padding-bottom: 20px;">Ingresa a tu cuenta</h4>			
                            			<div class="row gap-20">
	                                		<div class="col-sm-12 col-md-12">
	                                			<div class="form-group"> 
	                                				<label>Correo Electrónico</label>
	                                				<input class="form-control" placeholder="Ingresa tu Correo Electrónico" name="email" type="email" required> 
	                                			</div>
	                                 		</div>
													
			                                <div class="col-sm-12 col-md-12">
				                                <div class="form-group"> 
					                                <label>Contraseña</label>
					                                <input class="form-control" placeholder="Ingresa tu contraseña" name="password" required type="password"> 
				                                </div>
			                                </div>
								          	<div class="col-sm-12 col-md-12">
											    <div class="login-box-link-action">
													<a data-toggle="modal" onclick = "reset_text()" href="#forgotPasswordModal">¿Olvid&oacute; la contraseña?</a> 
											    </div>
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
								</div>
							</form>

						  	<div id="forgotPasswordModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
									</button>
									<h4 class="modal-title text-center">Restablece tu contraseña</h4>
								</div>

								<div class="modal-body">
									<div class="row gap-20">
										<div class="col-sm-12 col-md-12">
											<p class="mb-20">Ingresa Correo Electrónico asociado a tu cuenta, le enviaremos un correro con el enlace para restablecer su contraseña</p>
										</div>

										<div class="col-sm-12 col-md-12">
											<div class="form-group">
												<label>Correo Electrónico</label>
												<input id="mymail" autocomplete="off" name="email" class="form-control" placeholder="Ingresa tu Correo Electrónico" type="email" required> 
											</div>
										</div>
										<div class="col-sm-12 col-md-12">
											<div class="login-box-box-action">
								    			Regresar a <a data-dismiss="modal">Ingresar</a>
												<p id="data"></p>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer text-center">
									<button  onclick="update(mymail.value)" type="submit" class="btn btn-primary">Restaurar</button>
									<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Cerrar</button>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
<?php 
	include 'footer.php';
?>
		</div>
	</div> 
	<div id="back-to-top">
	   <a href="#"><i class="ion-ios-arrow-up"></i></a>
	</div>
</body>
</html>
<?php ob_flush();