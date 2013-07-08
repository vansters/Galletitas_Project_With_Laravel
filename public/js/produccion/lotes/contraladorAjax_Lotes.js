jQuery(document).ready(function($) {
	
	//	--	Importando Objetos (Prototipos)
	var Util_T =  new Utilidades_Tabs();
	var Util_A =  new Utilidades_AJAX();
	var Util_F =  new Utilidades_Formularios();

//	==================================================================
//	--	Eventos (Jquery)

	//	--	Cambiar a pestaña de Agregar	
	
	$('#ref_gestion').on('click', '#btn_agregarLote', function(e) {
		Util_T.cambiarAgregar();
	});
	//cancelar
	$('#ref_gestion').on('click', '#cancel', function(e) {
		Util_T.cambiarGestion();
	});

	//	--	Cambiar a pestaña de Gestión
	$('#btn_gestion').click(function(e) {
		Util_T.cambiarGestion();
	});

	//	--	Agregar un Lote
	//	--	Agregar un Nuevo Cliente
	$('#ref_gestion').on('click', '#btn_agregar', function(e) {
		Util_A.agregarCliente('#form_agregarLote','#alerta_registrarlote','nuevoLote/');
	});
	
	Util_F.formModificarLote();
	
	$('#ref_gestion').on('click', '.btn_modifLote', function(e){
		var datos = '#controlML'+this.id;
		var formulario = '#form_modifLot'+this.id;
		var modal = '#mod_info'+this.id;
		Util_A.modificarLote(datos, formulario, modal, 'modificarLotePro/')
	});
	
	$('#ref_gestion').on('click', '.btn_EliminarLote', function(e){		
		var datos = '#controlEL'+this.id;		
		var modal = '#eli_info'+this.id;
		Util_A.eliminarLote(datos, modal, 'eliminarLotePro/')			
	});
	
	$('#ref_gestion').on('click', '.pagination ul li a', function(){
		if (!($(this).parent('li').hasClass('active'))){
			Util_A.paginandoLotes(this.id,'paginarLote');
      		}
  	});
  	
  	$('body').on('click', '.refresh', function(e){
		setTimeout("location.href='http://localhost/Galletitas/public/produccion/lotes';",500);
	});
	
	$('#buscadorLotes').typeahead({
  		minlength: 1,
  		items: 10,
  		source: function(query,process){
  			//  --  Petición Ajax autocompletado 
            $.post('buscarLote', { query: query }, function(data) {
                process(data['datos']);
            });
  		},
  		updater: function (item){
  			//  --  Generamos la Cookie            
            //	--	Re paginando la Tabla de gestión
            $('#tab1').load('paginarResultados', {item: item}, function(response, status, xhr) {
              if (status == 'error'){
                Util_T.mostrarError(); 
              }
            });

  		}
  	});

});
