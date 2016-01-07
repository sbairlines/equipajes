<h1>Sistema de Control de Equipajes</h1>

<h2>Bienvenido <?=$_SESSION["usuario"]["nombre"];?></h2>

<?php
$datos = $db->select("SELECT * FROM puntos_controles WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '" . date('Y-m-d') . "'")->fetchAll();
?>
<fieldset data-role="controlgroup" data-type="horizontal">
	<legend>Selecione el punto de control:</legend>
<?php
foreach ( $datos as $reg ) {
?>
    <a href="home.php?s=bagtag&id=<?=$reg["vuelo"];?>&control=<?=$reg["id"];?>" class="ui-shadow ui-btn ui-corner-all ui-icon-tag ui-btn-icon-right"><?=$reg["vuelo"];?></a>
<?php
}
?>
</fieldset>