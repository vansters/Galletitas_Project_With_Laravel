jQuery(document).ready(function($) {

	//	--	Importando Objetos (Prototipos)
	var Util_T =  new Utilidades_Tabs();
	var Util_A =  new Utilidades_AJAX();
	var Util_F =  new Utilidades_Formularios();
	var Util_V =  new Utilidades_Varias();


	//	==================================================================
	//	--	Eventos (Jquery)

	//	--	Cambiar a pestaña de Agregar
	$('#ref_gestion').on('click', '#btn_agregarProveedor', function(e) {
		Util_T.cambiarAgregar();
	});

	//	--	Cambiar a pestaña de Gestión
	$('#btn_gestion').click(function(e) {
		Util_T.cambiarGestion();
		Util_A.paginandoProveedores(1,'paginarProveedor');
	});

	//	--	Cambiar de Modal a Gestion
  	$('#modal_generico').on('click', '#ref_gestion_mod', function(e) {
  		Util_T.cambiarModal();
  	});

	//	--	Agregar un Nuevo Proveedor
	$('#ref_gestion').on('click', '#btn_agregar', function(e) {
		Util_A.agregarProveedor('#form_agregarProveedor','#alerta_registrarproveedor','agregarProveedor');
	});

	//  --  Paginando Proveedores (Usando Paginador)
  	$('#ref_gestion').on('click', '.pagination ul li a', function(){
      if (!($(this).parent('li').hasClass('active'))){ 
      	Util_A.paginandoProveedores(this.id,'paginarProveedor');
      }
  	});

  	//	--	Modificando Informacion de Proveedor
  	$('#ref_gestion').on('click', '.btn_modificar', function(event){
      var datos 		= '#controles'+this.id;
      var formulario 	= '#form_modProveedor-'+this.id;
      var modal      	= '#mod_info'+this.id;
      Util_F.formModificarProveedor(formulario);
      Util_A.modificarProveedor(formulario,datos,modal,'modificarProveedor');
  	});

  	//	--	 Eliminar Informacion de Proveedor
  	$('#ref_gestion').on('click', '.btn_eliminar', function(event){
    	Util_A.eliminarProveedor(this.id,'eliminarProveedor');
  	});

  	/*	--	Cambiar Contrasena de Usuario
  	$('#btn_cambiarPass').click(function(event){
    	console.log('Funciona');
    	Util_A.cambiarPass();
  	});*/

  	//	--	Buscar un Proveedor
  	$('#buscadorProveedores').typeahead({
  		minlength: 1,
  		items: 10,
  		source: function(query,process){
  			//  --  Petición Ajax autocompletado 
            $.post('buscarProveedor', { query: query }, function(data) {
                process(data['datos']);
            });
  		},
  		updater: function (item){
  			//  --  Generamos la Cookie
            Util_V.crearCookie("busqueda", item, 1);
            //	--	Re paginando la Tabla de gestión
            $('#tab1').load('paginarResultados', {item: item}, function(response, status, xhr) {
              if (status == 'error'){
                Util_T.mostrarError(); 
              }
            });

  		}
  	});

    $('#buscadorProveedoresCompras').typeahead({
      minlength: 1,
      items: 10,
      source: function(query,process){
        //  --  Petición Ajax autocompletado 
            $.post('buscarProveedor', { query: query }, function(data) {
                process(data['datos']);
            });
      },
    });


});