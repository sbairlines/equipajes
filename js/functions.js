$(document).ready(function(){
	/*$("#btnLogin").click(function(){
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
	});*/
	
	/*$("#btnAbrirVuelo").click(function(){
		$_idVuelo = $("#cmbVuelo").val();
		$_dqf = $("#chkDqf").val();
		//console.log($_dqf);
		$_txtNombreVuelo = $("#txtNombreVuelo").val();
		$.post( "includes/sql.php?s=abrirvuelo", {idvuelo:$_idVuelo, dqf:$_dqf, nombreVuelo:$_txtNombreVuelo })
		//$.post( "includes/sql.php?s=cargaDatos", { id_usuario: 1, bartag: barTag, id_punto_control: 1}) 
			.done(function( data ) {
				if ( data == 1 ) {
					window.location.href = "home.php?s=principal";
				} else {
					window.location.href = "home.php?s=open_flight&e=" + data;
				}
		});
	});*/
	
	
	if ( $('#txtUsuario').length ) {
		$('#txtUsuario').focus();
	}
	if ( $('.txtInput').length ) {
		$('.txtInput').doubleTap(function() {
			$(this).val('');
		});
	}
	
	if ( $('#cboVuelo').length ) {
		$('#cboVuelo').change(function(){
			if ( $('#cboVuelo').val() == 0 ) {
				$('#txtNombreVuelo').css('display','block');
				$('#lblNombreVuelo').css('display','block');
			} else {
				$('#txtNombreVuelo').css('display','none');
				$('#lblNombreVuelo').css('display','none');
			}
			//console.log($('#cboVuelo').val());
		});
	}
	
});

(function($) {
     $.fn.doubleTap = function(doubleTapCallback) {
         return this.each(function(){
			var elm = this;
			var lastTap = 0;
			$(elm).bind('vmousedown', function (e) {
                                var now = (new Date()).valueOf();
				var diff = (now - lastTap);
                                lastTap = now ;
                                if (diff < 250) {
		                    if($.isFunction( doubleTapCallback ))
		                    {
		                       doubleTapCallback.call(elm);
		                    }
                                }      
			});
         });
    }
})(jQuery);