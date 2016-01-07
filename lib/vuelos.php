<?php
session_cache_expire(10800);
session_start();
include '../includes/db.php';
$id = isset($_POST["txtId"])?$_POST["txtId"]:"";
$datos = $db->query("INSERT INTO vuelos VALUES ('" . $id . "', '" . $_POST["txtVuelo"] . "', '0')
						ON DUPLICATE KEY UPDATE nombre = '" . $_POST["txtVuelo"] . "', estatus = '" . $_POST["cboEstatus"] . "'");
header("location: ../home.php?s=vuelos");
?>