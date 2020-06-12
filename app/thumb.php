<?php
if(!isset($_GET["id"]))die();
require_once "../constants/connection.php";
$smtm = $conn->prepare("select path from tbl_image_service where id = :id");
$smtm->bindValue(":id",$_GET["id"]);
$nombre_fichero = 'prueba.jpg';
$porcentaje = 0.5;
$smtm->execute();
$path = $smtm->fetchObject()->path;
header('Content-Type: image/jpeg');


list($ancho, $alto) = getimagesize($path);
//print_r($ancho);

$nuevo_ancho = $ancho * $porcentaje;
$nuevo_alto = $alto * $porcentaje;

$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
$origen = imagecreatefrompng($path);


imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);


imagejpeg($thumb);