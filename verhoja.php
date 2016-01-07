<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Equipajes :: SBA AIRLINES</title>
    <link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="_assets/css/jqm-demos.css">
	<?php
	include 'includes/db.php';
	$dato = $db->get("usuarios", "*", ["id" => $_GET["id"]]);
	$text = $dato["id"]."-".$dato["cod_trabajador"];
	?>
	
	<table border="0" width="100%" cellpadding="25" cellspacing="0">
		<tr>
			<td colspan="2"></td>
			<td><?=$dato["nombre"]?></td>
			<td colspan="2"><img src="http://www.barcodesinc.com/generator/image.php?code=<?=$text;?>&style=68&type=C39&width=140&height=70&xres=1&font=3" alt="<?=$dato["nombre"]?>" border="0"></td>
			<td></td>
		</tr>
		<tr>
			<td><img src="barcodes/wt.jpg"></td>
			<td><img src="barcodes/bk.jpg"></td>
			<td><img src="barcodes/gy.jpg"></td>
			<td><img src="barcodes/bu.jpg"></td>
			<td><img src="barcodes/pu.jpg"></td>
			<td><img src="barcodes/rd.jpg"></td>
		</tr>
		<tr>
			<td><img src="barcodes/01.jpg"></td>
			<td><img src="barcodes/02.jpg"></td>
			<td><img src="barcodes/03.jpg"></td>
			<td><img src="barcodes/05.jpg"></td>
			<td><img src="barcodes/06.jpg"></td>
			<td><img src="barcodes/07.jpg"></td>
		</tr>
		<tr>
			<td><img src="barcodes/08.jpg"></td>
			<td><img src="barcodes/09.jpg"></td>
			<td><img src="barcodes/10.jpg"></td>
			<td><img src="barcodes/12.jpg"></td>
			<td><img src="barcodes/20.jpg"></td>
			<td><img src="barcodes/22.jpg"></td>
		</tr>
		<tr>
			<td><img src="barcodes/22d.jpg"></td>
			<td><img src="barcodes/22r.jpg"></td>
			<td><img src="barcodes/23.jpg"></td>
			<td><img src="barcodes/25.jpg"></td>
			<td><img src="barcodes/26.jpg"></td>
			<td></td>
		</tr>
	</table>
</head>
</html>