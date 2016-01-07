<?php
session_cache_expire(10800);
session_start();
include '../includes/db.php';
if ( isset( $_GET["t"] ) ) {
	if ( $_POST["password"] == $_POST["repassword"] ) {
		$data = $db->update("usuarios", ["estatus" => 0, "clave" => $_POST["password"]], ["id" => $_SESSION["usuario"]["id"]]);
		header("location: ../home.php?s=principal");
	} else {
		header("location: ../changepassword.php?e=1");
	}
} else {
	if ( isset( $_POST["username"] )) {
		$datos = explode('-', $_POST["username"]);
		$datas = $db->select("usuarios", "*", ["AND" => ["id" => $datos[0], "cod_trabajador" => $datos[1]]]);
		if ( count( $datas ) ) {
			$_SESSION["usuario"]["id"] = $datas[0]["id"];
			$_SESSION["usuario"]["id_sitio"] = $datas[0]["id_sitio"];
			$_SESSION["usuario"]["nombre"] = $datas[0]["nombre"];
			$_SESSION["usuario"]["login"] = $datas[0]["login"];
			$_SESSION["usuario"]["tipo"] = $datas[0]["tipo"];
			$_SESSION["usuario"]["estatus"] = $datas[0]["estatus"];
						
			if ( $_SESSION["usuario"]["estatus"] == 0 ) {//LOGIN
				header("location: ../home.php?s=principal");
			} elseif ( $_SESSION["usuario"]["estatus"] == 1 ) {//OBLIGAR AL CAMBIO DE CLAVE
				header("location: ../changepassword.php");
			} elseif ( $_SESSION["usuario"]["estatus"] == 2 ) {//USUARIO INACTIVO
				header("location: ../index.php?e=2");
			}
		} else {
			header("location: ../index.php?e=1");//LOGIN FALLIDO
		}
	} else {
		header("location: ../index.php?e=3");//LOGIN FALLIDO
	}
}
?>