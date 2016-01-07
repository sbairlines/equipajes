<h2>Estatus de Vuelo</h2>

<?php
$datos = $db->query("SELECT * FROM control_equipaje a WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "'")->fetchAll();
?>
<fieldset data-role="controlgroup" data-type="horizontal">
	<legend>Selecione el vuelo:</legend>
<?php
foreach ( $datos as $reg ) {
?>
    <a href="home.php?s=estatus_vuelo&id=<?=$reg["vuelo"];?>&control=<?=$reg["id"];?>" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$reg["vuelo"];?></a>
<?php
}
?>
</fieldset>


<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
	<thead>
		<tr>
			<th>Punto de Control</th>
			<th>Cantidad</th>
			<th>Estatus</th>
			<th>Alertas</th>
		</tr>
	</thead>
	<tbody>

<?php
if (isset($_GET["control"])) {
$datos = $db->query("SELECT b.nombre, COUNT( bar_tag ) cantidad, a.estatus, a.id_punto_control
					   FROM detalle_equipaje a, puntos_controles b
					   WHERE a.id_punto_control = b.id
					   AND a.id_control = '" . $_GET["control"] . "'
					   GROUP BY b.nombre")->fetchAll();
	foreach ( $datos as $reg ) {
?>
		<tr>
			<th><?=$reg["nombre"];?></th>
			<td><?=$reg["cantidad"];?></td>
			<td><?=estatusVuelo($reg["estatus"]);?></td>
			<?php
			$inconsistencias = $db->count("inconsistencias", "*", ["AND" => ["id_control" => $_GET["control"], "id_punto_control" => $reg["id_punto_control"]]]);
			if ( $inconsistencias > 0 ) {
				$class = "iconRojo";
			} else {
				$class = "iconGris";
			}
			?>
			<td><a href="#popupInconsistencias<?=$reg["id_punto_control"]?>" data-rel="popup" data-position-to="window" data-transition="pop" style="text-decoration: none;"><i class="fa fa-check-circle-o <?=$class;?>"></i></a> <?=($inconsistencias==0)?"":$inconsistencias;?></td>
		</tr>
		<div data-role="popup" id="popupInconsistencias<?=$reg["id_punto_control"]?>" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
			<div data-role="header" data-theme="b">
			<h1>Alertas</h1>
			</div>
			<div role="main" class="ui-content">
				<h3 class="ui-title">Ultima inconsistencia registrada.</h3>
				<?php
				$inconsistencia = $db->get("inconsistencias", "*", ["AND" => ["id_control" => $_GET["control"], "id_punto_control" => $reg["id_punto_control"]], "ORDER" => "fecha DESC"]);
				?>
				<p><?=$inconsistencia["descripcion"]?></p>
				<p>Equipajes en alerta: <br><?=$inconsistencia["detalle"]?></p>
				<p>Usuario: <br><?=nombreUsuario($db, $inconsistencia["id_usuario"])?></p>
				<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cerrar</a>
			</div>
		</div>
<?php
	}
}
?>
	</tbody>
</table>
<?php
function estatusVuelo( $estatus ) {
	if ( $estatus == 1 ) {
		return "Abierto";
	} else {
		return "Cerrado";
	}
}
function nombreUsuario( $db, $id ) {
	$datos = $db->get("usuarios", "*", ["id" => $id]);
	return $datos["nombre"];
}
?>

