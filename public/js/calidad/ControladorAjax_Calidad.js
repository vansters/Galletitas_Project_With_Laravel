//	--	Función main JavaScript
jQuery(document).ready(function($) {
	
	//	--	Importando objetos
  var util_F = new Utilidades_Formularios();	
  var util_V = new Utilidades_Validacion();  

	//	--	Registrando Nuevo Usuario
$('#btn_queja').click(function(event) {     
		     util_F.enviarRegistrarQueja('#form_servicio',
                                    '#alerta_registrarUsuario',
                                    'registrar');                                    	
	});	
//  --  Buscar una Materia Prima
    $('#buscadorLote').typeahead({
      minlength: 1,
      items: 10,
      source: function(query,process){
        //  --  Petición Ajax autocompletado 
            $.post('buscarLote', { query: query }, function(data) {
                process(data['datos']);
            });
      }
      /*updater: function (item){
        //  --  Generamos la Cookie
            Util_V.crearCookie("busqueda", item, 1);            
      }*/
    });

});

