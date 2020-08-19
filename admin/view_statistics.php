<?php

	require_once "../app/core.php";
?>
<div class="container">
<div class="row">
<div class="col-md-8">
<h3>Servicio mas buscado</h3>
<?php $smb = servicios_mas_buscado() ?>
	<b><?= $smb->busqueda ?></b><p><?=  $smb->numero ?></p> 
</div>		
</div>		
<div class="row">
<div class="col-md-8">
<h3>Cantidad de servicios creados</h3>
<?php $sc = servicios_cantidad() ?>
	<b><?= $sc ?></b> 
</div>		
</div>
<div class="row">
<div class="col-md-8">
<h3>Servicio mas buscado</h3>
<?php $c_list  = categorias_cantidad_servicios() ?>
	<b><?= $smb->busqueda ?></b><p><?=  $smb->numero ?></p> 

	<table class="table">
		<thead>
		<tr>
			<th>Categoria</th>
			<th>Servicios</th>
		</tr>
		</thead>
	<tbody>
<?php
	foreach ($c_list as $row):
?>
		<tr>
			<td><?= $row["categoria"] ?></td>
			<td><?= $row["numero"] ?></td>
		</tr>
<?php
	endforeach; 
?>
</tbody>
	</table>
</div>		
</div>
</div>
	