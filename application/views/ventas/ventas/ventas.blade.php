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
                                <center><h5>Gestión de Ventas</h5></center>
                            </a>
                        </li>
                        <!-- Pestaña Activada -->
                        <li>
                            <a href="#ref_agregar" data-toggle="tab" id="btn_agregarVenta">
                                <center><h5>Alta de Ventas</h5></center>
                            </a>
                        </li>
                    </ul><!-- Fin  Menú Pestañas-->

                    <!-- Cuerpo de las Pestañas -->
                    <div class="tab-content">

                        <!-- Gestión de Usuarios -->
                        <div class="tab-pane active" id="ref_gestion">
                            <!-- Gestión de Ventas -->
                            @include('ventas.ventas.gestion_ventas')
                        </div>

                        <div class="tab-pane" id="ref_agregar">
                            <!-- Agregar Nueva Venta al sistema -->
                            @include('ventas.ventas.agregar_venta')
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
        {{ HTML::script('js/ventas/controladorAjax_ventas.js') }}
        {{ HTML::script('js/ventas/utilidades_ventas.js') }}

    </body>

</html>
