<?php
session_cache_expire(10800);
session_start();
if (!isset($_SESSION["usuario"]["id"])){
	echo "0";
} else {
	echo "1";
}
?>