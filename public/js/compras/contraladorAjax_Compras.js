jQuery(document).ready(function($) {

	//	--	Importando Objetos (Prototipos)
	var Util_T =  new Utilidades_Tabs();
	var Util_A =  new Utilidades_AJAX();
	var Util_F =  new Utilidades_Formularios();
	var Util_V =  new Utilidades_Varias();

  var busqueda = '';


	//	==================================================================
	//	--	Eventos (Jquery)

  $('#tab2').on('click', '#btn_agregarMP', function(event) {
    $('#buscadorProveedoresCompras').val(busqueda);
    cadena = "<tr>";
    cadena = cadena + "<td>" + "RIC" + "</td>";
    cadena = cadena + "<td>" + $("#comboMateriaPrima").val() + "</td>";
    cadena = cadena + "<td>" + $("#cantidad").val() + "</td>";
    cadena = cadena + "<td>" + "RIC" + "</td>";
    cadena = cadena + "<td>" + "<i class=\"icon-remove\" style=\"margin-left: 20px; cursor:pointer \"></i>" + "</td>";
    $("#tablaMP tbody").append(cadena);
    //$('.elementosMP').append("<td>row 1, cell 1</td>");
  });
  

  $("#btn_agregarMP").click(function(){
    cadena = "<tr>";
    cadena = cadena + "<td>" + "RIC" + "</td>";
    cadena = cadena + "<td>" + $("#comboMateriaPrima").val() + "</td>";
    cadena = cadena + "<td>" + $("#cantidad").val() + "</td>";
    cadena = cadena + "<td>" + "RIC" + "</td>";
    cadena = cadena + "<td>" + "<i class=\"icon-remove\" style=\"margin-left: 20px; cursor:pointer \"></i>" + "</td>";
    $("#tablaMP tbody").append(cadena);
    //$('.elementosMP').append("<td>row 1, cell 1</td>");
  }); 

	//	--	Cambiar a pestaña de Agregar
	$('#ref_gestion').on('click', '#btn_agregarCompra', function(e) {
		Util_T.cambiarAgregar();
	});

	//	--	Cambiar a pestaña de Gestión
	$('#btn_gestion').click(function(e) {
		Util_T.cambiarGestion();
		Util_A.paginandoCompras(1,'paginarCompra');
	});

	//	--	Cambiar de Modal a Gestion
  	$('#modal_generico').on('click', '#ref_gestion_mod', function(e) {
  		Util_T.cambiarModal();
  	});

	//	--	Agregar un Nuevo Compra
	$('#ref_gestion').on('click', '#btn_agregar', function(e) {
		Util_A.agregarCompra('#form_agregarCompra','#alerta_registrarcompra','agregarCompra');
	});

	//  --  Paginando Compras (Usando Paginador)
  	$('#ref_gestion').on('click', '.pagination ul li a', function(){
      if (!($(this).parent('li').hasClass('active'))){ 
      	Util_A.paginandoCompras(this.id,'paginarCompra');
      }
  	});

  	//	--	Modificando Informacion de Compra
  	$('#ref_gestion').on('click', '.btn_modificar', function(event){
      var datos 		= '#controles'+this.id;
      var formulario 	= '#form_modCompra-'+this.id;
      var modal      	= '#mod_info'+this.id;
      Util_F.formModificarCompra(formulario);
      Util_A.modificarCompra(formulario,datos,modal,'modificarCompra');
  	});

  	//	--	 Eliminar Informacion de Compra
  	$('#ref_gestion').on('click', '.btn_eliminar', function(event){
    	Util_A.eliminarCompra(this.id,'eliminarCompra');
  	});

  	/*	--	Cambiar Contrasena de Usuario
  	$('#btn_cambiarPass').click(function(event){
    	console.log('Funciona');
    	Util_A.cambiarPass();
  	});*/

  	//	--	Buscar un Compra
  	$('#buscadorCompras').typeahead({
  		minlength: 1,
  		items: 10,
  		source: function(query,process){
  			//  --  Petición Ajax autocompletado 
            $.post('buscarCompra', { query: query }, function(data) {
                process(data['datos']);
            });
  		},
  		updater: function (item){
  			//  --  Generamos la Cookie
            console.log(item);
            Util_V.crearCookie("busqueda", item, 1);
            //	--	Re paginando la Tabla de gestión
            $('#tab1').load('paginarResultadosCompra', {item: item}, function(response, status, xhr) {
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
            $.post('buscarProveedorCompras', { query: query }, function(data) {
                process(data['datos']);
            });
      },
      updater: function (item){
            
            $('#buscadorProveedoresCompras').attr('disabled','-1');
            busqueda = item;
            console.log(item);
            //  --  Re paginando la Tabla de gestión
            $('#combo').load('llenarCombosCompras', {item: item}, function(response, status, xhr) {
              if (status == 'error'){
                Util_T.mostrarError(); 
              }
            });
      },
    });


});