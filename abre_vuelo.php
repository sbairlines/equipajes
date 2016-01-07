
<h1>Sistema de Control de Equipajes</h1>
<h2>Abrir Vuelo</h2>

<label for="select-choice-1" class="select">Seleccione un vuelo</label>
<?php
$datos = $db->query("SELECT * FROM vuelos WHERE estatus = 0 AND nombre NOT IN (SELECT vuelo FROM control_equipaje WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "')")->fetchAll();
?>
<?php
$e = isset($_GET["e"])?$_GET["e"]:"";
if ( $e == 2 ) { 
	echo "<h3>Debe seleccionar el vuelo que desea abrir.</h3>";
} else if ( $e == 3 ) { 
	echo "<h3>Debe introducir el numero de vuelo.</h3>";
} else if ( $e == 4 ) { 
	echo "<h3>Ocurrio un error, por favor intentelo nuevamente.</h3>";
} else if ( $e == 5 ) { 
	echo "<h3>El vuelo que intenta crear ya existe.</h3>";
} 
?>
<form class="frm" action="lib/abre_vuelo.php" data-ajax="false" method="post">
	
	<select name="cboVuelo" id="cboVuelo">
		<option value="%">-- Seleccione --</option>
		<?php
		foreach ( $datos as $reg ) {
		?>
	    	<option value="<?=$reg["nombre"];?>"><?=$reg["nombre"];?></option>
	    <?php
		}
		?>
		<option value="0">Otro</option>
	</select>

	<label for="txtNombreVuelo" id="lblNombreVuelo" style="display: none;">Indique el Nro. de Vuelo:</label>
	<input name="txtNombreVuelo" id="txtNombreVuelo" value="" type="number" style="display:none;">
	
	<label for="chkDqf" id="lblDqf">DQF?</label>
	<input type="checkbox" name="chkDqf" id="chkDqf" value="1" />
	
	<label>Usuario (Counter):</label>
	<select name="cboIdUsuarioPt1">
		<option value="%">-- Seleccione --</option>
		<?php
		$datas = $db->select("usuarios", "*", ["estatus" => 0]);
		foreach ($datas as $data) {
		?>
			<option value="<?=$data["id"]?>"><?=$data["nombre"]?></option>
		<?php	
		}
		?>
	</select>
	<label>Usuario (Correa):</label>
	<select name="cboIdUsuarioPt2">
		<option value="%">-- Seleccione --</option>
		<?php
		$datas = $db->select("usuarios", "*", ["estatus" => 0]);
		foreach ($datas as $data) {
		?>
			<option value="<?=$data["id"]?>"><?=$data["nombre"]?></option>
		<?php	
		}
		?>
	</select>
	<label>Usuario (Avion/RX):</label>
	<select name="cboIdUsuarioPt3">
		<option value="%">-- Seleccione --</option>
		<?php
		$datas = $db->select("usuarios", "*", ["estatus" => 0]);
		foreach ($datas as $data) {
		?>
			<option value="<?=$data["id"]?>"><?=$data["nombre"]?></option>
		<?php	
		}
		?>
	</select>
	
	<input type="submit" class="ui-btn ui-btn-inline" value="Aceptar" />
</form>
