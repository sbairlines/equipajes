$(document).ready(function(){
	$("#btnLogin").click(function(){
		$_txtUsuario = $("#txtUsuario").val();
		$_txtPass = $("#txtPass").val();
		$.post( "includes/sql.php?s=login", {txtUsuario:$_txtUsuario, txtPass:$_txtPass })
		//$.post( "includes/sql.php?s=cargaDatos", { id_usuario: 1, bartag: barTag, id_punto_control: 1}) 
			.done(function( data ) {
				if ( data == 1 ) {
					window.location.href = "home.php?s=principal";
				} else {
					window.location.href = "index.php?e=" + data;
				}
		});
	});
	
	$("#btnAbrirVuelo").click(function(){
		$_idVuelo = $("#cmbVuelo").val();
		$_txtNombreVuelo = $("#txtNombreVuelo").val();
		$.post( "includes/sql.php?s=abrirvuelo", {idvuelo:$_idVuelo, nombreVuelo:$_txtNombreVuelo })
		//$.post( "includes/sql.php?s=cargaDatos", { id_usuario: 1, bartag: barTag, id_punto_control: 1}) 
			.done(function( data ) {
				if ( data == 1 ) {
					window.location.href = "home.php?s=principal";
				} else {
					window.location.href = "home.php?s=open_flight&e=" + data;
				}
		});
	});
	
	$('#txtBarTag').onchange(function(){
		if ( $('#txtBarTag').val().length == 10 ) {
			if ( $('#txtBarTag').val().substr(0,4) != $('#txtVuelo').val() ) {
				alert("El Bagtag no pertenece a este vuelo.");
				 $('#txtBarTag').val('');
			} else {
				$('#txtBarTag').prop( "disabled", true );
				if ( $('#txtCodIata').length ) {
					$('#txtCodIata').focus();
				} else {
					guardar();
				}
			}			
		}
	});
	
	$('#txtCodIata').keyup(function(){
		if ( $('#txtCodIata').val().length == 4 ) {
			$('#txtCodIata').prop( "disabled", true );
			guardar();
		}
	});
	
	function guardar() {
		
		barTag = $('#txtBarTag').val();
		
		if ( $('#txtCodIata').length ) {
			codIata = $('#txtCodIata').val();
		} else {
			codIata = "";
		}
		
		IdUsuario = $('#txtIdUsuario').val();
		IdPuntocontrol = $('#txtIdPuntocontrol').val();
		IdControl = $('#txtIdControl').val();
	
		$.post( "includes/sql.php?s=cargaDatos", { id_usuario: IdUsuario, bar_tag: barTag, cod_iata: codIata, id_punto_control: IdPuntocontrol, id_control:IdControl })
		//$.post( "includes/sql.php?s=cargaDatos", { id_usuario: 1, bartag: barTag, id_punto_control: 1}) 
			.done(function( data ) {
				$('#txtBarTag').prop( "disabled", false );
				$('#txtCodIata').prop( "disabled", false);
				
				$('#cantMaletas' + $('#txtIdPuntocontrol').val() ).html(data);
				$('#txtBarTag').val('');
				$('#txtCodIata').val('');
				$('#txtBarTag').focus();
		});
		
		//$('#cantMaletasCounter').html(parseInt($('#cantMaletasCounter').html()) + 1);
	}
	
	
	$('#btnCargaDatosTodos').bind('click', function (){
		
		IdControl = $('#txtIdControl').val();
		
		$.post( "includes/sql.php?s=cargaDatosTodos", { id_control:IdControl })
			.done(function( data ) {
				$('#txtBarTag').prop( "disabled", true );
				$('#cantMaletas').html(data);
				$('#txtBarTag').val('');
				
				if ( $('#txtCodIata').length ) {
					$('#txtCodIata').val('');
					$('#txtCodIata').prop( "disabled", false );
				}
				
				$('#txtBarTag').prop( "disabled", false );
				$('#txtBarTag').focus();
			});
	});
	
	if ( $('#txtBarTag').length ) {
		$('#txtBarTag').focus();
	}
	
	if ( $('#cmbVuelo').length ) {
		$('#cmbVuelo').change(function(){
			if ( $('#cmbVuelo').val() == 0 ) {
				$('#txtNombreVuelo').css('display','block');
				$('#lblNombreVuelo').css('display','block');
			} else {
				$('#txtNombreVuelo').css('display','none');
				$('#lblNombreVuelo').css('display','none');
			}
			console.log($('#cmbVuelo').val());
		});
	}
	
	
	
	
});
