<?php include_once "../constants/connection.php";
  global $conn;
?>
<div class="modal">
  
</div>
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
            <div id="tabla-usuarios" class="table-dinamics" model="jobs" columns="job_id,title,city,country,telefono,description,buscado" num="10"></div> 
          </div>      
        </div>
        <div class="card-footer">
          <nav aria-label="...">
            <div class="model-pagination" model="jobs" tabla="tabla-usuarios"></div>
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->