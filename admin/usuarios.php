<?php 
  require_once "../constants/connection.php";
  global $conn;

  if(!isset($_GET['cmd'])) die();

  switch ($_GET['cmd']) {
    case 'list':
      $page = isset($_GET['page'])?intval($_GET['page'])?$_GET['page']:1:1;
      $num_rows = isset($_GET['num'])?intval($_GET['num'])?$_GET['num']:10:10;
      echo $num_rows;
      $offset = $num_rows * ($page - 1);
      $stmt = $conn->prepare("select  first_name, last_name, gender, bdate, bmonth, byear, email , education, title, city, street, zip,country, phone, about, services, expertise, people, last_login, role, website, login, member_no, verified from tbl_users  limit $num_rows offset $offset");
      $stmt->execute();
      $l = [];
     while($o = $stmt->fetchObject()){
        array_push($l ,$o );
      }
      
      print_r(json_encode($l));
   
    
    default:
      # code...
      break;
  }