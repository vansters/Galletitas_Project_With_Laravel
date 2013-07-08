
//	--	Función main JavaScript
jQuery(document).ready(function($) {
	
	//	--	Importando objetos
  var util_F = new Utilidades_Formularios();
  var util_T = new Utilidades_Tabs();
  var util_V = new Utilidades_Validacion();
  var tool = new Cookies();


	//	--	Registrando Nuevo Usuario
	$('#btn_agregarUsuario').click(function(event) {
      util_F.enviarRegistrarUsuario('#form_registrarUsuario',
                                    '#alerta_registrarUsuario',
                                    'administracion/registrar');
	});

  //  --  Paginando Usuarios
  $('#ref_gestion').on('click', '.pagination ul li a', function(){
      if (!($(this).parent('li').hasClass('active'))){ 
          util_F.paginando(this.id,'administracion/paginar');
      }
  });

  //  --  Modificar Usuario
  $('#ref_gestion').on('click', '.btn_modificar', function(event){
      var datos =  '#controles'+this.id;
      var formulario = '#form_modUsuario-'+this.id;
      var modal      = '#mod_info'+this.id;
      util_V.formModificarUsuario(formulario);
      util_F.enviarModificarUsuario(formulario,datos,modal,'administracion/modificar');
  });

  //  --  Eliminar Usuario
  $('#ref_gestion').on('click', '.btn_eliminar', function(event){
    util_F.manejoEliminar(this.id,'administracion/eliminar');
  });


  //  --  Buscar Usuarios
  $('#buscadorUsuarios').typeahead({
        minLength: 1,
        source: function(query, process) {
            //  --  Petición Ajax autocompletado 
            $.post('administracion/buscar', { query: query }, function(data) {
                process(data['datos']);
            });
        },
        updater: function (item) {
            //  --  Generamos la Cookie
            tool.createCookie("busqueda", item, 1);
            //console.log(tool.readCookie("busqueda"));
            //  --  Repaginado de la Tabla de Gestión
            $('#tab1').load('administracion/paginarResul', {item:tool.readCookie("busqueda")}, function(response, status, xhr) {
              if (status == 'error'){
                var data = {'funcion' : 'Error al procesar la petición', 
                            'mensaje' : 'Error en le Servidor inténtalo mas tarde, disculpa las molestias.'};
                  util_M.generarModal(data);
              }
            });
        },
        items: 10
    });


  /*  --  Recuperar Contraseña (Enviar Mensaje)
  $('#btn_recuperarPass').click(function(event){
    var query = $('#recuperarPass').val();
    //alert(query);
    $('#formRecuperaPass').hide();
    $('#imagenCarga').show();
    $.ajax({
      url: '/recuperarPass',
      type: 'POST',
      dataType: 'json',
      data: {id: query},
      success: function(data, textStatus, xhr) {
        if (xhr.status == 200){
          $('#imagenCarga').hide();
          $('#info').html('<center>Revisa tu correo para restablecer contraseña.</center>');
          $('#info').show();
          setTimeout("location.href = 'http://galletitaescom.pagodabox.com/';",5000);
        }else if (xhr.status == 202){
          $('#imagenCarga').hide();
          $('#info').html('<center>Error de envio intentalo mas tarde, disculpa las molestias. Redireccionando ...</center>');
          $('#info').show();
          setTimeout("location.href = 'http://galletitaescom.pagodabox.com/';",5000);
        }else{
          $('#imagenCarga').hide();
          $('#info').html('<center>El Correo o RFC introducido es incorrecto. Redireccionando ...</center>');
          $('#info').show();
          setTimeout("location.href = 'http://galletitaescom.pagodabox.com/';",5000);
        }
      }
    });
    
  });*/

/*
setTimeout(function(){
            $('#imagenCarga').hide();
            $('#recuperarPass').value = '';
            $('#formRecuperaPass').show();},2000); */





});// --  Fin de JQuery







