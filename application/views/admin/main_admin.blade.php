<!doctype html>
<html lang="en">

<!-- Cabecera de la Pagina -->
@include('util.head')

    <body>
        <!-- Barra Superior -->
        @include('util.topbar')


        <!-- Contenedor Primario -->
        <section class=" row-fluid">

            <!--  Barra de Menú para el Modulo -->
            <div class="row-fluid header_tab span10 offset1">
                <h3>{{Auth::user()->depto}}</h3>
            </div>

            <!-- Contenedor Secundario -->
            <div class="row-fluid contenedor_tabs span10 offset1">

                <!-- Pestañas -->
                <div class="tabbable tabs-left">

                    <!-- Menú Pestañas-->
                    <ul class="nav nav-tabs">
                        <!-- Pestaña Activada -->
                        <li class="active">
                            <a href="#ref_inicio" data-toggle="tab"><center><h5>Inicio</h5></center></a>
                        </li>
                        <li>
                            <a href="#ref_gestion" data-toggle="tab" id="btn_gestion"><center><h5>Gestión de Usuarios</h5></center></a>
                        </li>
                    </ul><!-- Fin  Menú Pestañas-->

                    <!-- Cuerpo de las Pestañas	-->
                    <div class="tab-content">

                        <!-- Bienvenida al Sistema -->
                        <div class="tab-pane active" id="ref_inicio"><h4>Bienvenido</h4></div>

                        <!-- Gestión de Usuarios -->
                        <div class="tab-pane" id="ref_gestion">

                            <!-- Buscador -->
                            @include('admin.usuarios.buscador_usuarios')
                            <!-- Gestion de Usuarios -->
                            @include('admin.usuarios.usuarios')
                            <!-- Agregar Nuevo Usuario al sistema -->
                            @include('admin.usuarios.agregar_usuario')
                            

                        </div>

                    </div><!-- Fin Cuerpo Pestañas -->

                </div><!-- Fin Pestañas-->

            </div><!-- Fin Contenedor Secundario-->

        </section>

        <!-- Ventanas Emergentes -->
        @include('util.mod_recpass')
        

        <!-- Pie de la pagina -->
        @include('util.footer')
        <!-- Script para Administración -->
        {{ HTML::script('js/administracion/controladorAjax.js') }}
        {{ HTML::script('js/administracion/utilidades.js') }}
    </body>
</html>