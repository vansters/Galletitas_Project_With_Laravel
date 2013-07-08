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
                                <center><h5>Gestión de Compras</h5></center>
                            </a>
                        </li>
                    </ul><!-- Fin  Menú Pestañas-->

                    <!-- Cuerpo de las Pestañas -->
                    <div class="tab-content">

                        <!-- Gestión de Usuarios -->
                        <div class="tab-pane active" id="ref_gestion">

                            <!-- Buscador -->
                            @include('compras.compras.buscador_compras')
                            <!-- Gestión de Clientes -->
                            @include('compras.compras.gestion_compras')
                            <!-- Agregar Nuevo Cliente al sistema -->
                            @include('compras.compras.agregar_compra')

                        </div>

                    </div><!-- Fin Cuerpo Pestañas -->

                </div><!-- Fin Pestañas-->

            </div><!-- Fin Contenedor Secundario-->

        </section>

        <!-- Ventanas Emergentes -->
        @include('util.mod_recpass')
        @include('compras.compras.mod_compras')

        <!-- Pie de la pagina -->
        @include('util.footer')
        <!-- Script para Clientes -->
        {{ HTML::script('js/compras/contraladorAjax_Compras.js') }}
        {{ HTML::script('js/compras/utilidades_Compras.js') }}

    </body>

</html>