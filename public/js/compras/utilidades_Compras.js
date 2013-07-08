

//	====================================================
//	--	Prototipo para Manejo de Tabs
function Utilidades_Tabs () {
	
	var Util_V = new Utilidades_Varias();

	//	--	Cambiar de Gestión a Agregar
	this.cambiarAgregar = function(){
		$('#tab1').hide();
		$('#tab2').fadeIn(500);
		$('#comboMP').fadeIn(500);
		$('#buscaCompras').hide();
	}
	//	--	Cambiar de Agregar a Gestión
	this.cambiarGestion =  function() {
		$('#buscaCompras').show();
		$('#tab2').hide();
		$('#tab1').fadeIn(500);
		Util_V.limpiarAgregarCompra();
	}
	//	--	Cambiar de Modal a Gestión
	this.cambiarModal = function(){
		$('#modal_generico').modal('hide');
      	$('#tab2').hide();
      	$('#tab1').fadeIn(500);
      	$('#buscaCompras').show();
      	Util_V.autoPaginacionCompras('autoPaginarCompras');
	}

}


//	====================================================
//	--	Prototipo para Manejo de Peticiones (Ajax)
function Utilidades_AJAX () {
	
	var Util_T = new Utilidades_Varias();

	//	--	Agregar Nuevo Compra
	this.agregarCompra = function (form,alert,url) {
		//	--	Validamos el Formulario
		if ($(form).valid()){
			//	--	Recolectamos los datos del Formulario
			var compra_data = $(form).serializeObject();
			//	--	Petición Ajax(AgregarCompra)
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: compra_data,
			  success: function(data, textStatus, xhr) {
			    if (xhr.status == 200){
			    	Util_T.mostrarModal(data);
			    	Util_T.limpiarAgregarCompra();
			    }else if(xhr.status == 201){
			    	Util_T.mostrarModal(data);
			    }
			  },
			  error: function() { Util_T.mostrarError(); }
			});
		}else{
			Util_T.errorFormulario('#alerta_registrarcompra');
		}
	}//	--	Fin

	//	--	Paginado Compra (Usando Paginador)
	this.paginandoCompras = function (pagina,url) {
		$('#tab1').load(url, { 'pagina': pagina }, function(response, status, xhr) {
  			if (xhr.status == 201){
	          	Util_T.mostrarError();
  			}
 	 	});	
	}//	--	Fin

	//	--	Modificar Compra
	this.modificarCompra = function(form,campos,modal,url){
		//	--	Validando Formulario
		if($(form).valid()){
			//	--	Recolectamos los datos del Formulario
			var compra_data = $(campos).serializeObject();
			//	--	Petición Ajax(ModificarCompra)
			$.ajax({
			  url: url,
			  type: 'POST',
			  dataType: 'json',
			  data: compra_data,
			  success: function(data, textStatus, xhr) {
			  	if (xhr.status == 200){
			  		$(modal).modal('hide').fadeOut('slow');
			  		setTimeout(function(){
			  			Util_T.mostrarModal(data);
			  		},500);
			  		//	--	Paginacion 
			  		if (Util_T.leerCookie('busqueda') != null){
			  			Util_T.autoPaginacionCompras('paginarResultados',Util_T.leerCookie('busqueda'));
			  		}else{
			  			Util_T.autoPaginacionCompras('autoPaginarCompras');
			  		}
			  	}else{
			  		Util_T.mostrarModal(data);
			  		Util_T.limpiarModificarCompra(modal);
			  	}
			  },
			  error: function() { 
			  	Util_T.mostrarError(); 
			  	$(modal).modal('hide');
			  	Util_T.limpiarModificarCompra(modal);
			  }
			});
			
		}
	}//	--	Fin

	//	--	Eliminar Compra
	this.eliminarCompra = function(id,url){
		//	--	Petición Ajax
		$.ajax({
		  url: url,
		  type: 'POST',
		  dataType: 'json',
		  data: {id: id},
		  success: function(data, textStatus, xhr) {
		    if (xhr.status == 200){
		    	Util_T.mostrarModal(data);
		  		//	--	Paginacion 
		  		if (Util_T.leerCookie('busqueda') != null){
		  			Util_T.autoPaginacionCompras('paginarResultados',Util_T.leerCookie('busqueda'));
		  		}else{
		  			Util_T.autoPaginacionCompras('autoPaginarCompras');
		  		}
		    }else{
		    	Util_T.autoPaginacionCompras('autoPaginarCompras');
		    }
		  },
		  error: function() {
		    Util_T.mostrarError(); 
			$(modal).modal('hide');
		  }
		});
	}//	--	Fin

	/*	--	Cambiar Contraseña
	this.cambiarPass = function(){
		//	--	Validamos el Formulario
		if($('#cambiarPass').valid()){
			//	--	Recolectamos los datos del Formulario
			var user_data  = $('#cambiarPass').serializeObject();
			//	--	Petición Ajax(RegistrarUsuario)
		    $.ajax({
		        url: '/administracion/cambiarpass',
		        type: 'POST',
		        dataType: 'json',
		        data: user_data,
		        success: function(data) {
		        	if (data.status == 'ok'){
		        		$('#mod_contrasena').modal('hide');
		        		Util_T.mostrarModal(data);	//	--	Operación Exitosa
		        	}else if (data.status == 'mal'){
		        		Util_T.mostrarModal(data);	//	--	Mostrando Errores
		        	}
		        },
		        error: function() {
		        	//	--	Error Fatal en El Servidor
		          	util_M.modalErrorServer();
		        }
		      }); 
		}else{
			//	--	Error a Validar los Datos
	      	util_A.errorFormulario(alerta);
		}
	}*/

}


