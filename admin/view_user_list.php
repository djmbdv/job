<?php 
include_once "../constants/connection.php";
  include_once "../app/core.php";
  global $conn;
?>
  <div class="modal fade modal-ver-model" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">X</div>
      </div>
    </div>
  </div>
  <div class="modal fade modal-delete-model" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Borrrar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">X</div>
      </div>
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
            <div id="tabla-usuarios" class="table-dinamics" model="users" columns="member_no,email,first_name" num="10"></div> 
          </div>      
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
