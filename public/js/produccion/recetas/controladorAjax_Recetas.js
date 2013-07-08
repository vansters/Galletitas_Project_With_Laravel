jQuery(document).ready(function($) {
	
	//	--	Importando Objetos (Prototipos)
	var Util_T =  new Utilidades_Tabs();
	var Util_A =  new Utilidades_AJAX();
	var Util_F =  new Utilidades_Formularios();

//	==================================================================
//	--	Eventos (Jquery)

	//	--	Cambiar a pestaña de Agregar	
	
	$('#ref_gestion').on('click', '#btn_agregarReceta', function(e) {
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

	//	--	Agregar una Receta
	$('#ref_gestion').on('click', '#btn_agregar', function(e) {
		Util_A.agregarReceta('#form_agregarReceta','#alerta_registrarreceta','nuevaReceta/');
	});
	
	//Util_F.formModificarReceta();
	
	$('#ref_gestion').on('click', '.btn_modifReceta', function(e){
		var datos = '#controlMR'+this.id;
		var formulario = '#form_modReceta'+this.id;
		var modal = '#mod_info'+this.id;
		Util_A.modificarReceta(datos, formulario, modal, 'modificarReceta/')
	});
	
	$('#ref_gestion').on('click', '.btn_EliminarReceta', function(e){		
		var datos = '#controlMR2'+this.id;		
		var modal = '#eli_info'+this.id;
		Util_A.eliminarReceta(datos, modal, 'eliminarReceta/')			
	});
	
	$('#ref_gestion').on('click', '.pagination ul li a', function(){
		if (!($(this).parent('li').hasClass('active'))){
			Util_A.paginandoRecetas(this.id,'paginarReceta');
      		}
  	});

});