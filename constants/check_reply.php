<?php

require '../constants/connection.php';

global $conn;

if (isset($_GET['r'])):
    $error_code = $_GET['r'];
    $stmt = $conn->prepare("SELECT * FROM tbl_alerts WHERE code = :errorcode");
    $stmt->bindParam(':errorcode', $error_code);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $row):
        $description = $row['description'];
        $type = $row['type']; ?>
<div class="alert text-center alert-<?=$type?>">
    <?= $description ?>
</div>
    <?php 
    endforeach;
endif;