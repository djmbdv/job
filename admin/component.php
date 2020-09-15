<?php include_once "../constants/connection.php";
  include_once "../app/core.php";
  require_once "../app/core/ModelTable.php";
function get_user_table($page,$columns, $num, $filters,$orders ){
  global $conn;
  $table = "tbl_users";
  $cols = '';
  $fils = '';
$offset = $num * ($page-1);
foreach ($columns as  $k => $col) {
  $cols .=($k == 0)?"`$col`" : ",`$col`";
}
if( is_null($filters))$fils = '1'; else
foreach ($filters as $k => $fil) {
  $fils .=(($k = 0)?'':' or ' )."`$table`.`$fil->col` = `$fil->value`";
}
$sql = "select $cols from $table  where $fils limit $offset,$num";
$stmt = $conn->prepare($sql);
$stmt->execute();

$model = new Model("tbl_users");
$model->make_alias("first_name","Nombre");
$model->make_alias("member_no","Codigo");

$table =  new ModelTable($model,$columns,[],1,$num,$page-1);
$rows = $table->get_rows();
//print_r($columns);
?>
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
<?php foreach ($table->get_headers() as $col):?>
        <th><?=$col?> <span>!</span><span  class="dropdown"><button class="btn-sm">F</button></span></th>       
<?php endforeach;?>
        <th>
          Acciones
        </th>
      </tr>      
    </thead>
    <tbody>
<?php foreach ($rows as $row):?>
      <tr>
<?php foreach ($columns as $col): ?>
        <td><?= $row[$col] ?></td>
<?php endforeach; ?>
        <td><button class="btn btn-warning btn-sm btn-circle button-ver-model" indice="<?= $row["member_no"]?>"><span class="fa fa-eye"></span></button><button class="btn btn-danger btn-sm btn-circle"><span class="fa fa-trash"></span></button></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
<?php 
}

function get_user_pagination($filters, $num, $current_page = 1, $offset_page = 0){
  global $conn;
  $table = "tbl_users";
  $cols = '';
  $fils = '';
  if( is_null($filters))$fils = '1'; else
  foreach ($filters as $k => $fil) {
    $fils .=(($k = 0)?'':' or ' )."`$table`.`$fil->col` = `$fil->value`";
  }
  $sql = "select count(*) as cantidad from $table where $fils";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $can = $stmt->fetchColumn();
  $number_pages =  ceil($can/$num);
?>
<ul class="pagination">
  <li class="page-item <?= $current_page != 1?'':"disabled" ?>">
    <a class="page-link" href="#" tabindex="-1">Previous</a>
  </li>
 <?php for($i = 1; $i <= $number_pages && $i - $offset_page <= 10 ; $i++): ?>
    <li class="page-item">
      <a class="page-link <?= $i == $current_page ?'selected':''?>" href="#" page="<?= $i ?>"><?= $i ?> <?= $i == $current_page ? '<span class="sr-only">(current)</span>':'' ?></a>
    </li>
<?php endfor; ?>
    <a class="page-link" href="#">Next</a>
    </li>
</ul>
<?php
}


/*function modal_edit_user($id){


?>
                      <div class="row gap-20">
                        <div class="clear"></div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Nombre de la empresa</label>
                            <input name="company" placeholder="Enter Nombre de Empresa" type="text" class="form-control" value="<?= $compname ?>" required>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>NIT</label>
                            <input class="form-control" placeholder="ingrese su nit" name="type"  type="text" value="<?= $mytitle ?>" /> 
                          </div>
                        </div>
                        <div class="clear"></div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Responsable</label>
                            <input class="form-control" placeholder="ingrese su nit" name="type"  type="text" value="<?= $mytitle ?>" /> 
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Ciudad</label>
                            <input name="city" required type="text" class="form-control" value="<?php echo "$city"; ?>" placeholder="Ingresa tu city">
                          </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Direccion</label>
                            <input name="street" required type="text" class="form-control" value="<?=$street?>" placeholder="Ingresa tu street"  required>
                          </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Código Postal</label>
                            <input name="zip"  type="text" class="form-control" value="<?=$zip ?>" placeholder="Ingresa tu zip">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Departamento</label>
                            <select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
                              <option disabled value="">Seleccionar</option>
<?php

  $stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach($result as $row):?>
                                                            <option <?= ($country == $row['country_name']) ? 'selected':'' ?> value="<?= $row['country_name']?>"><?=$row['country_name']?></option>
<?php
  endforeach;
  
                               ?>
                            </select>
                          </div>
                        </div>
                        <div class="clear"></div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Teléfono</label>
                            <input type="tel" name="phone" required class="form-control" value="<?=$myphone?>" placeholder="Ingresa tu telefono"  required>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input type="email" name="email" required class="form-control" value="<?=$mymail?>" placeholder="Ingresa tu email">
                          </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                          <label>Página Web</label>
                            <input type="text" class="form-control" value="<?=$myweb?>" name="web" placeholder="Ingresa tu website">
                        </div>


<?php
} 
*/
//modal_edit_user(1);
//die();
//print_r($_GET);
$num = isset($_GET["num"])?intval($_GET["num"]):10;
$page = isset($_GET["page"])?intval($_GET["page"]):1;
if($_GET['element'] == "pagination")get_user_pagination(null,$num, $page);
else get_user_table($page,$_GET["columns"],$num,null,null);