<?php

require_once 'constants/connection.php';?>
<div id="messageModal" class="modal fade modal-dialog" role="dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informaci&oacute;n</h4>
      </div>
      <div class="modal-body">
        <p>Un email ha sido enviado a su correo para la activacion de su cuenta.</p>
      </div>
      <div class="modal-footer">
        <button id="closeButton" type="button" class="btn btn-default" class="close-modal-info">Close</button>
      </div>
    </div>
</div>
<form name="frm" class="form-employer" action="app/create-account.php" method="POST" role="form" error="0">
<div class="login-box-wrapper">
<div class="modal-body">
<h4 class="text-center" style="padding-bottom: 20px;">Crea tu cuenta gratis</h4>										
	<div class="col-sm-12 col-md-12">
		<div class="form-group"> 
			<label>Nombre de Empresa</label>
			<input class="form-control" placeholder="Ingresa tu Nombre de Empresa" name="company" required type="text"> 
		</div>												
	</div>										
	<div class="col-sm-12 col-md-12">
		<div class="form-group has-feedback"> 
			<label>Correo Electrónico</label>
			<input class="form-control" type="email" role="register" gly="email-gly" placeholder="Ingresa tu Correo Electrónico" name="email" required> 
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>											
	</div>
												
	<div class="col-sm-12 col-md-12">											
		<div class="form-group  has-feedback"> 
			<label>Contraseña</label>
			<input id="password-input" class="form-control" placeholder="Min 8 y Max 20 caracteres" name="password" required type="password" regex="^.{8,20}$" error-msg="Contraseña no v&aacute;lida" required>
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>											
	</div>
													
	<div class="col-sm-12 col-md-12">											
		<div class="form-group has-feedback">
			<label>Confirmar contraseña</label>
			<input class="form-control" match="password-input" placeholder="Repite tu contraseña" name="confirmpassword" required type="password" error-msg="Las Contraseñas no coinciden" required> 
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>											
	</div>								
	<input type="hidden" name="acctype" value="102">
</div>
<button  id="regb" name="reg_mode" class="btn btn-primary btn-block">Registrar</button>
</div>
</form>
<script type="text/javascript">
	function getError(){
		return parseInt($("form").attr("error"));
	}
	function setError( i){
		$("form").attr("error",i);
	}
	function updateError(){
		setError(0);
		var errores = 0;
		$("form").find("input").each(function(){
			var i = Number.isNaN(parseInt($(this).attr("error")))?0:parseInt($(this).attr("error"));
			setError(getError() + i);
		});
		return errores;
	}


	function valide(e){
		var value =  $(e.srcElement).val();
		console.log(value);
		var rg = new RegExp($(e.srcElement).attr("regex"));
		var errorMsj = $(e.srcElement).attr("error-msg");
		console.log(rg.test(value));
		if(!(rg.test(value))){
			$(e.srcElement).parent(".form-group")
				.removeClass("has-success").addClass("has-error")
				.find(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");
			$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text(errorMsj));
			$(e.srcElement).attr("error",1);
			return false;
		}
		$(e.srcElement).parent(".form-group")
				.removeClass("has-error").addClass("has-success")
				.find(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
			$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text(""));
			$(e.srcElement).attr("error",0);
		return true;
	}

	function valideMatch(e){
		var value =  $(e.srcElement).val();
		console.log(value);
		var match = $("#"+$(e.srcElement).attr("match")).val();
		var errorMsj = $(e.srcElement).attr("error-msg");
		console.log(match);
		if(!(value == match)){
			$(e.srcElement).parent(".form-group")
				.removeClass("has-success").addClass("has-error")
				.find(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");
			$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text(errorMsj));
			$(e.srcElement).attr("error",1);
			return false;
		}
		$(e.srcElement).parent(".form-group")
				.removeClass("has-error").addClass("has-success")
				.find(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
			$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text(""));
			$(e.srcElement).attr("error",0);
		return true;
	}
	$("input[name='password']").keyup(valide);
	$("input[name='confirmpassword']").keyup(valideMatch);
	$("input[type='email'][role='register']").keyup(e => {
		var email = $(e.srcElement).val();
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){
			$(e.srcElement).parent(".form-group")
				.removeClass("has-success").addClass("has-error")
				.find(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");
			$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text("Email no valido."));
			return;
		}
		$.post("constants/check_email.php",{ "email" : email},(data)=>{
			if(data == 1  ){
				//console.log("valid email!");
				$(e.srcElement).parent(".form-group")
				.removeClass("has-error").addClass("has-success")
				.find(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
				$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text(""));
				$(e.srcElement).attr("error",0);
			}else {
				$(e.srcElement).parent(".form-group")
				.removeClass("has-success").addClass("has-error")
				.find(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");
				$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text("Email ya registrado."));
				$(e.srcElement).attr("error",1);
			}
		} );
	});
	$(".form-employer").submit((e)=>{
		e.preventDefault();
		updateError();
		var errors =getError();
		if(errors > 0){
			alert("Error en los campos del formulario");
			return;
		}
		var data = $(e.srcElement).serializeArray();
		$.post('app/create-account.php', data, result =>{
			if(result == 1) $("#messageModal").modal();
		});
	});
	$("#closeButton").click(e=>{
		console.log("cerrar");
		window.location.href = "login.php";
	});
</script>