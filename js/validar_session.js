$(document).ready(function(){
	setInterval(validarSession, 10800000); //3 Horas
	
	function validarSession() {
		$.post( "lib/validar_session.php") 
			.done(function( data ) {
				if ( data == 0 ) {
					window.location.href = "index.php?e=4";
				}
		});
	}
});