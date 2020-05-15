<?php
	require_once 'constants/connection.php';
?>
<form name="frm" class="form-employer" action="app/create-account.php" method="POST" role="form" >
<div class="login-box-wrapper">
							
<div class="modal-header">
	<h4 class="modal-title text-center">Crea tu cuenta gratis</h4>
</div>

<div class="modal-body">
																
<div class="row gap-20">																	
	<div class="col-sm-12 col-md-12">
		<div class="form-group"> 
			<label>Nombre de Empresa</label>
			<input class="form-control" placeholder="Ingresa tu Nombre de Empresa" name="company" required type="text"> 
		</div>												
	</div>


	<div class="col-sm-12 col-md-12">
		<div class="form-group"> 
			<select class="form-control" name="category" required/>
				<option   value="">Selecciona categoria</option>
				<?php
					$stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
					$stmt->execute();
					$result = $stmt->fetchAll();
					foreach($result as $row): 
				?>
				<option style="color:black" value="<?= $row['id']; ?>"><?= $row['category']; ?></option>
				<?php
					endforeach;
				?>														   
			</select>									
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

</div> <!-- MODAL BODY -->
<div class="modal-footer text-center">
<button  id="regb" name="reg_mode" class="btn btn-primary">Registrar</button>
</div>
										
</div>
</form>
<script type="text/javascript">
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
			return false;
		}
		$(e.srcElement).parent(".form-group")
				.removeClass("has-error").addClass("has-success")
				.find(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
			$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text(""));
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
			return false;
		}
		$(e.srcElement).parent(".form-group")
				.removeClass("has-error").addClass("has-success")
				.find(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
			$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text(""));
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
				console.log(data);
			}else {
				$(e.srcElement).parent(".form-group")
				.removeClass("has-success").addClass("has-error")
				.find(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");
				$(e.srcElement).parent(".form-group").find(".help-block").html( $("<p></p>").text("Email ya registrado."));
				//console.log(data);
			}
		} );
	});
	$(".form-employer").submit((e)=>{
		e.preventDefault();
		var data = $(e.srcElement).serializeArray();
		$.post('app/create-account.php', data, result =>{
			switch(result){
				case 1: alert("Cuenta registrada exitosamente. Ingrese a su correo para confimar el registro.");
				break;
				default: alert(result);
			};	
		});
	});
</script>