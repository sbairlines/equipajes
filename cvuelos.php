<?php
$id = isset($_GET["id"])?$_GET["id"]:"";
if ($id != "") {
	$reg = $db->get("vuelos", "*", ["id" => $id]);
}
?>
<h2>Creacion de vuelos</h2>
<div data-demo-html="true">
    <form class="frm" data-ajax="false" method="post" action="lib/vuelos.php">
		<input type="hidden" name="txtId" value="<?=$reg["id"];?>">
		<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
			<tbody>
				<tr>
					<td>Nro. de Vuelo:</td>
					<td><input name="txtVuelo" id="txtVuelo" type="text" tabindex="0" value="<?=$reg["nombre"];?>"></td>
				</tr>
				<?php
				if ($id != "") {
				?>
				<tr>
					<td>Estatus:</td>
					<td>
						<select name="cboEstatus" tabindex="7">
							<option <?=($reg["estatus"]==0)?"selected":"";?> value="0">Activo</option>
							<option <?=($reg["estatus"]==1)?"selected":"";?> value="1">Inactivo</option>
						</select>
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<input data-ajax="false" type="submit" class="ui-btn ui-btn-inline" value="Crear" />
	</form>
</div>