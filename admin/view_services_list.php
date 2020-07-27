<?php include_once "../constants/connection.php";
  global $conn;
?>
  <div id="content">
      <?php include_once("topbar.php");?>
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Servicios</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Servicios</h6>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sel</th>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Fecha de registro</th>
                      <th>Verificado</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sel</th>
                     <th>ID</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Fecha de registro</th>
                      <th>Verificado</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php 
  $stmt = $conn->prepare("select * from tbl_jobs limit 10 ");
  $stmt->execute();
  $result = $stmt->fetchAll();
  //print_r($result);
  foreach ($result as $key => $row):

  
?>
                    <tr class="cell-user" id-user="<?=$row["member_no"]?>">
                      <td><input type="checkbox" name=""/></td>
                      <td><?=$row["member_no"]?></td>
                      <td><?=$row["first_name"]?></td>
                      <td><?=$row["email"]?></td>
                      
                      <td><?=$row["created_at"]?></td>
                       <td><?=$row["verified"] ? "Si":"No"?></td>
                      <td>
                        <button class="btn btn-danger btn-sm btn-circle">X</button>
                        <button class="btn btn-warning btn-sm btn-circle"><span class="fa fa-pencil"></span></button>
                      </td>
                    </tr>

<?php endforeach;?>
            
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->