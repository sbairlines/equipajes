<h2>Control de Equipajes</h2>

<h2>Sr(a) <?=$_SESSION["usuario"]["nombre"];?></h2>

<?php
$datos = $db->query("SELECT * FROM control_equipaje 
						WHERE 
							DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "'
						AND 
						( id_usuario_pt1 = " . $_SESSION["usuario"]["id"] . "
						OR id_usuario_pt2 = " . $_SESSION["usuario"]["id"] . "
						OR id_usuario_pt3 = " . $_SESSION["usuario"]["id"] .")")->fetchAll();
?>
<fieldset data-role="controlgroup" data-type="horizontal">
	<legend>Selecione el vuelo:</legend>
<?php
foreach ( $datos as $reg ) {
	$contarPuntosControl = $db->query("SELECT * FROM control_equipaje WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "' AND id_usuario_pt1 = " . $_SESSION["usuario"]["id"] . " AND vuelo = '" . $reg["vuelo"] . "'
										UNION ALL
										SELECT * FROM control_equipaje WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "' AND id_usuario_pt2 = " . $_SESSION["usuario"]["id"] . " AND vuelo = '" . $reg["vuelo"] . "'
										UNION ALL
										SELECT * FROM control_equipaje WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "' AND id_usuario_pt3 = " . $_SESSION["usuario"]["id"] . " AND vuelo = '" . $reg["vuelo"] . "'")->fetchAll();
	if ( count($contarPuntosControl) > 1 ) {
?>
	<a href="#popupPuntoControl<?=$reg["id"];?>" data-rel="popup" data-position-to="window" data-transition="pop" style="text-decoration: none;" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$reg["vuelo"];?></a>
	<div data-role="popup" id="popupPuntoControl<?=$reg["id"];?>" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
		<div data-role="header" data-theme="b">
		<h1>Punto de Control</h1>
		</div>
		<div role="main" class="ui-content">
			<h3 class="ui-title">Seleccione el punto de control.</h3>
			<?php
			$counter = 0; $correa = 0; $avionrx = 0;
			$puntos = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt1" => $_SESSION["usuario"]["id"], "id" => $reg["id"]]]);
			if (count($puntos)>0){ $counter = 1; }
			$puntos = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt2" => $_SESSION["usuario"]["id"], "id" => $reg["id"]]]);
			if (count($puntos)>0){ $correa = 1; }
			$puntos = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt3" => $_SESSION["usuario"]["id"], "id" => $reg["id"]]]);
			if (count($puntos)>0){ $avionrx = 1; }

			if ( $counter == 1 ) {
			?>
				<a data-ajax="false"  href="lib/selecciona_punto_control.php?id=<?=$reg["vuelo"];?>&control=<?=$reg["id"]?>&punto_control=1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">Counter</a>
			<?php
			}if ( $correa == 1 ) {
			?>
				<a data-ajax="false"  href="lib/selecciona_punto_control.php?id=<?=$reg["vuelo"];?>&control=<?=$reg["id"]?>&punto_control=2" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">Correa</a>
			<?php
			}if ( $avionrx == 1 ) {
			?>
				<a data-ajax="false"  href="lib/selecciona_punto_control.php?id=<?=$reg["vuelo"];?>&control=<?=$reg["id"]?>&punto_control=3" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">Avion</a>
			<?php
			}
			?>
			
			
			<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b"  style="background: #C0261C" data-rel="back">No, aun no.</a>
		</div>
	</div>
<?php
	} elseif ( count($contarPuntosControl) == 1 ) {
		$puntoControl = 0;
		$punto = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt1" => $_SESSION["usuario"]["id"], "id" => $reg["id"]]]);
		if (count($punto)>0){ $puntoControl = 1; }
		$punto = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt2" => $_SESSION["usuario"]["id"], "id" => $reg["id"]]]);
		if (count($punto)>0){ $puntoControl = 2; }
		$punto = $db->select("control_equipaje", "*", ["AND" => ["id_usuario_pt3" => $_SESSION["usuario"]["id"], "id" => $reg["id"]]]);
		if (count($punto)>0){ $puntoControl = 2; }
?>
		<a href="lib/selecciona_punto_control.php?id=<?=$reg["vuelo"];?>&control=<?=$reg["id"]?>&punto_control=<?=$puntoControl;?>" data-ajax="false" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$reg["vuelo"];?></a>
<?php
	}
}
?>
</fieldset>