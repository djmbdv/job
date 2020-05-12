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

$sql = 'SELECT * from tbl_jobs';

if (mysqli_query($conn, $sql)) {

echo "conectado satisfactoriamente";

} else {

echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}


    ?>

<body>
    


<div class="row">

<div class="col col-2">

<?php include 'sidebar.php' ?>

</div>
<div class="col col-10">


<table class="table table-bordered">
 
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Nombre servicio</th>
      <th scope="col">descripcion de servicio</th>
      <th scope="col">categoria servicio</th>
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

      <th scope="row">    <?php echo $row['job_id']; ?>    </th>
      <td><?php echo $row['title']; ?></td>
      <td><?php echo $row['description']; ?></td>
      <td><?php echo $row['category']; ?></td>
      <td> <a class="btn btn-danger" href="servicios.php?borrar=<?php echo $row['job_id']; ?>" name="" value="borrar"  > borrar </a> </td>
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
           $borrar = "DELETE FROM tbl_jobs WHERE job_id='$borrar_id'";
           $ejecutar =mysqli_query($conn, $borrar);

          if($ejecutar){

            echo"<script> alert('datos eliminados')</script>";
            echo"<script>window.open('servicios.php','_self')</script>";


          }

         }
?>

 </tbody>
</table>















</div>



</div>









</body>