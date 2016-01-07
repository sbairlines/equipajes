<?php 
session_cache_expire(10800);
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Equipajes :: SBA AIRLINES</title>
    <link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="_assets/css/jqm-demos.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">-->
    <script src="js/jquery.min.js"></script>
    <script src="_assets/js/index.js"></script>
    <script src="js/jquery.mobile-1.4.5.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/validar_session.js"></script>
</head>
<body>
<div data-role="page" class="jqm-demos" data-quicklinks="false">

    <div data-role="header" class="jqm-header">
		<h2><a href="#" title="SbAirlines"><img src="_assets/img/sba-logo.jpg" alt="SbAirlines"></a></h2>
        <a href="#" class="jqm-navmenu-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-bars ui-nodisc-icon ui-alt-icon ui-btn-left">Menu</a>
	</div><!-- /header -->

    <div role="main" class="ui-content jqm-content">

        <?php
        include 'includes/db.php';
        include 'indexs.php';
        ?>

	</div><!-- /content -->
	    <div data-role="panel" class="jqm-navmenu-panel" data-position="left" data-display="overlay" data-theme="a">
	    	<ul class="jqm-list ui-alt-icon ui-nodisc-icon">
				
				<li data-icon="home"><a data-ajax="false" href="home.php?s=principal">Carga de Equipaje</a></li>
				<?php
				if ($_SESSION["usuario"]["tipo"] == 1 ){
				?>
				<li><a href="home.php?s=open_flight" data-ajax="false">Abrir Vuelo</a></li>
				<li><a href="home.php?s=estatus_vuelo" data-ajax="false">Estatus Vuelo</a></li>
				<li><a href="home.php?s=verificar_vuelo" data-ajax="false">Verificar Vuelo</a></li>
				<li><a href="home.php?s=usuarios" data-ajax="false">Usuarios</a></li>
				<li><a href="home.php?s=vuelos" data-ajax="false">Vuelos</a></li>
				<li><a href="home.php?s=reporte_diario" data-ajax="false">Reporte Diario</a></li>
				<?php
				}
				?>
				<li><a href="index.php" data-ajax="false">Cerrar Sesion</a></li>

			</ul>
		</div><!-- /panel -->


	<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="jqm-footer">
		<p>&copy; 2015 Santa Barbara Airlines C.A
		<p>Desarrollado por: Grupo Ximplex C.A.</p>
	</div><!-- /footer -->
	<!-- TODO: This should become an external panel so we can add input to markup (unique ID) -->
  

</div><!-- /page -->

</body>
</html>
