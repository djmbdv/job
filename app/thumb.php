<?php
if(!isset($_GET["id"]))die();
require_once "../constants/connection.php";
$smtm = $conn->prepare("select path from tbl_image_service where id = :id");
$smtm->bindValue(":id",$_GET["id"]);
$porcentaje = 0.5;
$smtm->execute();
$path = $smtm->fetchObject()->path;
$pi = pathinfo($path);

if($pi["extension"] == 'png'):
header('Content-Type: image/png');


list($ancho, $alto) = getimagesize($path);
//print_r($ancho);

$nuevo_ancho = $ancho * $porcentaje;
$nuevo_alto = $alto * $porcentaje;

$thumb = imagecreate($nuevo_ancho, $nuevo_alto);
$origen = imagecreatefrompng($path);

imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);


imagepng($thumb);
elseif($pi["extension"] == 'jpg' || $pi["extension"] == 'jpeg'):
header('Content-Type: image/jpg');


list($ancho, $alto) = getimagesize($path);
//print_r($ancho);

$nuevo_ancho = $ancho * $porcentaje;
$nuevo_alto = $alto * $porcentaje;

$thumb = imagecreate($nuevo_ancho, $nuevo_alto);
$origen = imagecreatefromjpeg($path);

imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
endif;