//	====================================================
//	--	Prototipo para Manejo de Validación (Formulario)
function Utilidades_Formularios () {

	//  --  Validando Formulario de Registro Nuevo Compra
	$('#form_agregarCompra').validate({
	    rules: {
	      nombre: 		{required: true},
	      rfc: 			{required: true,accept: "[a-zA-Z0-9]+",minlength: 13,maxlength: 13},
	      tel: 			{required: true,accept: "[0-9]+"},
	      estado: 		{required: true},
	      delegacion: 	{required: true},
	      colonia: 		{required: true,accept: "[a-zA-Z0-9.]"},
	      calle: 		{required: true,accept: "[a-zA-Z0-9.]"},
	      numero: 		{required: true,accept: "[0-9]"},
	      codigo: 		{required: true,accept: "[0-9]"},
	      correo: 		{required: true, email: true}
	    },
	    messages: {
	      nombre: {
	      	required: 	"Campo obligatorio"
	      },
	      rfc: {
	        required: 	"Campo obligatorio",
	        accept: 	"Unicamente letras y números",
	        minlength: 	"El RFC tiene que se de 13 caracteres",
	        maxlength: 	"El RFC tiene que se de 13 caracteres"
	      },
	      tel: {
	        required: 	"Campo obligatorio",
	        accept: 	"Unicamente numeros"
	      },
	      estado: {
	        required: 	"Campo obligatorio",
	      },
	      delegacion: {
	        required: 	"Campo obligatorio",
	      },
	      colonia: {
	        required: 	"Campo obligatorio",
	        accept: 	"Unicamente letras, números y puntos"
	      },
	      calle: {
	        required: 	"Campo obligatorio",
	        accept: 	"Unicamente letras y  números"
	      },
	      numero: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      codigo: {
	      	required: 	"Campo obligatorio",
	        accept: 	"Unicamente números"
	      },
	      correo: {
	        required: "Campo obligatorio",
	        email: "Ingresa un correo valido"
	      }
	    },
	    highlight: function(element) {
	      $(element).closest('.control-group').removeClass('success').addClass('error');
	    },
	    success: function(element) {
	      element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
	    }
	});//	--	Fin 

	//	--	Validar el Formulario de Modificar Compra
	this.formModificarCompra = function(formulario) {
		$(formulario).validate({
		    rules: {
		      nombre: 		{required: true},
		      rfc: 			{required: true,accept: "[a-zA-Z0-9]+",minlength: 13,maxlength: 13},
		      tel: 			{required: true,accept: "[0-9]+"},
		      estado: 		{required: true},
		      delegacion: 	{required: true},
		      colonia: 		{required: true,accept: "[a-zA-Z0-9.]"},
		      calle: 		{required: true,accept: "[a-zA-Z0-9.]"},
		      numero: 		{required: true,accept: "[0-9]"},
		      codigo: 		{required: true,accept: "[0-9]"},
		      correo: 		{required: true, email: true}
		    },
		    messages: {
		      nombre: {
		      	required: 	"Campo obligatorio"
		      },
		      rfc: {
		        required: 	"Campo obligatorio",
		        accept: 	"Unicamente letras y números",
		        minlength: 	"El RFC tiene que se de 13 caracteres",
		        maxlength: 	"El RFC tiene que se de 13 caracteres"
		      },
		      tel: {
		        required: 	"Campo obligatorio",
		        accept: 	"Unicamente numeros"
		      },
		      estado: {
		        required: 	"Campo obligatorio",
		      },
		      delegacion: {
		        required: 	"Campo obligatorio",
		      },
		      colonia: {
		        required: 	"Campo obligatorio",
		        accept: 	"Unicamente letras, números y puntos"
		      },
		      calle: {
		        required: 	"Campo obligatorio",
		        accept: 	"Unicamente letras y  números"
		      },
		      numero: {
		      	required: 	"Campo obligatorio",
		        accept: 	"Unicamente números"
		      },
		      codigo: {
		      	required: 	"Campo obligatorio",
		        accept: 	"Unicamente números"
		      },
		      correo: {
		        required: "Campo obligatorio",
		        email: "Ingresa un correo valido"
		      }
		    },
		    highlight: function(element) {
		      $(element).closest('.control-group').removeClass('success').addClass('error');
		    },
		    success: function(element) {
		      element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
		    }
		});//	--	Fin 
	}//	--	Fin

	/*	--	Validar Formulario cambiar contraseña
	$('#cambiarPass').validate({
		rules:{
			actualPass: {required: true,minlength: 3,accept: "[a-zA-Z0-9_-]"},
			nuevoPass: {required: true,minlength: 6,accept: "[a-zA-Z0-9_-]",},
		    conPass: {required: true,minlength: 6,accept: "[a-zA-Z0-9_-]",equalTo: "#nuevoPass"}
		},
		messages:{
			actualPass: {
              required: "Campo obligatorio",
              minlength: "Al menos debe tener 6 caracteres ",
              accept: "Unicamente letras, números o guiones"
            },
            nuevoPass: {
              required: "Campo obligatorio",
              minlength: "Al menos debe tener 6 caracteres ",
              accept: "Unicamente letras, números o guiones"
            },
	        conPass: {
	          required: "Campo obligatorio",
	          minlength: "Al menos debe tener 6 caracteres ",
	          accept: "Unicamente letras, números o guiones",
	          equalTo: "Las contraseña no coinciden"
	        }
		},
		highlight: function(element) {
		    $(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
		    element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
		}
	});//	--	Fin*/
	
	//  --  Agregando Métodos de Validación al plugin (No Modificar este Método)
	jQuery.validator.addMethod("accept", function(value, element, param) {
	  return value.match(new RegExp("." + param + "$"));
	});//	--	Fin

	
}

