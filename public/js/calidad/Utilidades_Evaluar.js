
//	====================================================
//	--	Prototipo para Manejo de Peticiones AJAX
function Utilidades_Ajax () {
	
	var Util_V =  new Utilidades_Varias();
	var Util_A =  new Utilidades_Alertas();

this.enviarRegistrarFallo= function (form,alert,url){
		//	--	Validamos el Formulario
		if($(form).valid()){
			//	--	Recolectamos los datos del Formulario
			var lote_data  = $(form).serializeObject();
			//	--	Petición Ajax(RegistrarUsuario)
	      $.ajax({	      	
	        url: url,
	        type: 'POST',
	        dataType: 'json',
	        data: lote_data,
	        success: function(data) {
	        	if (data.status == 'ok'){
	        		Util_V.mostrarModal(data);	//	--	Operación Exitosa	        		
	        	}else if (data.status == 'mal'){
	        		Util_V.mostrarModal(data);	//	--	Mostrando Errores
	        	}
	        },
	        error: function() {
	        	//	--	Error Fatal en El Servidor
	          	Util_V.mostrarError();
	        }
	      });
		}else{
			//	--	Error a Validar los Datos
	      	util_A.errorFormulario(alerta);
		}
	}//	--	Fin Registrar Queja


	//	--	Evaluar la Materia Prima (Aprobada/Rechazada)
	this.evaluarMateriaPrima = function (formulario,datos,modal,url) {
		//	--	Validando Formulario
		if($(formulario).valid()){
			//	--	Obtenemos Datos del Form
			var eval_data = $(datos).serializeObject();
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: eval_data,
			  success: function(data, textStatus, xhr) {
			    if(xhr.status ==  200){
			    	$(modal).modal('hide');
			    	Util_V.mostrarModal(data);
			    }else{
			    	$(modal).modal('hide');
			    	Util_V.mostrarModal(data);
			    }
			  },
			  error: function() {
			    Util_V.mostrarError();
			  }
			});
		}
	}	
	
	//	--	Aprobar la Materia Prima (Aprobada/Rechazada)
	
	this.aprovarMateriaPrima = function (formulario,datos,modal,url) {
		//	--	Validando Formulario
		if($(formulario).valid()){
			//	--	Obtenemos Datos del Form
			var apro_data = $(datos).serializeObject();
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: apro_data,
			  success: function(data, textStatus, xhr) {
			    if(xhr.status ==  200){
			    	$(modal).modal('hide');
			    Util_V.mostrarModal(data);
			    }else{
			    	$(modal).modal('hide');
			    	Util_V.mostrarModal(data);
			    }
			  },
			  error: function() {
			    Util_V.mostrarError();
			  }
			});
		}
	}	


//	--	Aprobar Lote (Aprobada/Rechazada)
	
	this.aprobarLote = function (formulario,datos,modal,url) {
		//	--	Validando Formulario
		if($(formulario).valid()){
			//	--	Obtenemos Datos del Form
			var apro_data = $(datos).serializeObject();
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: apro_data,
			  success: function(data, textStatus, xhr) {
			    if(xhr.status ==  200){
			    	$(modal).modal('hide');
			    Util_V.mostrarModal(data);
			    }else{
			    	$(modal).modal('hide');
			    	Util_V.mostrarModal(data);
			    }
			  },
			  error: function() {
			    Util_V.mostrarError();
			  }
			});
		}
	}	
	
	//	--	Evaluar la Lotes Terminados (Aprobada/Rechazada)
	
	this.evaluarLote = function (formulario,datos,modal,url) {
		//	--	Validando Formulario
		if($(formulario).valid()){
			//	--	Obtenemos Datos del Form
			var eval_data = $(datos).serializeObject();
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: eval_data,
			  success: function(data, textStatus, xhr) {
			    if(xhr.status ==  200){
			    	$(modal).modal('hide');
			    	Util_V.mostrarModal(data);
			    }else{
			    	$(modal).modal('hide');
			    	Util_V.mostrarModal(data);
			    }
			  },
			  error: function() {
			    Util_V.mostrarError();
			  }
			});
		}
	}	
	

	//	--	Paginar Usuarios
	this.paginandoMateria = function(pagina,url){
		
		$('#tablaMateria').load(url, { 'pagina': pagina }, function(response, status, xhr) {
  			if (xhr.status != 200){
	          	Util_V.mostrarError();
  			}
 	 	});	
	}
	this.paginandoLote = function(pagina,url){
		
		$('#tablaLote').load(url, { 'pagina': pagina }, function(response, status, xhr) {
  			if (xhr.status != 200){
	          	Util_V.mostrarError();
  			}
 	 	});	
	}

	this.paginandoFallo = function(pagina,url){
		
		$('#tablaFallo').load(url, { 'pagina': pagina }, function(response, status, xhr) {
  			if (xhr.status != 200){
	          	Util_V.mostrarError();
  			}
 	 	});	
	}

	this.paginandoQueja = function(pagina,url){
		
		$('#tablaQueja').load(url, { 'pagina': pagina }, function(response, status, xhr) {
  			if (xhr.status != 200){
	          	Util_V.mostrarError();
  			}
 	 	});	
	}
	
}


