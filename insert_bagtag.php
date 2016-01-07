<?php
/*$datos = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt1" => $_SESSION["usuario"]["id"], "id" => $_GET["control"]]]);
if (count($datos)>0){ $_SESSION["usuario"]["id_punto_control"] = 1; }
$datos = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt2" => $_SESSION["usuario"]["id"], "id" => $_GET["control"]]]);
if (count($datos)>0){ $_SESSION["usuario"]["id_punto_control"] = 2; }
$datos = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt3" => $_SESSION["usuario"]["id"], "id" => $_GET["control"]]]);
if (count($datos)>0){ $_SESSION["usuario"]["id_punto_control"] = 3; }*/


$datos = $db->query("SELECT COUNT(*) AS cantMaletas FROM detalle_equipaje WHERE id_control = '" . $_GET["control"] . "' AND id_punto_control = '" . $_SESSION["usuario"]["id_punto_control"] . "'")->fetchAll();
?>
<p><h2>Punto de Control: <?=nombrePuntoControl($db, $_SESSION["usuario"]["id_punto_control"]);?></h2></p>
<fieldset data-role="controlgroup" data-type="horizontal">
    <button class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$_GET["id"];?></button>
    <button class="ui-shadow ui-btn ui-corner-all ui-icon-check ui-btn-icon-right" id="cantMaletas"><?=$datos[0]["cantMaletas"];?></button>
</fieldset>
    
