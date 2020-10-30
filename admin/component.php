<?php include_once "../constants/connection.php";
  include_once "../app/core.php";
  require_once "../app/core/ModelTable.php";
  require_once "../app/core/ModelEditForm.php";

function get_edit_form($id,$model,$main_key = "id"){
//  print_r($main_key."main_key");
  $model  = new Model("tbl_$model", $main_key);
    $model->make_alias("first_name","Nombre");
  $model->make_alias("member_no","Código");
  $model->make_alias("category","Categoría");
  $model->make_alias("title", "Título");
  $model->make_alias("country", "Departamento");
  $modelEditForm = new ModelEditForm([],$model, $main_key);
  
  $fields = $modelEditForm->get_entity_fields($id);
  foreach ($fields as $key => $field): 
echo "$key";
    ?>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 col-form-label"><?= $model->get_atribute($key)->alias ?? $model->get_atribute($key)->name  ?></label>
  <input class="form-control" type="" name="" value="<?= $field ?>">
  </div>
  <?php
  endforeach;  
}

function get_table($page,$columns, $num, $filters,$orders,$model, $main_key){

  $model = new Model("tbl_$model", $main_key);
  $model->make_alias("first_name","Nombre");
  $model->make_alias("member_no","Código");
  $model->make_alias("category","Categoría");
  $model->make_alias("title", "Título");
  $model->make_alias("country", "Departamento");
  echo $model->column_index."->>>>>>>>>>>";
  $table =  new ModelTable($model,$columns,[],1,$num,$page-1);
  $rows = $table->get_rows();
?>
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
<?php foreach ($table->get_headers() as $col):?>
        <th><?=$col?>
          <div style="display:inline-block;margin-left:auto;" >
           <span class="fa fa-search"></span>
           <button  class="btn btn-sm dropdown"><span class="fa fa-filter"></span></button>
          </div>
        </th>       
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
        <td><button class="btn btn-warning btn-sm btn-circle button-ver-model" indice="<?= $row[$model->column_index]?>" model="<?= $model->model_name ?>" column-index="<?= $model->column_index ?>"><span class="fa fa-eye"></span></button><button class="btn btn-danger btn-sm btn-circle"><span class="fa fa-trash"></span></button></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
<?php 
}

function get_pagination($filters, $num, $current_page = 1, $offset_page = 0,$model){
  global $conn;
  $model = new Model("tbl_$model");
  $tablemodel =  new ModelTable($model,[],["member_no"],1,$num,$current_page-1);
  $number_pages =  $tablemodel->get_number_pages();
?>
<ul class="pagination">
  <li class="page-item <?= $current_page != 1?'':"disabled" ?>">
    <a class="page-link" href="#" tabindex="-1">Previous</a>
  </li>
<?php 
  for($i = 1; $i <= $number_pages && $i - $offset_page <= 10 ; $i++): ?>
    <li class="page-item">
      <a class="page-link <?= $i == $current_page ?'selected':''?>" href="#" page="<?= $i ?>"><?= $i ?> <?= $i == $current_page ? '<span class="sr-only">(current)</span>':'' ?></a>
    </li>
<?php 
  endfor;?>
    <li>
      <a class="page-link" href="#">Next</a>
    </li>
</ul>
<?php
}
print_r($_GET);
$num = isset($_GET["num"])?intval($_GET["num"]):10;
$page = isset($_GET["page"])?intval($_GET["page"]):1;
if($_GET['element'] == "pagination")get_pagination(null,$num, $page,0,$_GET["model"]);
else if($_GET["element"] == "model_form"){
  if($_GET["main_key"])get_edit_form($_GET["key"],$_GET["model"],$_GET["main_key"]);
  else get_edit_form($_GET["key"],$_GET["model"]);
}
else get_table($page,$_GET["columns"],$num,null,null,$_GET["model"], $_GET["main_key"]);