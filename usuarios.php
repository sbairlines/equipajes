<?php
$datos = $db->select("usuarios", "*");
?>
<h2>Usuarios</h2>
<fieldset data-role="controlgroup" data-type="horizontal">
	<legend>Acciones:</legend>
	<a href="home.php?s=crearUsuario" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right">Nuevo</a>
</fieldset>
<div data-demo-html="true">
	<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
		<thead>
			<tr>
				<th>Usuario</th>
				<th>Nombre</th>
				<th>Estatus</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $datos as $reg ) {
			?>
			<tr>
				<td><a data-ajax="false" href="home.php?s=crearUsuario&id=<?=$reg["id"];?>"><?=$reg["login"];?></a></td>
				<td><?=$reg["nombre"];?></td>
				<td><?=nombreEstatus($reg["estatus"]);?></td>
				<td><a data-ajax="false" href="verhoja.php?id=<?=$reg["id"];?>">Ver&nbsp;hoja</td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

<?php
function nombreSitio($db, $id) {
	$data = $db->get("sitios", "*", ["id" => $id]);
	return $data["nombre"];
}
function nombreEstatus($id) {
	if ($id == 0 ) {
		return "Activo";
	} else if ($id == 1 ) {
		return "Espera cambio clave";
	} else if ($id == 2 ) {
		return "Inactivo";
	}
}

?>


<script type="text/javascript">
$(document).ready(function(){
	
});
</script>
