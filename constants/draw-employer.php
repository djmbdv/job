<?php
	require_once 'constants/connection.php';
?>
<form name="frm" class="form-employer" action="app/create-account.php" method="POST" data-toggle="validator" role="form" >
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
		<div class="form-group has-feedback">
		<label for="inputTwitter" class="control-label">Twitter</label>
		<input type="text" pattern="^[_A-z0-9]{1,}$" class="form-control" id="inputTwitter" placeholder="1000hz" required />
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		<div class="help-block with-errors"></div>
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
			<input class="form-control" type="email" role="register" placeholder="Ingresa tu Correo Electrónico" name="email" required> 
		</div>											
	</div>
												
	<div class="col-sm-12 col-md-12">											
		<div class="form-group"> 
			<label>Contraseña</label>
			<input class="form-control" placeholder="Min 8 y Max 20 caracteres" name="password" required type="password" required> 
		</div>											
	</div>
													
	<div class="col-sm-12 col-md-12">											
		<div class="form-group">
			<label>Confirmar contraseña</label>
			<input class="form-control" placeholder="Repite tu contraseña" name="confirmpassword" required type="password" required> 
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
	$("input[type='email'][role='register']").change(e => {
		console.log($(e.srcElement).val());
/*	  	.done(function( data ) {
	    alert( "Data Loaded: " + data );
	  	});*/
	}).change();
	$(".form-employer").submit((e)=>{
		e.preventDefault();
		alert("submit");

	});
</script>