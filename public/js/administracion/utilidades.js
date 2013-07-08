
//	--	Variable Global para Validar Formulario

//-------------------------------------------------
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

//-------------------------------------------------
//	--	Prototipo para Manejo de Mensajes
function Utilidades_Mensajes(){

	this.generarModal = function (datos){
		$('#modal_generico .modal-header h3').html(datos.funcion);
		$('#modal_generico .modal-body ').html(datos.mensaje);
		$('#modal_generico .modal-footer').html(datos.opciones);
		$('#modal_generico').modal('show');
	}

	this.modalErrorServer = function(){
		$('#modal_generico .modal-header h3').html('Error al procesar la petición');
		$('#modal_generico .modal-body ').html( 'Error en le Servidor inténtalo mas tarde,'+ 
												 'disculpa las molestias.');
		$('#modal_generico .modal-footer').html('<button class="btn" data-dismiss="modal">Cerrar</button>');
		$('#modal_generico').modal('show');
	}
}

//-------------------------------------------------
//	--	Prototipo para Manejo de Validaciones
function Utilidades_Validacion(){

	//  --  Validando Formulario de Registro Nuevo Usuario
	$('#form_registrarUsuario').validate({
		    rules: {
		      nombre: {required: true,accept: "[a-zA-Z]+"},
		      apPaterno: {required: true,accept: "[a-zA-Z]+"},
		      apMaterno: {required: true,accept: "[a-zA-Z]+"},
		      depto: {required: true,accept: "[a-zA-Z]+"},
		      rfc: {required: true,accept: "[a-zA-Z0-9]+",minlength: 13},
		      pass: {required: true,minlength: 6,accept: "[a-zA-Z0-9_-]",},
		      passcon: {required: true,minlength: 6,accept: "[a-zA-Z0-9_-]",equalTo: "#pass"},
		      correo: {required: true, email: true}
		    },
		    messages: {
		      nombre: {
		      	required: "Campo obligatorio",
		      	accept: "Ingresa unicamente letras"
		      },
		      apPaterno: {
		      	required: "Campo obligatorio",
		      	accept: "Ingresa unicamente letras"
		      },
		      apMaterno: {
		      	required: "Campo obligatorio",
		      	accept: "Ingresa unicamente letras"
		      },
		      depto: {
		      	required: "Selecciona un Departamento",
		      	accept: "Ingresa unicamente letras"
		      },
		      rfc: {
		        required: "Campo obligatorio",
		        accept: "Unicamente letras y números",
		        minlength: "El RFC tiene que se de 13 caracteres"
		      },
		      pass: {
		        required: "Campo obligatorio",
		        minlength: "Al menos debe tener 6 caracteres ",
		        accept: "Unicamente letras, números o guiones"
		      },
		      passcon: {
		        required: "Campo obligatorio",
		        minlength: "Al menos debe tener 6 caracteres ",
		        accept: "Unicamente letras, números o guiones",
		        equalTo: "Las contraseña no coinciden"
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
	});//	--	Fin Validando Formulario de Registro Nuevo Usuario


	//	--	Validar Formulario cambiar contraseña
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
	});


	//	--	Funcion para Asignar un formulario a la Validacion Modificar
	this.formModificarUsuario = function(formulario){

      $(formulario).validate({
            rules: {
              nombre: {required: true,accept: "[a-zA-Z]+"},
              apPaterno: {required: true,accept: "[a-zA-Z]+"},
              apMaterno: {required: true,accept: "[a-zA-Z]+"},
              depto: {required: true,accept: "[a-zA-Z]+"},
              rfc: {required: true,accept: "[a-zA-Z0-9]+",minlength: 13},
              correo: {required: true, email: true}
            },
            messages: {
              nombre: {
                required: "Campo obligatorio",
                accept: "Ingresa unicamente letras"
              },
              apPaterno: {
                required: "Campo obligatorio",
                accept: "Ingresa unicamente letras"
              },
              apMaterno: {
                required: "Campo obligatorio",
                accept: "Ingresa unicamente letras"
              },
              depto: {
                required: "Selecciona un Departamento",
                accept: "Ingresa unicamente letras"
              },
              rfc: {
                required: "Campo obligatorio",
                accept: "Unicamente letras y números",
                minlength: "El RFC tiene que se de 13 caracteres"
              },
              pass: {
                required: "Campo obligatorio",
                minlength: "Al menos debe tener 6 caracteres ",
                accept: "Unicamente letras, números o guiones"
              },
              passcon: {
                required: "Campo obligatorio",
                minlength: "Al menos debe tener 6 caracteres ",
                accept: "Unicamente letras, números o guiones",
                equalTo: "Las contraseña no coinciden"
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
      });
	}//	--	Fin Validar Formulario

	//  --  Agregando Métodos de Validación al plugin (No Modificar este Método)
	jQuery.validator.addMethod("accept", function(value, element, param) {
	  return value.match(new RegExp("." + param + "$"));
	});

}

//-------------------------------------------------
//	--	Prototipo para Manejo de Formularios
function Utilidades_Formularios(){

	var util_A = new Utilidades_Alertas();
	var util_V = new Utilidades_Validacion();
	var util_M = new Utilidades_Mensajes();
	var tool = new Cookies();

	//	--	Enviar Formulario de Registro de Usuario 	
	this.enviarRegistrarUsuario = function (formulario,alerta,url){
		//	--	Validamos el Formulario
		if($(formulario).valid()){
			//	--	Recolectamos los datos del Formulario
			var user_data  = $(formulario).serializeObject();
			//	--	Petición Ajax(RegistrarUsuario)
	      $.ajax({
	        url: url,
	        type: 'POST',
	        dataType: 'json',
	        data: user_data,
	        success: function(data) {
	        	if (data.status == 'ok'){
	        		util_M.generarModal(data);	//	--	Operación Exitosa
	        		limpiarForm('#tab2');	//	--	Limpiamos Form
	        		util_F.paginando(1,'administracion/paginar');
	        	}else if (data.status == 'mal'){
	        		util_M.generarModal(data);	//	--	Mostrando Errores
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
	}//	--	Fin Registrar Usuario

//-->//	--	Enviar Modificacion de Usuario
	this.enviarModificarUsuario = function (formulario,datos,modal,url){
		//	--	Validamos el Formulario
		if($(formulario).valid()){
			//	--	Recolectamos los datos del Formulario
			var user_data  = $(datos).serializeObject();
			console.log(user_data);
			//	--	Petición Ajax(RegistrarUsuario)
		    $.ajax({
		        url: url,
		        type: 'POST',
		        dataType: 'json',
		        data: user_data,
		        success: function(data,textStatus,xhr) {

		        	if(xhr.status == 201){
		        		$(modal).modal('hide').fadeOut('slow');
		        		util_M.generarModal(data);	//	--	Operación Exitosa
		        		limpiarForm(modal);	//	--	Limpiamos Form
		        		//	--	Evaluamos el Tipo de paginacion
		        		if(tool.readCookie('busqueda') != null){
		        			autopag('administracion/paginarResul',tool.readCookie('busqueda'));
		        		}else{
		        			autopag('administracion/paginarR');	//	--	Recargamos la tabla	
		        		}
		        	}else if (xhr.status == 202){
		        		util_M.generarModal(data);	//	--	Mostrando Errores
		        	}

		        }
		      }); 
		}else{
			//	--	Error a Validar los Datos
	      	util_A.errorFormulario(alerta);
		}
	}//	--	Fin Registrar Usuario


	//	--	Paginando La tabla de Gestion
  	this.paginando = function (pagina,url){
  		$('#tab1').load(url, { 'pagina': pagina }, function(response, status, xhr) {
  			if (status == 'error'){
	          	util_M.modalErrorServer();
  			}
 	 	});
  	}//	--	Fin Paginado de Usuarios

  	//	--	Repaginado de la Tabla de Gestión
  	function autopag  (url,param){
  		$('#tab1').load(url, {item: param},function(response, status, xhr) {
  			if (xhr.status != 200){
  				var data = {'funcion' : 'Error al procesar la petición', 
	        				'mensaje' : 'Error en le Servidor inténtalo mas tarde, disculpa las molestias.'};
	          	util_M.generarModal(data);
  			}
 	 	});
  	}

  	//  --  Función Genérica para Envio de Formularios Modificar Usuario
	this.manejoEliminar = function (id,url){
      //	--	Petición Ajax
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {'id' : id },
        success: function(data) {
        	if (data.status == 'ok'){
        		util_M.generarModal(data);
      			//	--	Evaluamos el Tipo de paginacion
        		if(tool.readCookie('busqueda') != null){
        			autopag('administracion/zpaginarResul',tool.readCookie('busqueda'));
        		}else{
        			autopag('administracion/paginarR');	//	--	Recargamos la tabla	
        		}
        	}else if (data.status == 'mal'){
        		util_M.generarModal(data);
        	}
        },
        error: function() {
        	var data = {'funcion' : 'Error al procesar la petición', 
        				'mensaje' : 'Error en le Servidor inténtalo mas tarde, disculpa las molestias.'};
          	util_M.generarModal(data);
        }
      });
  	}


	//	--	Funcion para Limpiar el formulario
	jQuery.fn.resetForm = function () {
  		$(this).each (function() { this.reset(); });
	}//	--	Fin Reset Form


	//	--	Funcion para limpiar el fomulario
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
	

  	/*	--	Funcion para cambiar contrasena
  	this.cambiarPass = function(){
  		//	--	Validamos el Formulario
		if($('#cambiarPass').valid()){
			//	--	Recolectamos los datos del Formulario
			var user_data  = $('#cambiarPass').serializeObject();
			//console.log(user_data);
			//	--	Petición Ajax(RegistrarUsuario)
		    $.ajax({
		        url: 'administracion/cambiarpass',
		        type: 'POST',
		        dataType: 'json',
		        data: user_data,
		        success: function(data) {
		        	if (data.status == 'ok'){
		        		$('#mod_contrasena').modal('hide');
		        		util_M.generarModal(data);	//	--	Operación Exitosa
		        		limpiarForm('#mod_contrasena');	//	--	Limpiamos Form
		        	}else if (data.status == 'mal'){
		        		util_M.generarModal(data);	//	--	Mostrando Errores
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


  	
  	
  	

}//	--	Fin

//-------------------------------------------------
//	--	Prototipo para Manejo de Tabs
function Utilidades_Tabs(){

  	//  --  Cambio de pestaña
  	$('#ref_gestion').on('click', '#btn_agregar ', function(e) {
      	$('#tab1').hide();
      	$('#tab2').fadeIn(500);
      	$('#busca').hide();
  	});

  	//	Boton para regresa a gestion
  	$('#modal_generico').on('click', '#ref_gestion_mod', function(e) {
  		$('#modal_generico').modal('hide');
      	$('#tab2').hide();
      $('#tab1').fadeIn(500);
      $('#busca').show();
  	});


  	//	--	Cambio de pestaña por Agregar Usuario
  	$('#btn_gestion').click(function(e) {
  		$('#busca').show();
      $('#tab2').hide();
      $('#tab1').fadeIn(500);

	    //	--	Limpiamos el Form y los Estilos
		$('#tab2').find(':input').each(function(){
	  		this.value = '';
	  		$(this).closest('.control-group').removeClass('success');
	  		$(this).closest('.control-group').removeClass('error');
		});
	    //	--	Limpiamos el label y su marca
	    $('#tab2').find('label').each(function(){
	      	if ($(this).hasClass('error') || $(this).hasClass('valid')){
	      		$(this).remove();
	      	}
	    });

	    //	--	Paginamos Nuevamente
	    var util_F = new Utilidades_Formularios();
	    util_F.paginando(1,'administracion/paginar');


    });	
}
function Cookies(){

	this.createCookie = function(name, value,days){
		if (days) {
      		var date = new Date();
      		date.setTime(date.getTime()+(days*24*60*60*1000));
      		var expires = "; expires="+date.toGMTString();
    	}else var expires = "";
      		document.cookie = name+"="+value+expires+"; path=/";
	}

  	this.readCookie = function(name) {
    	var nameEQ = name + "=";
    	var ca = document.cookie.split(';');
    	for(var i=0;i < ca.length;i++) {
      		var c = ca[i];
      		while (c.charAt(0)==' ') c = c.substring(1,c.length);
      		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    	}
    	return null;
  	}

}


	
  	