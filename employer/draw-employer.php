<?php


$conn = new mysqli($servername, $username, $password, $dbname);

$sql = 'SELECT * from tbl_users';

if (mysqli_query($conn, $sql)) {

echo "conectado satisfactoriamente";

} else {

echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}
include '../headerPrincipal.php';
?>


<form name="frm" action="app/create-account.php" method="POST" autocomplete="off">
<div class="login-box-wrapper">
							
<div class="modal-header">
<h4 class="modal-title text-center">Crea tu cuenta gratis</h4>
</div>

<div class="modal-body">
																
<div class="row gap-20">
											

												

												
<div class="col-sm-12 col-md-12">

<div class="form-group"> 
<label>Nombre de Empresa</label>
<input class="form-control" placeholder="Ingresa tu Nombre " name="company" required type="text"> 
</div>
												
</div>

<div class="col-sm-12 col-md-12">

<div class="form-group"> 
<select class="form-control" name="category" required/>
										<option   value="">   Selecciona categoria- </option>
										
										 <?php
										 require 'constants/db_config.php';
										 try {
                                         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
                                         $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
                                         $stmt->execute();
                                         $result = $stmt->fetchAll();

                                         foreach($result as $row)
                                         {
                                        ?>
										
										<option style="color:black" value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
										<?php
	                                     }
                                         $stmt->execute();
					  
	                                     }catch(PDOException $e)
                                         {
        
                                         }
	
										?>
														   
										</select>
												
</div>
												
<div class="col-sm-12 col-md-12">

<div class="form-group"> 
<label>Correo Electrónico</label>
<input class="form-control" placeholder="Ingresa tu Correo Electrónico" name="email" required type="text"> 
</div>


<?php 


$count=1;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

$a = "<script> document.getElementById('email').value </script>";
while($row = mysqli_fetch_assoc($result)) { 
           
      
           
           
          
  
  
     echo $row[$count]; 

    if($a ==  $_GET['email']) {

      //  alert('correo repetio');

    }
    

   
 

           
            
            $count++;
            }
            } else {
            echo '0 results';
            }
   
?>



</div>
												
<div class="col-sm-12 col-md-12">
												
<div class="form-group"> 
<label>Contraseña</label>
<input class="form-control" placeholder="Min 8 y Max 20 caracteres" name="password" required type="password"> 
</div>
												
</div>
												
<div class="col-sm-12 col-md-12">
												
<div class="form-group"> 
<label>Confirmar contraseña</label>
<input class="form-control" placeholder="Repite tu contraseña" name="confirmpassword" required type="password"> 
</div>
												
</div>
												
<input type="hidden" name="acctype" value="102">
												
												
</div>

</div>

<div class="modal-footer text-center">
<button  onclick="return val();" type="submit" name="reg_mode" class="btn btn-primary">Registrar</button>
</div>
										
</div>
</form>
