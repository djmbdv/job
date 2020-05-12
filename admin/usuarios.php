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

$sql = 'SELECT * from tbl_users';

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


<table class="table table-bordered ">
 
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">first Name</th>
      <th scope="col">correo</th>
      <th scope="col">phone</th>
      <th scope="col">Role</th>
      <th scope="col">Borrar</th>
      <th scope="col">Editar</th>
      <th scope="col">ver servicios asociados</th>
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
      <th scope="row"><?php echo $row['member_no']; ?></th>
      <?php $a  = $row['member_no']; ?>
      <th scope="row"><?php echo $row['first_name']; ?></th>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['role']; ?></td>
<td> <a class="btn btn-danger" href="usuarios.php?borrar=<?php echo $row['member_no']; ?>" name="" value="borrar"  > borrar </a> </td>


      <td> <a class="btn btn-warning" href="#">Editar</a> </td>

      <td> <a class="btn btn-info" href=""> ver servicios asociados</a> </td>

     
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
           $borrar = "DELETE FROM tbl_users WHERE member_no='$borrar_id'";
           $ejecutar =mysqli_query($conn, $borrar);

          if($ejecutar){

            echo"<script> alert('datos eliminados')</script>";
            echo"<script>window.open('usuarios.php','_self')</script>";


          }

         }
?>





 </tbody>
</table>















</div>



</div>









</body>