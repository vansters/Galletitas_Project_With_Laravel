jQuery(document).ready(function($) {

	//	--	Importando Objetos (Prototipos)
	var Util_T =  new Utilidades_Tabs();
	var Util_A =  new Utilidades_AJAX();
	var Util_F =  new Utilidades_Formularios();
	var Util_V =  new Utilidades_Varias();


	//	==================================================================
	//	--	Eventos (Jquery)

	//	--	Cambiar a pestaña de Agregar
	$('#ref_gestion').on('click', '#btn_agregarCliente', function(e) {
		Util_T.cambiarAgregar();
	});

	//	--	Cambiar a pestaña de Gestión
	$('#btn_gestion').click(function(e) {
		Util_T.cambiarGestion();
		Util_A.paginandoClientes(1,'paginarCliente');
	});

	//	--	Cambiar de Modal a Gestion
  	$('#modal_generico').on('click', '#ref_gestion_mod', function(e) {
  		Util_T.cambiarModal();
  	});

	//	--	Agregar un Nuevo Cliente
	$('#ref_gestion').on('click', '#btn_agregar', function(e) {
		Util_A.agregarCliente('#form_agregarCliente','#alerta_registrarcliente','agregarCliente');
	});

	//  --  Paginando Clientes (Usando Paginador)
  	$('#ref_gestion').on('click', '.pagination ul li a', function(){
      if (!($(this).parent('li').hasClass('active'))){ 
      	Util_A.paginandoClientes(this.id,'paginarCliente');
      }
  	});

  	//	--	Modificando Informacion de Cliente
  	$('#ref_gestion').on('click', '.btn_modificar', function(event){
      var datos 		= '#controles'+this.id;
      var formulario 	= '#form_modCliente-'+this.id;
      var modal      	= '#mod_info'+this.id;
      Util_F.formModificarCliente(formulario);
      Util_A.modificarCliente(formulario,datos,modal,'modificarCliente');
  	});

  	//	--	 Eliminar Informacion de Cliente
  	$('#ref_gestion').on('click', '.btn_eliminar', function(event){
    	Util_A.eliminarCliente(this.id,'eliminarCliente');
  	});

  	//	--	Buscar un Cliente
  	$('#buscadorClientes').typeahead({
  		minlength: 1,
  		items: 10,
  		source: function(query,process){
  			//  --  Petición Ajax autocompletado 
            $.post('buscarCliente', { query: query }, function(data) {
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


});