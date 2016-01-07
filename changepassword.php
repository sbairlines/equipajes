<?php session_start();?>
<?php
$mantenimiento = false;
if ( $mantenimiento ) {
	header("location: mantenimiento/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Equipajes :: SBA AIRLINES</title>
    <link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="_assets/css/jqm-demos.css">
    <link rel="stylesheet" href="_assets/css/bartag.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="js/jquery.js"></script>
    <script src="_assets/js/index.js"></script>
    <script src="js/jquery.mobile-1.4.5.min.js"></script>
    <script src="js/functions.js"></script>
</head>
<body>
<div data-role="page" class="jqm-demos" data-quicklinks="false">

    <div data-role="header" class="jqm-header">
		<h2><a href="#" title="SbAirlines"><img src="_assets/img/sba-logo.jpg" alt="SbAirlines"></a></h2>
        
	</div><!-- /header -->

    <div role="main" class="ui-content jqm-content">

        <h1>Sistema de Control de Equipajes</h1>

        <h2>Cambio de Contraseña</h2>
		
        <div data-demo-html="true">
	        <form class="frm" method="post" data-ajax="false" action="lib/login.php?t=changepass">
				<label for="text-1">Nueva Clave:</label>
				<input type="password" name="password" id="password" value="">
				
				<label for="text-3">Nueva Clave (Repetir):</label>
				<input type="password" name="repassword" id="txtPass" value="">
				<?php
				$e = isset($_GET["e"])?$_GET["e"]:"";
				if ( $e == 1 ) { // Las claves no coinciden
					echo "<h3>Las claves no coinciden.</h3>";
				}
				?>
				<input type="submit" class="ui-btn ui-btn-inline" value="Aceptar" />
	        </form>
        </div><!-- /demo-html -->


	</div><!-- /content -->
	    

	<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="jqm-footer">
		<p>Copyright 2015 Santa Barbara Airlines C.A
		<p>Desarrollado por: Grupo Ximplex C.A.</p>
	</div><!-- /footer -->
	<!-- TODO: This should become an external panel so we can add input to markup (unique ID) -->
  

</div><!-- /page -->

</body>
</html>
