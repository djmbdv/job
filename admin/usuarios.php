<?php
  require_once "../constants/connection.php";
  global $conn;

  if(!isset($_GET['cmd'])) die();
  header("Content-type:application/json");
  switch ($_GET['cmd']) {
    case 'list':
      $page = isset($_GET['page'])?intval($_GET['page'])?$_GET['page']:1:1;
      $num_rows = isset($_GET['num'])?intval($_GET['num'])?$_GET['num']:10:10;
      $offset = $num_rows * ($page - 1);
      $stmt = $conn->prepare("select  first_name, last_name, gender, bdate, bmonth, byear, email , education, title, city, street, zip,country, phone, about, services, expertise, people, last_login, role, website,member_no, verified from tbl_users  limit $num_rows offset $offset");
      $stmt->execute();
      $l = [];
      while($o = $stmt->fetchObject()){
        array_push($l ,$o );
      }
      echo json_encode($l);
      break;
    case 'search':
      if(!isset($_GET["id"]))break;
      $id = $_GET['id'];
      $stmt = $conn->prepare("select  first_name, last_name, gender, bdate, bmonth, byear, email , education, title, city, street, zip,country, phone, about, services, expertise, people, last_login, role, website,member_no, verified from tbl_users where member_no=:id");
      $stmt->bindParam(":id",$id);
      $stmt->execute();
      $o = $stmt->fetchObject();
      echo json_encode($o);
      break;
    case 'del':
      if(!isset($_POST["id"]))break;
      $id = $_GET['id'];
      $stmt = $conn->prepare("delete from tbl_users where member_no=:id");
      $stmt->bindParam(":id",$id);
      echo $stmt->execute();
    case 'count':
      $stmt = $conn->prepare("select count(member_no) as num from tbl_users");
      $stmt->execute();
      $o = $stmt->fetchObject();
      echo json_encode($o->num);
    default:
      echo false;
      break;
  }