<div data-demo-html="true">
    	<input type="hidden" name="txtVuelo" id="txtVuelo" value="<?=$_GET["id"];?>">
    	<input type="hidden" name="txtIdUsuario" id="txtIdUsuario" value="<?=$_SESSION["usuario"]["id"];?>">
		<input type="hidden" name="txtIdPuntocontrol" id="txtIdPuntocontrol" value="<?=$_SESSION["usuario"]["id_punto_control"];?>">
		<input type="hidden" name="txtIdControl" id="txtIdControl" value="<?=$_GET["control"];?>">
		<?php
		if ( PermisoDescripcionIata()) {
			$cerradoCounter = $db->count("detalle_equipaje", "estatus", ["AND" => ["id_punto_control" => 1, "id_control" => $_GET["control"], "estatus" => 0]]);
			if ( $cerradoCounter  > 0 ) {
		?>
			<h2>Este punto se encuentra cerrado para este vuelo.</h2>
		<?php		
			} else {
		?>
		<form class="frm" id="frmBagTag" method="post" data-ajax="false" action="lib/insert_bagtag.php?step=1&id=<?=$_GET["id"];?>&control=<?=$_GET["control"]?>">
			<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
				<thead>
					<tr>
						<th>BagTag</th>
						<th>Color</th>
						<th>Tipo</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$y = 1;
					for ( $x=0;$x<10;$x++ ) {
					?>	
						<tr>
							<td><input name="txtBagTag[<?=$x?>]" id="txtBagTag<?=$x?>" tabindex="<?=$y++?>" type="text" maxlength="12" class="txtInput grande" value=""></td>
							<td><input name="txtColor[<?=$x?>]" id="txtColor<?=$x?>" tabindex="<?=$y++?>" type="text" maxlength="3" class="txtInput" value=""></td>
							<td><input name="txtTipo[<?=$x?>]" id="txtTipo<?=$x?>" tabindex="<?=$y++?>" type="text" maxlength="3" class="txtInput" value=""></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<input type="button" tabindex="31" class="ui-btn ui-btn-inline" id="sbtnCargaDatosTodos" value="Enviar" />
			
			<?php
			if ( $datos[0]["cantMaletas"] > 0 ) {
			?>
			<a href="#popupCerrarCounter" data-rel="popup" data-position-to="window" data-transition="pop" style="text-decoration: none;"><input type="button" class="ui-btn ui-btn-inline btnRojo" id="btnCerrarCounter" value="Cerrar Counter" /></a>
			<?php
			}
			?>
			<div data-role="popup" id="popupCerrarCounter" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
				<div data-role="header" data-theme="b">
				<h1>Cierre Counter</h1>
				</div>
				<div role="main" class="ui-content">
					<h3 class="ui-title">Equipajes en Counter: <?=$datos[0]["cantMaletas"];?></h3>
					<p>Esta seguro de cerrar el vuelo?</p>
					<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">No, aun no.</a>
					<a data-ajax="false"  href="lib/insert_bagtag.php?step=4&id=<?=$_GET["id"];?>&control=<?=$_GET["control"]?>&id_punto_control=1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">Si, Cerrar.</a>
				</div>
			</div>
		</form>
		<?php
			}
		}
		if ( PermisoCorrea() ) {
			$cerradoCorrea = $db->count("detalle_equipaje", "estatus", ["AND" => ["id_punto_control" => 2, "id_control" => $_GET["control"], "estatus" => 0]]);
			if ( $cerradoCorrea  > 0 ) {
		?>
			<h2>Este punto se encuentra cerrado para este vuelo.</h2>
		<?php		
			} else {
		?>
		<form class="frm" method="post" data-ajax="false" action="lib/insert_bagtag.php?step=2&id=<?=$_GET["id"];?>&control=<?=$_GET["control"]?>">
			<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
				<thead>
					<tr>
						<th>BarTag</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><textarea name="txtBagTag" id="txtBagTag" cols="20" rows="10"></textarea></td>
					</tr>
				</tbody>
			</table>
			<input type="submit" class="ui-btn ui-btn-inline" id="btnCargaDatosTodos2" value="Enviar" />
			
			<?php
			if ( $datos[0]["cantMaletas"] > 0 ) {
			?>
			<a href="#popupCerrarCorrea" data-rel="popup" data-position-to="window" data-transition="pop" style="text-decoration: none;"><input type="button" class="ui-btn ui-btn-inline btnRojo" id="btnCerrarCorrea" value="Cerrar Correa" /></a>
			<?php
			}
			?>
			<div data-role="popup" id="popupCerrarCorrea" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
				<div data-role="header" data-theme="b">
				<h1>Cierre Correa</h1>
				</div>
				<?php
				$equipajeCounter = $db->count("detalle_equipaje", "*", ["AND" => ["id_punto_control" => 1, "id_control" => $_GET["control"]]]);
				?>
				<div role="main" class="ui-content">
					<h3 class="ui-title">Equipajes en Counter: <?=$equipajeCounter;?></h3>
					<h3 class="ui-title">Equipajes en Correa: <?=$datos[0]["cantMaletas"];?></h3>
					<?php
					if ( $equipajeCounter == $datos[0]["cantMaletas"] ) { //VERIFICA SI HAY INCONSISTENCIAS
						$textoBotonNo = "No, aun no.";
					?>
						<p>Esta seguro de cerrar el vuelo?</p>
						<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back"><?=$textoBotonNo;?></a>
					<?php
					} else {
						$textoBotonNo = "Corregir";
					?>
						<p>Existen inconsistencias... Desea cerrar el vuelo?</p>
						<a data-ajax="false"  href="lib/insert_bagtag.php?step=10&id=<?=$_GET["id"];?>&control=<?=$_GET["control"]?>&id_punto_control=2" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b"><?=$textoBotonNo;?></a>
					<?php
					}
					?>
					<a data-ajax="false"  href="lib/insert_bagtag.php?step=4&id=<?=$_GET["id"];?>&control=<?=$_GET["control"]?>&id_punto_control=2" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">Si, Cerrar.</a>
				</div>
			</div>
		</form>
		<?php
			}
		} if ( PermisoDqf() ) {
		$cerradoAvion= $db->count("detalle_equipaje", "estatus", ["AND" => ["id_punto_control" => 3, "id_control" => $_GET["control"], "estatus" => 0]]);
			if ( $cerradoAvion > 0 ) {
		?>
			<h2>Este punto se encuentra cerrado para este vuelo.</h2>
		<?php		
			} else {
		?>
		<form class="frm" method="post" data-ajax="false" action="lib/insert_bagtag.php?step=3&id=<?=$_GET["id"];?>&control=<?=$_GET["control"]?>">
			<table data-role="table" id="table-column-toggle" data-mode="" class="ui-responsive table-stroke">
				<tbody>
					<tr>
						<th>Dqf</th>
					</tr>
					<?php
					$dqf = isset($_GET["dqf"])?$_GET["dqf"]:"";
					?>
					<tr>
						<td><input name="txtDqf" id="txtDqf" type="text" tabindex="0" maxlength="12" class="txtDqf" value="<?=$dqf;?>"></td>
					</tr>
					<tr>
						<th>BarTag</th>
					</tr>
					<tr>
						<td><textarea name="txtBagTag" id="txtBagTag" cols="20" rows="10"></textarea></td>
					</tr>
				</tbody>
			</table>
			<input type="submit" class="ui-btn ui-btn-inline" id="btnCargaDatosTodos3" value="Enviar" />
			
			<?php
			if ( $datos[0]["cantMaletas"] > 0 ) {
			?>
				<a href="#popupCerrarAvion" data-rel="popup" data-position-to="window" data-transition="pop" style="text-decoration: none;"><input type="button" class="ui-btn ui-btn-inline btnRojo" id="btnCerrarCorrea" value="Cerrar Avion/RX" /></a>
			<?php
			}
			?>
			<div data-role="popup" id="popupCerrarAvion" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
				<div data-role="header" data-theme="b">
				<h1>Cierre Avion/RX</h1>
				</div>
				<?php
				//$equipajeCounter = $db->count("detalle_equipaje", "*", ["AND" => ["id_punto_control" => 1, "id_control" => $_GET["control"]]]);
				$equipajeCorrea = $db->count("detalle_equipaje", "*", ["AND" => ["id_punto_control" => 2, "id_control" => $_GET["control"]]]);
				?>
				<div role="main" class="ui-content">
					<h3 class="ui-title">Equipajes en Correa: <?=$equipajeCorrea;?></h3>
					<h3 class="ui-title">Equipajes en Avion/RX: <?=$datos[0]["cantMaletas"];?></h3>
					<?php
					if ( $equipajeCorrea == $datos[0]["cantMaletas"] ) { //VERIFICA SI HAY INCONSISTENCIAS
						$textoBotonNo = "No, aun no.";
					?>
						<p>Esta seguro de cerrar el vuelo?</p>
					<?php
					} else {
						$textoBotonNo = "Corregir.";
					?>
						<p>Existen inconsistencias... Desea cerrar el vuelo?</p>
					<?php
					}
					?>
					<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back"><?=$textoBotonNo;?></a>
					<a data-ajax="false"  href="lib/insert_bagtag.php?step=4&id=<?=$_GET["id"];?>&control=<?=$_GET["control"]?>&id_punto_control=3" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">Si, Cerrar.</a>
				</div>
			</div>
		</form>
		<?php
			}
		}
		?>
</div>

<?php
function PermisoDescripcionIata() {
	if ( $_SESSION["usuario"]["id_punto_control"] == 1 ) {
		return true;	
	} else {
		return false;
	}
}
function PermisoCorrea() {
	if ( $_SESSION["usuario"]["id_punto_control"] == 2 ) {
		return true;	
	} else {
		return false;
	}
}
function PermisoDqf() {
	if ( $_SESSION["usuario"]["id_punto_control"] == 3 ) {
		return true;	
	} else {
		return false;
	}
}
function nombrePuntoControl($db, $id_punto_control) {
	$datos = $db->get("puntos_controles", "*", ["id" => $id_punto_control]);
	return $datos["nombre"];
}
?>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#txtBagTag0').focus();
	
	$( "#txtTipo9" ).on( "keydown", function(event) {
      if(event.which == 13) 
         $("#frmBagTag").submit();
    });
	
	$("#sbtnCargaDatosTodos").bind("click", function(){
		$("#frmBagTag").submit();
	});
	
	$('.txtInput').keypress(function(e){
		if(e.which == 13) {
        	cb = parseInt( $(this).attr('tabindex') );
        	$(':input[tabindex=\'' + (cb + 1) + '\']').focus();
			$(':input[tabindex=\'' + (cb + 1) + '\']').select();
    	}
	});
	
	$('#btnCerrarCounter').bind('click', function() {
		
	});
});
</script>
	
