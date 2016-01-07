<?php
$id = isset($_GET["id"])?$_GET["id"]:"";
if ($id != "") {
	$reg = $db->get("usuarios", "*", ["id" => $id]);
}
?>
<h2>Creacion de usuarios</h2>
<div data-demo-html="true">
    <form class="frm" data-ajax="false" method="post" action="lib/usuarios.php">
		<input type="hidden" name="txtIdUsuario" id="txtIdUsuario" value="<?=$_SESSION["usuario"]["id"];?>">
		<input type="hidden" name="txtId" value="<?=$reg["id"];?>">
		<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
			<tbody>
				<tr>
					<td>Codigo Trabajador:</td>
					<td><input name="txtCodTrabajador" id="txtCodTrabajador" type="text" tabindex="0" value="<?=$reg["cod_trabajador"];?>"></td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td><input name="txtNombre" id="txtNombre" type="text" tabindex="1" value="<?=$reg["nombre"];?>"></td>
				</tr>
				<tr>
					<td>Login:</td>
					<td><input name="txtLogin" id="txtLogin" type="text" tabindex="2" value="<?=$reg["login"];?>"></td>
				</tr>
				<tr>
					<td>Clave:</td>
					<td><input name="txtClave" id="txtClave" type="password" tabindex="3" value="<?=$reg["clave"];?>"></td>
				</tr>
				<tr>
					<td>Re-Clave:</td>
					<td><input name="txtClave2" id="txtClave2" type="password" tabindex="4" value="<?=$reg["clave"];?>"></td>
				</tr>
				<tr>
					<?php
					$datos = $db->select("sitios", "*");
					?>
					<td>Sitio:</td>
					<td>
						<select name="cboSitio" tabindex="5">
							<?php
							foreach ( $datos as $row ) {
							?>
							<option <?=($reg["id_sitio"]==$row["id"])?"selected":"";?> value="<?=$row["id"];?>"><?=$row["nombre"];?></option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tipo:</td>
					<td>
						<select name="cboTipo" tabindex="6">
							<option <?=($reg["tipo"]==0)?"selected":"";?> value="0">Usuario</option>
							<option <?=($reg["tipo"]==1)?"selected":"";?> value="1">Administrador</option>
						</select>
					</td>
				</tr>
				<?php
				if ($id != "") {
				?>
				<tr>
					<td>Estatus:</td>
					<td>
						<select name="cboEstatus" tabindex="7">
							<option <?=($reg["estatus"]==0)?"selected":"";?> value="1">Activo</option>
							<option <?=($reg["estatus"]==1)?"selected":"";?> value="0">Inactivo</option>
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