//	====================================================
//	--	Prototipo para Manejo de Validación (Formulario)
function Utilidades_Formularios () {
	
	//	--	Agregamos Validación a los Formularios
	this.formMateriaRechazada = function(){
		var form = '';
		$('.tab-content').find('form').each(function(){
			form = $(this).attr('id');
			$('#'+form).validate({
		    	rules: {
		      		mensaje: 	{required: true, minlength: 5, maxlength: 500}
		    	},
		    	messages: {
		    		mensaje: {
		    			required:   "Campo requerido",
		        		minlength: 	"Al menos 5 caracteres ",
		        		maxlength: 	"No mas de 500 caracteres "
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

	//	--	Agregamos Validación a los Formularios
	this.formLoteRechazada = function(){
		var form = '';
		$('.tab-content').find('form').each(function(){
			form = $(this).attr('id');
			$('#'+form).validate({
		    	rules: {
		      		mensaje: 	{required: true, minlength: 5, maxlength: 500}
		    	},
		    	messages: {
		    		mensaje: {
		    			required:   "Campo requerido",
		        		minlength: 	"Al menos 5 caracteres ",
		        		maxlength: 	"No mas de 500 caracteres "
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


}


//	====================================================
//	--	Prototipo Utilidades Varias
function Utilidades_Varias(){

	//	--	Modal Genérico
	this.mostrarModal = function(datos){
		$('#modal_generico .modal-header h3').html(datos.funcion);
		$('#modal_generico .modal-body ').html(datos.mensaje);
		$('#modal_generico .modal-footer').html(datos.opciones);
		$('#modal_generico').modal('show');
	}

	//	--	Modal Error Fatal
	this.mostrarError = function(){
		$('#modal_generico .modal-header h3').html('Error al procesar la petición');
		$('#modal_generico .modal-body ').html( 'Error en le Servidor inténtalo mas tarde,'+ 
												 'disculpa las molestias.');
		$('#modal_generico .modal-footer').html('<button class="btn" data-dismiss="modal">Cerrar</button>');
		$('#modal_generico').modal('show');
	}

		//	--	Crear un Cookie
	this.crearCookie = function(name, value,days){
		if (days) {
      		var date = new Date();
      		date.setTime(date.getTime()+(days*24*60*60*1000));
      		var expires = "; expires="+date.toGMTString();
    	}else var expires = "";
      		document.cookie = name+"="+value+expires+"; path=/";
	}
	
}

//	--	Prototipo para Manejo de Alertas
function Utilidades_Alertas(){

	this.errorFormulario = function (idAlerta){
		$(idAlerta).attr('class', 'alert alert-error span8 offset1');
		$(idAlerta).html('<strong> Error : </strong> Por favor corrija los campos en color rojo.');
	}
	this.resetAlerta = function(){
      $('#alerta_registrarUsuario').attr('class', 'row-fluid alert alert-info span11');
	  $('#alerta_registrarUsuario').html('<strong>Instrucciones:</strong> Ingresa la información solicitada.'+ 
        '<strong>Recuerda</strong> todos los campos marcados con * son obligatorios.');
	}

}    