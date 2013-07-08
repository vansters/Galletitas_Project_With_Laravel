//  ====================================================
//  --  Prototipo para Manejo de Tabs
function Utilidades_Tabs () {
  
  var Util_V = new Utilidades_Varias();

  //  --  Cambiar de Gestión a Agregar
  this.cambiarAgregar = function(){
    $('#tab1').hide();
    $('#tab2').fadeIn(500);
    $('#buscaVentas').hide();
  }
  //  --  Cambiar de Agregar a Gestión
  this.cambiarGestion =  function() {
    $('#buscaVentas').show();
    $('#tab2').hide();
    $('#tab1').fadeIn(500);
    //Util_V.limpiarAgregarVentas();
  }
  //  --  Cambiar de Modal a Gestión
  this.cambiarModal = function(){
    $('#modal_generico').modal('hide');
        $('#tab2').hide();
        $('#tab1').fadeIn(500);
        $('#buscaVentas').show();
        Util_V.autoPaginacionVentas('autoPaginarVentas');
  }

}

function Utilidades_Ajax(){

  var Util_T = new Utilidades_Varias;

  this.AgregarVenta = function (formulario ,url) {
    //  --  Validamos el Formulario
    if ($(formulario).valid()){
      //  --  Recolectamos los datos del Formulario
      var data = $(formulario).serializeObject();
      //  --  Petición Ajax(AgregarVenta)
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(data, textStatus, xhr) {
          if (xhr.status == 200){
            Util_T.mostrarModal(data);
          }else{
            Util_T.mostrarModal(data);
          }
        },
        error: function() { Util_T.mostrarError(); }
      });
    }
  }// --  Fin

  //  --  Paginado Venta (Usando Paginador)
  this.paginandoVentas = function (pagina,url) {
    $('#tab1').load(url, { 'pagina': pagina }, function(response, status, xhr) {
        if (xhr.status == 201){
              Util_T.mostrarError();
        }
    }); 
  }// --  Fin

  //  --  Modificar Venta
  this.modificarVenta = function(form,campos,modal,url)
  {
    //  --  Validando Formulario
    if($(form).valid())
    {
      //  --  Recolectamos los datos del Formulario
      var venta_data = $(campos).serializeObject();
      //  --  Petición Ajax(Modificarventa)
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: venta_data,
        success: function(data, textStatus, xhr) {
          if ( xhr.status ==  200){
            $(modal).modal('hide').fadeOut('slow'); 
            setTimeout(function(){ Util_T.mostrarModal(data); },500);
            if (Util_T.leerCookie('busqueda') != null){
              Util_T.autoPaginacionVentas('paginarResultadosVentas',Util_T.leerCookie('busqueda'));
            }else{
              Util_T.autoPaginacionVentas('autoPaginarVentas');
            }
          }else{
            Util_T.mostrarModal(data);
          }
        },
        error: function(){ 
          Util_T.mostrarError(); 
          $(modal).modal('hide');
        }
      });
    }
  }// --  Fin

  //Cancelar Venta
  this.cancelarVenta = function(form,campos,modal,url){
    //  --  Validando Formulario
    if($(form).valid()){
      //  --  Recolectamos los datos del Formulario
      var venta_data = $(campos).serializeObject();
      //  --  Petición Ajax(Modificarventa)
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: venta_data,
        success: function(data, textStatus, xhr){
          if(xhr.status == 200){
            $(modal).modal('hide').fadeOut('slow');
            setTimeout(function(){ Util_T.mostrarModal(data); },500);
            if (Util_T.leerCookie('busqueda') != null){
              Util_T.autoPaginacionVentas('paginarResultadosVentas',Util_T.leerCookie('busqueda'));
            }else{
              Util_T.autoPaginacionVentas('autoPaginarVentas');
            }
          }else{
            Util_T.mostrarModal(data);
          }
        },
        error: function() 
        { 
          Util_T.mostrarError(); 
          $(modal).modal('hide');
        }
      });
      
    }
  }// --  Fin

}

//  ====================================================
//  --  Prototipo Utilidades Varias
function Utilidades_Varias(){

  //  --  Modal Genérico
  this.mostrarModal = function(datos){
    $('#modal_generico .modal-header h3').html(datos.funcion);
    $('#modal_generico .modal-body ').html(datos.mensaje);
    $('#modal_generico .modal-footer').html(datos.opciones);
    $('#modal_generico').modal('show');
  }

  //  --  Modal Error Fatal
  this.mostrarError = function(){
    $('#modal_generico .modal-header h3').html('Error al procesar la petición');
    $('#modal_generico .modal-body ').html( 'Error en le Servidor inténtalo mas tarde,'+ 
                         'disculpa las molestias.');
    $('#modal_generico .modal-footer').html('<button class="btn" data-dismiss="modal">Cerrar</button>');
    $('#modal_generico').modal('show');
  }
  
  //  --  Error Formulario Mostrar alerta
  this.errorFormulario = function (idAlerta){
    $(idAlerta).attr('class', 'alert alert-error span8 offset1');
    $(idAlerta).html('<strong> Error : </strong> Por favor corrija los campos en color rojo.');
  }

  //  --  Crear un Cookie
  this.crearCookie = function(name, value,days){
    if (days) {
          var date = new Date();
          date.setTime(date.getTime()+(days*24*60*60*1000));
          var expires = "; expires="+date.toGMTString();
      }else var expires = "";
          document.cookie = name+"="+value+expires+"; path=/";
  }

  //  --  Leer una Cookie
    this.leerCookie = function(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for(var i=0;i < ca.length;i++) {
          var c = ca[i];
          while (c.charAt(0)==' ') c = c.substring(1,c.length);
          if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
    }

    //  --  Auto Paginacion (Mantener Tabla Actualizada Siempre)
    this.autoPaginacionVentas =  function(url,param){
      $('#tab1').load(url, {item: param},function(response, status, xhr) {
        if (xhr.status != 200){
          this.mostrarError();
        }
    });
    }

    //  --  Paginar Desde Cero
    this.autoPaginacionVentasInit =  function(url){
      $('#tab1').load('',function(response, status, xhr) {
        if (xhr.status != 200){
          this.mostrarError();
        }
    });
    }
}