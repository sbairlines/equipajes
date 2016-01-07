<h2>Reporte Diario</h2>

<form class="frm" method="get" data-ajax="false" action="home.php?s=reporte_diario">
	<label for="txtFecha">Fecha:</label>
	<input type="hidden" name="s" id="s" value="<?=$_GET["s"]?>">
	<input type="text" name="txtFecha" id="txtFecha" value="<?=date("d-m-Y");?>">
	<input type="submit" class="ui-btn ui-btn-inline" value="Aceptar" />
<?php
$fecha = isset($_GET["txtFecha"])?$_GET["txtFecha"]:"";
if ( $fecha != "" ) {
	$datos = $db->query("SELECT * FROM control_equipaje a WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "'")->fetchAll();
?>
	<fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Selecione el vuelo:</legend>
	<?php
	foreach ( $datos as $reg ) {
	?>
	    <a href="home.php?s=reporte_diario&txtFecha=<?=$fecha;?>&vuelo=<?=$reg["vuelo"];?>&control=<?=$reg["id"];?>" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$reg["vuelo"];?></a>
    
	<?php
	}
	?>
	</fieldset>
</form>

	<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
		<thead>
			<tr>
				<th>N&deg;</th>
				<th>Cod IATA</th>
				<th>BagTag</th>
			</tr>
		</thead>
		<tbody>
	
	<?php
	$i = 0;
	if (isset($_GET["control"])) {
		$datos = $db->query("SELECT bar_tag, cod_iata, id_control FROM detalle_equipaje 
							WHERE id_control = '" . $_GET["control"] . "' GROUP BY bar_tag ORDER BY bar_tag DESC")->fetchAll();
		
		foreach ( $datos as $reg ) {
	?>
				<tr>
					<td><?=++$i;?></td>
					<td><?=$reg["cod_iata"];?></td>
					<td><?=$reg["bar_tag"];?></td>
				</tr>
	<?php
		}
	}
	?>
		</tbody>
		<thead>
			<tr>
				<th></th>
				<th>Total Equipajes:</th>
				<th><?=$i;?></th>
			</tr>
		</thead>
	</table>
<?php
}
?>
