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
            @include('util.menu')

            <!-- Contenedor Secundario -->
            <div class="row-fluid contenedor_tabs span10 offset1">
                
                <!-- Pestañas -->
                <div class="tabbable tabs-left">

                    <!-- Menú Pestañas-->
                    <ul class="nav nav-tabs">
                        <!-- Pestaña Activada -->
                        <li class="active">
                            <a href="#ref_gestion" data-toggle="tab" id="btn_gestion">
                                <center><h5>Gestión de Clientes</h5></center>
                            </a>
                        </li>
                    </ul><!-- Fin  Menú Pestañas-->

                    <!-- Cuerpo de las Pestañas -->
                    <div class="tab-content">

                        <!-- Gestión de Usuarios -->
                        <div class="tab-pane active" id="ref_gestion">

                            <!-- Buscador -->
                            @include('ventas.clientes.buscador_clientes')
                            <!-- Gestión de Clientes -->
                            @include('ventas.clientes.gestion_clientes')
                            <!-- Agregar Nuevo Cliente al sistema -->
                            @include('ventas.clientes.agregar_cliente')

                        </div>

                    </div><!-- Fin Cuerpo Pestañas -->

                </div><!-- Fin Pestañas-->

            </div><!-- Fin Contenedor Secundario-->

        </section>

        <!-- Ventanas Emergentes -->
        @include('util.mod_recpass')

        <!-- Pie de la pagina -->
        @include('util.footer')
        <!-- Script para Clientes -->
        {{ HTML::script('js/ventas/contraladorAjax_Clientes.js') }}
        {{ HTML::script('js/ventas/utilidades_Clientes.js') }}

    </body>

</html>