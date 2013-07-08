//	--	Prototipo para Manejo de Validaciones
function Utilidades_Validacion(){

	//  --  Validando Formulario de Registro de Queja
	$('#form_servicio').validate({
		    rules: {
		      iden_lote: {required: true,accept:"[0-9_{14}$A-Z_{2}$0-9_{2}$]"},		      
		      cliente_id: {required: true,number: true},
		      fecha: {required: true},		      
		      modulo: {required: true},
		      comentarios: {required: true},		    
		    },
		    messages: {
		      iden_lote: {
		      	required: "Campo obligatorio",
		      	accept: "Ingresa un lote existente",
		      			      },
		      cliente_id: {
		      	required: "Campo obligatorio",
		      	number: "Ingresa unicamente numeros"
		      },
		      fecha: {
		      	required: "Campo obligatorio",
		      			      },
		      modulo: {
		      	required: "Campo obligatorio",
		  		      },		     
		      comentarios: {
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

	//  --  Agregando Métodos de Validación al plugin (No Modificar este Método)
	jQuery.validator.addMethod("accept", function(value, element, param) {
	  return value.match(new RegExp("." + param + "$"));
	});

		}
		
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

function Utilidades_Formularios(){

	var util_A = new Utilidades_Alertas();
	var util_V = new Utilidades_Validacion();
	var util_M = new Utilidades_Mensajes();
	

	//	--	Enviar Formulario de Registro de Usuario	
	 	
	this.enviarRegistrarQueja= function (form,alert,url){
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
	        		util_M.generarModal(data);	//	--	Operación Exitosa	        		
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
	}//	--	Fin Registrar Queja
	

	
}
		    