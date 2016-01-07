<?php
session_cache_expire(10800);
session_start();
include '../includes/db.php';
if ( $_GET["step"] == 1 ) { //PASO 1

	foreach ($_POST["txtBagTag"] as $key => $bagTag) {
		if ( $bagTag != "" ) {
			$codIATA = $_POST["txtColor"][$key] . $_POST["txtTipo"][$key];
			$insert = $db->insert("detalle_equipaje", 
												[
												"id_usuario" => $_SESSION["usuario"]["id"],
												"id_punto_control" => $_SESSION["usuario"]["id_punto_control"],
												"id_control" => $_GET["control"],
												"#fecha" => "NOW()",
												"bar_tag" => $bagTag,
												"cod_iata" => $codIATA,
												"leido" => 1,
												"estatus" => 1
												]);
		}
	}
	header("location: ../home.php?s=bagtag&id=" . $_GET["id"] . "&control=" . $_GET["control"]);
	
} elseif ( $_GET["step"] == 2 ) {
	
	$arrayBagTags = explode("\n", $_POST["txtBagTag"]);
	$bagTags1 = array_filter($arrayBagTags);
	$bagTags = array_values($bagTags1);
	$bagTags = $cadena = str_replace("\r\n"," ",$bagTags);
	foreach ( $bagTags as $bagTag ) {
		if ($bagTag != "") {
			$insert = $db->insert("detalle_equipaje", 
										[
										"id_usuario" => $_SESSION["usuario"]["id"],
										"id_punto_control" => $_SESSION["usuario"]["id_punto_control"],
										"id_control" => $_GET["control"],
										"#fecha" => "NOW()",
										"bar_tag" => $bagTag,
										"cod_iata" => "",
										"leido" => 1,
										"estatus" => 1
										]);
		}
	}
	header("location: ../home.php?s=bagtag&id=" . $_GET["id"] . "&control=" . $_GET["control"]);
	
} elseif ( $_GET["step"] == 3 ) {
	
	$arrayBagTags = explode("\n", $_POST["txtBagTag"]);
	$bagTags1 = array_filter($arrayBagTags);
	$bagTags = array_values($bagTags1);
	$Dqf = $_POST["txtDqf"];
	foreach ( $bagTags as $bagTag ) {
		$insert = $db->insert("detalle_equipaje", 
										[
										"id_usuario" => $_SESSION["usuario"]["id"],
										"id_punto_control" => $_SESSION["usuario"]["id_punto_control"],
										"id_control" => $_GET["control"],
										"#fecha" => "NOW()",
										"bar_tag" => $bagTag,
										"dqf" => $Dqf,
										"leido" => 1,
										"estatus" => 1
										]);
	}
	header("location: ../home.php?s=bagtag&id=" . $_GET["id"] . "&control=" . $_GET["control"] . "&dqf=" . $Dqf);
	
} elseif ( $_GET["step"] == 4 ) {
	
	$datos = $db->update("detalle_equipaje", ["estatus" => 0], ["AND" => ["id_punto_control" => $_GET["id_punto_control"], "id_control" => $_GET["control"]]]);
	header("location: insert_bagtag.php?step=10&id=" . $_GET["id"] . "&control=" . $_GET["control"] ."&id_punto_control=" . $_GET["id_punto_control"]);
	
} elseif ( $_GET["step"] == 10 ) {
	
	if ( $_GET["id_punto_control"] == 2 ) { //CORREA
		$equipajeCounter = $db->count("detalle_equipaje", "*", ["AND" => ["id_punto_control" => 1, "id_control" => $_GET["control"]]]);
		$equipajeCorrea = $db->count("detalle_equipaje", "*", ["AND" => ["id_punto_control" => 2, "id_control" => $_GET["control"]]]);
		if ( $equipajeCounter > $equipajeCorrea ) {
			$equipajes = ($equipajeCounter - $equipajeCorrea);
			$descripcion = "Existe una inconsistencia de " . $equipajes . " equipajes faltantes con Counter.";
			$equipajeCounter = $db->select("detalle_equipaje", "bar_tag", ["AND" => ["id_punto_control" => 1, "id_control" => $_GET["control"]]]);
			$equipajeCorrea = $db->select("detalle_equipaje", "bar_tag", ["AND" => ["id_punto_control" => 2, "id_control" => $_GET["control"]]]);
			$detalle = implode("\n", array_diff($equipajeCounter, $equipajeCorrea));
		} elseif ( $equipajeCounter < $equipajeCorrea ) {
			$equipajes = ($equipajeCorrea - $equipajeCounter);
			$descripcion = "Existe una inconsistencia de " . $equipajes . " equipajes sobrantes con Counter.";
			$equipajeCounter = $db->select("detalle_equipaje", "bar_tag", ["AND" => ["id_punto_control" => 1, "id_control" => $_GET["control"]]]);
			$equipajeCorrea = $db->select("detalle_equipaje", "bar_tag", ["AND" => ["id_punto_control" => 2, "id_control" => $_GET["control"]]]);
			$detalle = implode("\n", array_diff($equipajeCounter, $equipajeCorrea));
		}
		$inconsistencia = $db->insert("inconsistencias", 
											[
											"vuelo" => $_GET["id"],
											"id_control" => $_GET["control"],
											"id_punto_control" => $_GET["id_punto_control"],
											"id_usuario" => $_SESSION["usuario"]["id"],
											"#fecha" => "NOW()",
											"descripcion" => $descripcion,
											"detalle" => $detalle
											]);
	}
	header("location: ../home.php?s=bagtag&id=" . $_GET["id"] . "&control=" . $_GET["control"]);
	
}
?>