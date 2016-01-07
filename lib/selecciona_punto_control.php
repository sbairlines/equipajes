<?php
session_cache_expire(10800);
session_start();
$_SESSION["usuario"]["id_punto_control"] = $_GET["punto_control"];
header("location: ../home.php?s=bagtag&id=" . $_GET["id"] . "&control=" . $_GET["control"]);
?>