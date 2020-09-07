<?php include_once "../constants/connection.php";
  include_once "../app/core.php";

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
$rows = $stmt->fetchAll();

?>
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
<?php foreach ($columns as $col):?>
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

$num = isset($_GET["num"])?intval($_GET["num"]):10;
$page = isset($_GET["page"])?intval($_GET["page"]):1;
if($_GET['element'] == "pagination")get_user_pagination(null,$num, $page);
else get_user_table($page,array('member_no','email'),$num,null,null);