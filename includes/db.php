<?php
include 'medoo.php';
$db = new medoo([
// required
	'database_type' => 'mysql',
	'database_name' => 'equipajev2',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	 
	// optional
	'port' => 3306,
	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [ PDO::ATTR_CASE => PDO::CASE_NATURAL]
]);
?>