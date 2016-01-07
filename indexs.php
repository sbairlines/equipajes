<?php
switch ($_GET["s"]) {
	case "principal":
		include "principal.php";
	break;
	case "open_flight":
		include "abre_vuelo.php";
	break;
	case "bagtag":
		include "insert_bagtag.php";
	break;
	case "estatus_vuelo":
		include "rpt_estatus_vuelo.php";
	break;
	case "verificar_vuelo":
		include "verificar_vuelo.php";
	break;
	case "usuarios":
		include "usuarios.php";
	break;
	case "crearUsuario":
		include "cusuarios.php";
	break;
	case "vuelos":
		include "vuelos.php";
	break;
	case "crearVuelo":
		include "cvuelos.php";
	break;
	case "reporte_diario":
		include "rpt_diario.php";
	break;
}

?>
