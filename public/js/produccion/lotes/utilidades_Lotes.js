//	====================================================
//	--	Prototipo para Manejo de Tabs
function Utilidades_Tabs () {
	
	//	--	Cambiar de Gestión a Agregar
	this.cambiarAgregar = function(){
		$('#tab1').hide();
		$('#tab2').fadeIn(500);
		$('#buscaLotes').hide();
	}
	//	--	Cambiar de Agregar a Gestión
	this.cambiarGestion =  function() {
		$('#buscaLotes').show();
		$('#tab2').hide();
		$('#tab1').fadeIn(500);
	}


}

//	====================================================
//	--	Prototipo para Manejo de Peticiones (Ajax)
function Utilidades_AJAX () {

	var Util_V=new Utilidades_Varias();
	var Util_FF=new Utilidades_Formularios();
	
	//eliminar lote
	this.eliminarLote = function(datos, modal, url){		
			var lot_data = $(datos).serializeObject();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: lot_data,
				success: function(data, textStatus, xhr){
					if(xhr.status==200){
						$(modal).modal('hide');
						Util_V.mostrarModal(data);						
					}else{
						$(modal).modal('hide');
						Util_V.mostrarModal(data);						
					}
				},
				error: function(){					
					Util_V.mostrarError();
				}
			});
	}
	
	//Modificar Lote
	this.modificarLote = function(datos, formulario, modal, url){
		if($(formulario).valid()){
			var lot_data = $(datos).serializeObject();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: lot_data,
				success: function(data, textStatus, xhr){
					if(xhr.status==200){
						$(modal).modal('hide');
						Util_V.mostrarModal(data);
					}else{
						$(modal).modal('hide');
						Util_V.mostrarModal(data);
					}
				},
				error: function(){					
					Util_V.mostrarError();
				}
			});
		}
	}

	//	--	Agregar Nuevo Lote
	this.agregarCliente = function (form,alert,url) {
		//	--	Validamos el Formulario
		if ($(form).valid()){
			//	--	Recolectamos los datos del Formulario
			var lote_data = $(form).serializeObject();
			//	--	Petición Ajax(AgregarCliente)
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: lote_data,
			  success: function(data, textStatus, xhr) {
			    if (xhr.status == 200){			    	
			    	Util_V.mostrarModal(data);
			    	console.log(data);
			    }else if(xhr.status == 201){
			    	Util_V.mostrarModal(data);			    	
			    }
			  },
			  error: function() { //Util_T.mostrarError();
				Util_V.mostrarError();
			  }
			});
		}else{
			//Util_T.errorFormulario('#alerta_registrarcliente');
		}
	}//	--	Fin
	
	this.paginandoLotes = function (pagina,url) {		
		$('#tab1').load(url, { 'pagina': pagina }, function(response, status, xhr) {
  			if (xhr.status == 201){
	          	Util_V.mostrarError();
  			}
 	 	});	
	}//	--	Fin

}

//	====================================================
//	--	Prototipo para Manejo de Validación (Formulario)
function Utilidades_Formularios () {

	//  --  Validando Formulario de Registro Nuevo Cliente
	
	function limpiarForm (tab) {
		//	--	Limpiamos el Form y los Estilos
		$(tab).find(':input').each(function(){
	  		this.value = '';
	  		$(this).closest('.control-group').removeClass('success');
	  		$(this).closest('.control-group').removeClass('error');
		});
	    //	--	Limpiamos el label y su marca
	    $(tab).find('label').each(function(){
	      	if ($(this).hasClass('error') || $(this).hasClass('valid')){
	      		$(this).remove();
	      	}
	    });
	}//	--	Fin reset Tab
	
	this.formModificarLote = function(){
		var form = '';
		$('#ref_gestion').find('form').each(function(){
			form= $(this).attr('id');
			$('#' + form).validate({
				rules: {
					fCad:          {required: true},
					fProduc:       {required: true}
				},
				messages:{
					fCad: {
						required: "Campo obligatorio"
					},
					fProduc: {
						required: "Campo obligatorio"
					}
				},
				highlight: function(element) {
	      				$(element).closest('.control-group').removeClass('success').addClass('error');
	    			},
	    			success: function(element) {
		      			element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
	    			}
	    			});
	    		});
	}
	$('#form_agregarLote').validate({
	    rules: {
	      linea: 		{required: true},
	      fProduc: 		{required: true,date: true},
	      fCad: 		{required: true,date: true},
	      galleta: 		{required: true},
	      cantidad: 	{required: true,accept: "[0-9]"},
	      estado: 		{required: true}
	    },
	    messages: {
	      linea: {
	      	required: 	"Campo obligatorio"
	      },
	      fProduc: {
	        required: 	"Campo obligatorio",
	        date: 		"Fecha invalida"
	      },
	      fCad: {
	        required: 	"Campo obligatorio",
	        date: 		"Fecha invalida"
	      },
	      galleta: {
	        required: 	"Campo obligatorio",
	      },
	      cantidad: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      estado: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      }
	    },
	    highlight: function(element) {
	      $(element).closest('.control-group').removeClass('success').addClass('error');
	    },
	    success: function(element) {
	      element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
	    }
	});//	--	Fin

	//  --  Agregando Métodos de Validación al plugin (No Modificar este Método)
	jQuery.validator.addMethod("accept", function(value, element, param) {
	  return value.match(new RegExp("." + param + "$"));
	});//	--	Fin
}


function Utilidades_Varias(){
	this.mostrarModal=function(datos){
		$('#modal_generico .modal-header h3').html(datos.function);
		$('#modal_generico .modal-body').html(datos.mensaje);
		$('#modal_generico .modal-footer').html(datos.opciones);
		$('#modal_generico').modal('show');
	}
	
	this.mostrarError=function(){
		$('#modal_generico .modal-header h3').html('Error al procesar la peteicion');
		$('#modal_generico .modal-body').html('Error en el servidor intentelo mas tarde, ' + 'disculpe las molestias');
		$('#modal_generico .modal-footer').html('<button class="btn" data-dismiss="modal">Cerrar</button>');
		$('#modal_generico').modal('show');
	}
}



