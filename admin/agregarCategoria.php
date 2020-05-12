<?php 
include 'header.php';
include 'conexion.php';

  /*  include '../constants/settings.php'; 
    include 'constants/check-login.php';
    
    if ($user_online == "true") {
    if ($myrole == "admin") {
    }else{
    header("location:../");		
    }
    }else{
    header("location:../");	
    }
*/
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = 'SELECT * from tbl_categories';

if (mysqli_query($conn, $sql)) {

echo "conectado satisfactoriamente";

} else {

echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}


    ?>


<section>
   
<div class="row" style="background:black;"> 
<div class="container"  style="background:white;  text-align:center;     text-align: -webkit-center;
" >

<div style="">
<h1>Agregar una nueva categoria</h1>
 <form action="agregarCategoria.php" method="POST">
 <div class="card" style="width: 18rem;">
<div class="input-group mb-3">

  <input type="text" name="categoria" value="" class="form-control" placeholder="Escriba una categoria aqui" aria-label="Example text with button addon" aria-describedby="button-addon1">
</div> 
 <div class="card-body">
<button class="btn btn-success" type="submit" name="agregar"> agregar</button>  </div>
</div>
 
 
 </form>


</div>
 
</div>
</div>

</section>
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
                    echo"<script>window.open('agregarCategoria.php','_self')</script>";
        
                      
                  }

            }
        
            ?>
            
            <script></script>
<body>
 
<div class="row">

<div class="col col-2">

<?php include 'sidebar.php' ?>

</div>
<div class="col col-10">


<table class="table table-bordered ">
 
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">category</th>
    
     
      <th scope="col">Borrar</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>


<?php 


$count=1;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) { ?>
           
      
           
           
          
  <tbody>
    <tr>
    <?php echo $row[$count]; ?>
      <th scope="row"><?php echo $row['id']; ?></th>
      <th scope="row"><?php echo $row['category']; ?></th>
     
<td> <a class="btn btn-danger" href="agregarCategoria.php?borrar=<?php echo $row['id']; ?>" name="" value="borrar"  > borrar </a> </td>


      <td> <a class="btn btn-warning" href="#">Editar</a> </td>

     
    </tr>
   
 

           
            <?php
            $count++;
            }
            } else {
            echo '0 results';
            }
   
?>

<?php
         if(isset($_GET['borrar'])){
           $borrar_id = $_GET['borrar'];
           $borrar = "DELETE FROM tbl_categories WHERE id='$borrar_id'";
           $ejecutar =mysqli_query($conn, $borrar);

          if($ejecutar){

            echo"<script> alert('datos eliminados')</script>";
            echo"<script>window.open('agregarCategoria.php','_self')</script>";


          }

         }
?>





 </tbody>
</table>



</div>



</div>








</body>

