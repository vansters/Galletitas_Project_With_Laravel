
//	--	Función main JavaScript
$(document).ready(function($) {
	//	--	Importando objetos
  //var util_F = new Utilidades_Formularios();
  var util_A = new Utilidades_Ajax();
  var Util_T = new Utilidades_Tabs();
  var conteoM = 0;

//  --  Cambiar a pestaña de Agregar
  $('#ref_gestion').on('click', '#btn_agregarVenta', function(e) {
    Util_T.cambiarAgregar();
  });

  //  --  Cambiar a pestaña de Gestión
  $('#btn_gestion').click(function(e) {
    Util_T.cambiarGestion();
    Util_A.paginandoVentas(1,'paginarVenta');
  });

  //  --  Cambiar a pestaña de Gestión
  $('#btn_agregarVenta').click(function(e) {
    Util_T.cambiarAgregar();
  });

  //  --  Cambiar de Modal a Gestion
    $('#modal_generico').on('click', '#ref_gestion_mod', function(e) {
      Util_T.cambiarModal();
    });

//Alta de Venta

$('.tab-content').on('click', '#btn_altaVenta', function(event){
  console.log('ALTA empeso');
  var datos = '#controles';
  var formulario = '#Agregar_venta';
  util_A.AgregarVenta(formulario, 'agregarVenta');
});

//  --  Paginando Ventas (Usando Paginador)
    $('#ref_gestion').on('click', '.pagination ul li a', function(){
      console.log('Hi');
      if (!($(this).parent('li').hasClass('active'))){ 
        util_A.paginandoVentas(this.id,'paginarVenta');
      }
    });

//Modificar de Venta

$('.tab-content').on('click', '.btn_modificar', function(event){
  var datos = '#controles'+this.id;
  var formulario = '#form_modVenta_'+this.id;
  var modal = '#mod_info'+this.id;
  util_A.modificarVenta(formulario, datos, modal, 'modificarVenta');
});

//Cancelar Venta
    $('#ref_gestion').on('click', '.btn_cancelar', function(event){
      var datos = '#controles'+this.id;
      var formulario = '#form_eliminar_'+this.id;
      var modal = '#eli_info'+this.id;
      util_A.cancelarVenta(formulario, datos, modal, 'cancelarVenta');
    });

});// --  Fin de JQuery