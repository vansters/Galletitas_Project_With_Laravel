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
                            <label>Nombre de Usuario *</label>
                            <input type="text" class="offset1" placeholder="Ejemplo (RFC): MEMM930201EL1" name="nomUsuario">
                        </p>
                        <p>
                            <label>Contraseña *</label>
                            <input type="password" class="offset1" name="passUsuario">
                        </p>
                        <p>
                            <input type="submit" value="Ingresar" class="btn btn-info span4 offset4"> 
                        </p>
                    </form>

                    <!-- Cuerpo del Formulario 	-->
                    <div class="row-fluid">
                        <!-- Alerta -->
                        <div class="alert alert-error span6 offset3">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{$error}}
                            <!-- Link para recuperar contraseña -->
                            <a data-toggle="modal" href="#modal_recContra" class="offset2">Recuperar Contraseña</a>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <!-- Footer de la Aplicación  =================================================================================== -->
        @include('util.footer')

        <!-- Ventanas Emergentes  =================================================================================== -->
        @include('home.mod_home')

    </body>
</html>

