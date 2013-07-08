jQuery(document).ready(function($) {

	//	--	Cambiar Contrasena de Usuario
  	$('#btn_cambiarPass').click(function(event){
    	//console.log('Funciona');
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
		        		mostrarModal(data);	//	--	Operación Exitosa
		        	}else if (data.status == 'mal'){
		        		mostrarModal(data);	//	--	Mostrando Errores
		        	}
		        },
		        error: function() {
		        	//	--	Error Fatal en El Servidor
		          	util_M.modalErrorServer();
		        }
		      }); 
		}else{
			//	--	Error a Validar los Datos
		}
  	});//	--	Fin


  	//	--	Modal Genérico
	function mostrarModal(datos){
		$('#modal_generico .modal-header h3').html(datos.funcion);
		$('#modal_generico .modal-body ').html(datos.mensaje);
		$('#modal_generico .modal-footer').html(datos.opciones);
		$('#modal_generico').modal('show');
	}//	--	Fin


  	//	--	Validar Formulario cambiar contraseña
	$('#cambiarPass').validate({
		rules:{
			actualPass: {required: true,minlength: 3,accept: "[a-zA-Z0-9_-]"},
			nuevoPass: {required: true,minlength: 6,accept: "[a-zA-Z0-9_-]",},
		    conPass: {required: true,minlength: 6,accept: "[a-zA-Z0-9_-]",equalTo: "#nuevoPass"}
		},
		messages:{
			actualPass: {
              required: 	"Campo obligatorio",
              minlength: 	"Al menos debe tener 6 caracteres ",
              accept: 		"Unicamente letras, números o guiones"
            },
            nuevoPass: {
              required: 	"Campo obligatorio",
              minlength: 	"Al menos debe tener 6 caracteres ",
              accept: 		"Unicamente letras, números o guiones"
            },
	        conPass: {
	          required: 	"Campo obligatorio",
	          minlength: 	"Al menos debe tener 6 caracteres ",
	          accept: 		"Unicamente letras, números o guiones",
	          equalTo: 		"Las contraseña no coinciden"
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



});