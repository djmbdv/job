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


<table class="table">
 
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">first Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Role</th>
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
    <td><?php echo $row[$count]; ?></td>

      <th scope="row"><?php echo $row['first_name']; ?></th>
      <td><?php echo $row['last_name']; ?></td>
      <td><?php echo $row['role']; ?></td>
      <td> <a class="btn btn-danger" href="#">Borrar</a> </td>
      <td> <a class="btn btn-warning" href="#">Editar</a> </td>

     
    </tr>
   
 

           
            <?php
            $count++;
            }
            } else {
            echo '0 results';
            }
   
?>
 </tbody>
</table>















</div>



</div>









</body>