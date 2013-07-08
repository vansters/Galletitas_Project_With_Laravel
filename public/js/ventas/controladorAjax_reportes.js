$(document).ready(function() {
	
	var formulario  = $('#periodo');

	$('#repoVentas').on("click", function() {
        if(formulario.valid()){
        	var reporte_data = formulario.serializeObject();

        	setTimeout("location.href = 'http://localhost/Galletitas/public/ventas/reporteVentas/?fechaInicio="
        		+reporte_data.fechaInicio+"&fechaFinal="+reporte_data.fechaFinal+"';",500);
        }
    });

    $('#repoClientes').on("click", function() {
        if(formulario.valid()){
            var reporte_data = formulario.serializeObject();

            setTimeout("location.href = 'http://localhost/Galletitas/public/ventas/reporteClientes/?fechaInicio="
                +reporte_data.fechaInicio+"&fechaFinal="+reporte_data.fechaFinal+"';",500);
        }
    });

    $('#repoProductos').on("click", function() {
        if(formulario.valid()){
            var reporte_data = formulario.serializeObject();

            setTimeout("location.href = 'http://localhost/Galletitas/public/ventas/reporteProductos/?fechaInicio="
                +reporte_data.fechaInicio+"&fechaFinal="+reporte_data.fechaFinal+"';",500);
        }
    });



    //  --  Validando Formulario de Registro Nuevo Cliente
	$('#periodo').validate({
	    rules: {
	      fechaInicio: 	{required: true, date: true},
	      fechaFinal: 	{required: true, date: true}
	    },
	    messages: {
	      fechaInicio: {
	      		required: 	"Campo obligatorio",
	      		date: 		"Fecha Invalida"
	      },
	      fechaFinal: {
	        	required: 	"Campo obligatorio",
	        	date:       "Fecha Invalida"
	      }
	    },
	    highlight: function(element) {
	      $(element).closest('.control-group').removeClass('success').addClass('error');
	    },
	    success: function(element) {
	      element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
	    }
	});//	--	Fin 


    $('body').click(function(e) {
        var numero = Math.floor(Math.random()*50);
        if((numero%2 != 0) || (numero <= 10 && numero >= 40)){
            $('#cont_alertas').hide();
            setTimeout(function(){ $('#cont_alertas').html(numero).fadeIn(500); }, 100); 
        }
    });

});