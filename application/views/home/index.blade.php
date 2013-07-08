<!doctype html>
<html lang="en">

    <!-- Cabecera de la Pagina -->
    @include('util.head')

    <body>
        <!-- Barra Superior -->
        <header>
            <div class="row-fluid">
                <div class="span12 barra_sup"></div>
            </div>
        </header>

        <!-- Contenedor Primario -->
        <section class="row-fluid">

            <!-- Logo de la Empresa  -->
            <div class="row-fluid barra_logo">
                <div class="span4 yeah1">
                    <h3>Galletitas S.A. de C.V.</h3>
                </div>
                <div class="offset10">
                    {{ HTML::image('/img/icono.jpg') }}
                </div>
            </div>

            <div class="contenedor">

                <div class="row-fluid">
                    <!-- Cuerpo del Formulario  -->
                    <form class="span4 offset4 body_formulario" action="{{ URL::to('administracion') }}" method="POST">
                        <p>
                            <label for="nomUsuario" class="control-label">Nombre de Usuario *</label>
                            <input type="text" class="offset1 requerido" placeholder="Ejemplo(RFC): MEMM930201EL1" name="nomUsuario">
                        </p>
                        <p>
                            <label for="passUsuario" class="control-label">Contraseña *</label>
                            <input type="password" class="offset1 requerido" name="passUsuario">
                        </p>
                        <p>
                            <input type="submit"  class="btn btn-info span4 offset4" value="Ingresar">
                        </p>
                    </form>

                    <!-- Pie del Vista 	-->
                    <div class="row-fluid">
                        <!-- Alerta -->
                        <div class="alert alert-info span6 offset3" id="alertaLogin" >
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Todos!</strong> los campos marcados con * son obligatorios.
                            <!-- Link para recuperar contraseña -->
                            <a data-toggle="modal" href="#modal_recContra" class="offset1">Recuperar Contraseña</a>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <!-- Footer de la Aplicación  -->
        @include('util.footer')

        <!-- Ventanas Emergentes -->
        @include('home.mod_home')

        
        <script type="text/javascript">

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
                  setTimeout("location.href = 'http://localhost/Galletitas/public/';",5000);
                }else if (xhr.status == 202){
                  $('#imagenCarga').hide();
                  $('#info').html('<center>Error de envió inténtalo mas tarde, disculpa las molestias. Redireccionando ...</center>');
                  $('#info').show();
                  setTimeout("location.href = 'http://localhost/Galletitas/public/';",5000);
                }else if(xhr.status == 201){
                  $('#imagenCarga').hide();
                  $('#info').html('<center>El correo o RFC introducido es incorrecto. Redireccionando ...</center>');
                  $('#info').show();
                  setTimeout("location.href = 'http://localhost/Galletitas/public/';",5000);
                }
              }
            });
          });

        </script>

    </body>
</html>

