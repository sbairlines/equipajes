<?php
$datos = $db->select("vuelos", "*", ["ORDER" => "estatus"]);
?>
<h2>Vuelos</h2>
<fieldset data-role="controlgroup" data-type="horizontal">
	<legend>Acciones:</legend>
	<a href="home.php?s=crearVuelo" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right">Nuevo</a>
</fieldset>
<div data-demo-html="true">
	<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
		<thead>
			<tr>
				<th>Vuelo</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $datos as $reg ) {
			?>
			<tr>
				<td><a data-ajax="false" href="home.php?s=crearVuelo&id=<?=$reg["id"];?>"><?=$reg["nombre"];?></a></td>
				<td><?=nombreEstatus($reg["estatus"]);?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

<?php
function nombreEstatus($id) {
	if ($id == 0 ) {
		return "Activo";
	} else if ($id == 1 ) {
		return "Inactivo";
	}
}
?>