<h2>Verificación de Vuelo</h2>

<?php
$datos = $db->query("SELECT * FROM control_equipaje a WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "'")->fetchAll();
?>
<fieldset data-role="controlgroup" data-type="horizontal">
	<legend>Selecione el vuelo:</legend>
<?php
foreach ( $datos as $reg ) {
?>
    <a href="home.php?s=verificar_vuelo&id=<?=$reg["vuelo"];?>&control=<?=$reg["id"];?>" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$reg["vuelo"];?></a>
    
<?php
}
?>
</fieldset>


<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
	<thead>
		<tr>
			<th>BagTag</th>
			<th>Counter</th>
			<th>Correa</th>
			<th>Avion/RX</th>
		</tr>
	</thead>
	<tbody>

<?php
if (isset($_GET["control"])) {
	$datos = $db->query("SELECT DISTINCT bar_tag, id_control FROM detalle_equipaje 
						WHERE id_control = '" . $_GET["control"] . "' GROUP BY bar_tag ORDER BY bar_tag DESC")->fetchAll();
	$x1 = 0;
	$x2 = 0;
	$x3 = 0;	
	foreach ( $datos as $reg ) {
		$control = $reg["id_control"];
		$datos1 = $db->query("SELECT bar_tag, leido FROM detalle_equipaje a 
				   WHERE a.id_control = '" . $control . "'
				   AND a.id_punto_control = 1 AND a.bar_tag = '" . $reg["bar_tag"] . "'")->fetchAll();
		
		$datos2 = $db->query("SELECT bar_tag, leido FROM detalle_equipaje a 
				   WHERE a.id_control = '" . $control . "'
				   AND a.id_punto_control = 2 AND a.bar_tag = '" . $reg["bar_tag"] . "'")->fetchAll();
		
		$datos3 = $db->query("SELECT bar_tag, leido FROM detalle_equipaje a 
				   WHERE a.id_control = '" . $control . "'
				   AND a.id_punto_control = 3 AND a.bar_tag = '" . $reg["bar_tag"] . "'")->fetchAll();
		
		if ( count($datos1) ){$x1=$x1+1; $check1 = '<i class="fa fa-check"></i>';}else{$check1 = '<i class="fa fa-close iconRojo"></i>';}
		if ( count($datos2) ){$x2=$x2+1; $check2 = '<i class="fa fa-check"></i>';}else{$check2 = '<i class="fa fa-close iconRojo"></i>';}
		if ( count($datos3) ){$x3=$x3+1; $check3 = '<i class="fa fa-check"></i>';}else{$check3 = '<i class="fa fa-close iconRojo"></i>';}
?>
			<tr>
				<td><?=$reg["bar_tag"];?></td>
				<td><?=$check1;?></td>
				<td><?=$check2;?></td>
				<td><?=$check3;?></td>
			</tr>
<?php
	}
}
?>
		 <tr>
                        <td>Total Maletas:</td>
                        <td><?=$x1;?></td>
                        <td><?=$x2;?></td>
                        <td><?=$x3;?></td>
                 </tr>
	</tbody>
</table>

