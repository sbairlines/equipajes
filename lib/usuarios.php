<?php
session_cache_expire(10800);
session_start();
include '../includes/db.php';
$id = isset($_POST["txtId"])?$_POST["txtId"]:"";
$datos = $db->query("INSERT INTO usuarios VALUES ('" . $id . "', '" . $_POST["txtCodTrabajador"] . "', '" . $_POST["cboSitio"] . "', '" . $_POST["txtNombre"] . "', '" . $_POST["txtLogin"] . "', '" . $_POST["txtClave"] . "', '" . $_POST["cboTipo"] . "', '1')
						ON DUPLICATE KEY UPDATE cod_trabajador = '" . $_POST["txtCodTrabajador"] . "', id_sitio = '" . $_POST["cboSitio"] . "', nombre = '" . $_POST["txtNombre"] . "', login = '" . $_POST["txtLogin"] . "', clave = '" . $_POST["txtClave"] . "', tipo = '" . $_POST["cboTipo"] . "', estatus = '" . $_POST["cboEstatus"] . "'");
header("location: ../home.php?s=usuarios");
?>