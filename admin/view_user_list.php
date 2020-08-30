<?php include_once "../constants/connection.php";
  include_once "../app/core.php";
  global $conn;
?>



  <div class="modal fade modal-ver-model" role="dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      <div class="modal-body">X</div>
    </div>
  </div>

  <div id="content">
    <?php include_once("topbar.php");?>
    <div class="container-fluid">      <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div id="tabla-usuarios" class="table-dinamics" model="users" num="10"></div> 
          <!--table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
  $stmt = $conn->prepare("select * from tbl_users limit 15 ");
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach ($result as $key => $row):?>
            <tr class="cell-user" id-user="<?=$row["member_no"]?>">
              <td><input type="checkbox" name=""/></td>
              <td><?=$row["member_no"]?></td>
              <td><?=$row["first_name"]?></td>
              <td><?=$row["email"]?></td>
              <td><?=$row["created_at"]?></td>
              <td><?=$row["verified"] ? "Si":"No"?></td>
              <td>
                <button class="btn btn-primary btn-sm btn-circle"><span class="fa fa-search"></span></button>
                <button class="btn btn-danger btn-sm btn-circle">X</button>
                <button class="btn btn-warning btn-sm btn-circle"><span class="fa fa-pencil"></span></button>
              </td>
            </tr>
<?php endforeach;?>
          </tbody>
        </table-->
      </div>
      <div class="card-footer">
        <nav aria-label="...">
          <div class="model-pagination" model="users" tabla="tabla-usuarios"></div>
        </nav>
        <label>Cantidad</label>
        <select class="select-num">
          <option selected="">10</option>
          <option>50</option>
          <option>500</option>
        </select>
      </div>
    </div>
</div>
</div>
</div>