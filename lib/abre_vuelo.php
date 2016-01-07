<?php
session_cache_expire(10800);
session_start();
include '../includes/db.php';
if ( $_POST["cboVuelo"] == "%" ) { //NO SELECCIONO NINGUN VUELO
		echo 2; //FALTO ESCOJER VUELO
	} else if ( ( $_POST["cboVuelo"] == 0 ) && ( $_POST["txtNombreVuelo"] == "" ) ) {
		echo 3; //FALTO EL NUMERO DE VUELO PERIODICO
	} else {
		$datos = $db->query("SELECT * FROM control_equipaje WHERE vuelo = '" . $_POST["cboVuelo"] . "' AND DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "'")->fetchAll();
		
		if ( count($datos) > 0 ) {
			echo 5;
		} else {
			if ( ( $_POST["cboVuelo"] == 0 ) && ( $_POST["txtNombreVuelo"] != "" ) ) {
				$vuelo = $_POST["txtNombreVuelo"]; 
			} else {
				$vuelo = $_POST["cboVuelo"]; 
			}
			$dqf = isset($_POST["chkDqf"])?$_POST["chkDqf"]:0;
			$datos = $db->insert("control_equipaje", 
												[
												"vuelo" => $vuelo,
												"dqf" => $dqf,
												"#fecha" => "NOW()",
												"id_usuario_pt1" => $_POST["cboIdUsuarioPt1"],
												"id_usuario_pt2" => $_POST["cboIdUsuarioPt2"],
												"id_usuario_pt3" => $_POST["cboIdUsuarioPt3"],
												"id_usuario" => $_SESSION["usuario"]["id"]
												]);
			header("location: ../home.php?s=principal");
		}
	}

?>