//	====================================================
//	--	Prototipo Utilidades Varias
function Utilidades_Varias(){

	//	--	Limpiar el formulario Agregar Compra
	this.limpiarAgregarCompra = function(){
		$('#tab2').find(':input').each(function(){
	  		this.value = '';
	  		$(this).closest('.control-group').removeClass('success');
	  		$(this).closest('.control-group').removeClass('error');
		});
	    $('#tab2').find('label').each(function(){
	      	if ($(this).hasClass('error') || $(this).hasClass('valid')){
	      		$(this).remove();
	      	}
	    });
	    //	--	Restablecer Alerta
	    $('#alerta_registrarcompra').attr('class', 'row-fluid alert alert-info span11');
		$('#alerta_registrarcompra')
			.html('<strong>Instrucciones:</strong> Ingresa la información solicitada'+ 
        		  '<strong>Recuerda!</strong> todos los campos marcados con *  son obligatorios.');
	}

	//	--	Limpiar el formulario Modificar Compra
	this.limpiarModificarCompra = function(form,edo){
		$(form).find(':input').each(function(){
	  		$(this).closest('.control-group').removeClass('success');
	  		$(this).closest('.control-group').removeClass('error');
		});
	    $(form).find('label').each(function(){
	      	if ($(this).hasClass('error') || $(this).hasClass('valid')){
	      		$(this).remove();
	      	}
	    });
	}

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
	
	//	--	Error Formulario Mostrar alerta
	this.errorFormulario = function (idAlerta){
		$(idAlerta).attr('class', 'alert alert-error span8 offset1');
		$(idAlerta).html('<strong> Error : </strong> Por favor corrija los campos en color rojo.');
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

	//	--	Leer una Cookie
  	this.leerCookie = function(name) {
    	var nameEQ = name + "=";
    	var ca = document.cookie.split(';');
    	for(var i=0;i < ca.length;i++) {
      		var c = ca[i];
      		while (c.charAt(0)==' ') c = c.substring(1,c.length);
      		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    	}
    	return null;
  	}

  	//	--	Auto Paginacion (Mantener Tabla Actualizada Siempre)
  	this.autoPaginacionCompras =  function(url,param){
  		$('#tab1').load(url, {item: param},function(response, status, xhr) {
  			if (xhr.status != 200){
  				this.mostrarError();
  			}
 	 	});
  	}

  	//	--	Paginar Desde Cero
  	this.autoPaginacionComprasInit =  function(url){
  		$('#tab1').load('',function(response, status, xhr) {
  			if (xhr.status != 200){
  				this.mostrarError();
  			}
 	 	});
  	}




}
