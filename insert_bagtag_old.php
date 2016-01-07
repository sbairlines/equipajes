<?php
$strSql = "SELECT COUNT(*) AS cantMaletas FROM detalle_equipaje WHERE id_control = '" . $_GET["control"] . "' AND id_punto_control = '" . $_SESSION["usuario"]["id_punto_control"] . "'";
$datos = mysql_query($strSql);
$reg = mysql_fetch_array($datos);
?>
<fieldset data-role="controlgroup" data-type="horizontal">
    <button class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$_GET["id"];?></button>
    <div id="cantMaletas"><?=$reg["cantMaletas"];?></div>
</fieldset>
    
<div data-demo-html="true">
    <form class="frm" method="post">
    	<?php
    	//unset($_SESSION["Sql"]);
		//unset($_SESSION["datos"]);
    	?>
    	<input type="hidden" name="txtVuelo" id="txtVuelo" value="<?=$_GET["id"];?>">
    	<input type="hidden" name="txtIdUsuario" id="txtIdUsuario" value="<?=$_SESSION["usuario"]["id_usuario"];?>">
		<input type="hidden" name="txtIdPuntocontrol" id="txtIdPuntocontrol" value="<?=$_SESSION["usuario"]["id_punto_control"];?>">
		<input type="hidden" name="txtIdControl" id="txtIdControl" value="<?=$_GET["control"];?>">
		
		<label for="text-1">BarTag:</label>
		<input type="text" name="txtBarTag" maxlength="10" id="txtBarTag" value="">		
		<?php
		echo $_SESSION["usuario"]["id_punto_control"];
		if ( $_SESSION["usuario"]["id_punto_control"] == 1 ) {
		?>
		<label for="text-1">Descripcion IATA:</label>
		<input type="text" name="txtCodIata" maxlength="4" id="txtCodIata" value="">
		<?php
		}
		?>
		<input type="button" class="ui-btn ui-btn-inline" id="btnCargaDatosTodos" value="Enviar Todos" />
	</form>
</div>
