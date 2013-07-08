//	====================================================
//	--	Prototipo para Manejo de Tabs
function Utilidades_Tabs () {
	
	//	--	Cambiar de Gestión a Agregar
	this.cambiarAgregar = function(){
		$('#tab1').hide();
		$('#tab2').fadeIn(500);
		$('#buscaReceta').hide();
	}
	//	--	Cambiar de Agregar a Gestión
	this.cambiarGestion =  function() {
		$('#buscaRecetas').show();
		$('#tab2').hide();
		$('#tab1').fadeIn(500);
		$('#buscaReceta').show();
	}


}

//	====================================================
//	--	Prototipo para Manejo de Peticiones (Ajax)
function Utilidades_AJAX () {

	var Util_V=new Utilidades_Varias();
	var Util_FF=new Utilidades_Formularios();
	
	//eliminar Receta
	this.eliminarReceta = function(datos, modal, url){		
			var receta_data = $(datos).serializeObject();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: receta_data,
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
	
	//Modificar Receta
	this.modificarReceta = function(data, form, modal, url){
		
		var receta_data = $(form).serializeObject();
		console.log(receta_data+'  '+form);
		$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: receta_data,
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

	//	--	Agregar Nueva Receta
	this.agregarReceta = function (form,alert,url) {
		//	--	Validamos el Formulario
		if ($(form).valid()){
			//	--	Recolectamos los datos del Formulario
			var receta_data = $(form).serializeObject();
			//	--	Petición Ajax(AgregarCliente)
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: receta_data,
			  success: function(data, textStatus, xhr) {
			  	if(xhr.status==200){
			  		console.log("yeah");
			  		Util_V.mostrarModal(data);
			  	}
			  },
			  error: function() { //Util_T.mostrarError();
				Util_V.mostrarError();
			  }
			});
		}else{
			//Util_T.errorFormulario('#alerta_registrarreceta');
		}
	}//	--	Fin

	
	this.paginandoRecetas = function (pagina,url) {		
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

	//  --  Validando Formulario de Registro Nueva Receta
	
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
	
	this.formModificarReceta = function(){
		console.log('Yeaaaaah');
		var form = '';
		$('#ref_gestion').find('form').each(function(){
			form= $(this).attr('id');
			$('#' + form).validate({
				rules: {
					nombre: 	  {required: true},
					tipo1:    {required: true},
					tipo2:    {required: true},
					tipo3:    {required: true},
					tipo4:    {required: true},
					tipo5:    {required: true},
					tipo6:    {required: true},
					c1:       {required: true},
					c2:       {required: true},
					c3:       {required: true},
					c4:       {required: true},
					c5:       {required: true},
					c6:       {required: true}
				},
				/*messages:{
				},*/

				highlight: function(element) {
	      				$(element).closest('.control-group').removeClass('success').addClass('error');
	    			},
	    			success: function(element) {
		      			element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
	    			}
	    			});
	    		});
	}

	$('#form_agregarReceta').validate({
	    rules: {
	      nombre: 		{required: true},
	      tipo1: 		{required: true},
	      tipo2: 		{required: true},
	      tipo3: 		{required: true},
	      tipo4: 		{required: true},
	      tipo5: 		{required: true},
	      tipo6: 		{required: true},
	      c1: 			{required: true,accept: "[0-7]"},
	      c2: 			{required: true,accept: "[0-7]"},
	      c3: 			{required: true,accept: "[0-7]"},
	      c4: 			{required: true,accept: "[0-7]"},
	      c5: 			{required: true,accept: "[0-7]"},
	      c6: 			{required: true,accept: "[0-7]"}
	    },
	    messages: {
	      nombre: {
	      	required: 	"Campo obligatorio"
	      },
	      tipo1: {
	        required: 	"Campo obligatorio",
	      },
	      tipo2: {
	        required: 	"Campo obligatorio",
	      },
	      tipo3: {
	        required: 	"Campo obligatorio",
	      },
	      tipo4: {
	        required: 	"Campo obligatorio",
	      },
	      tipo5: {
	        required: 	"Campo obligatorio",
	      },
	      tipo6: {
	        required: 	"Campo obligatorio",
	      },
	      c1: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      c2: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      c3: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      c4: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      c5: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      c6: {
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
		$('#modal_generico .modal-header h3').html('Error al procesar la peticion');
		$('#modal_generico .modal-body').html('Error en el servidor intentelo mas tarde, ' + 'disculpe las molestias');
		$('#modal_generico .modal-footer').html('<button class="btn" data-dismiss="modal">Cerrar</button>');
		$('#modal_generico').modal('show');
	}
}