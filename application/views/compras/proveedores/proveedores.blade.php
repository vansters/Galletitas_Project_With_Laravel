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
                                <center><h5>Gestión de Proveedores</h5></center>
                            </a>
                        </li>
                    </ul><!-- Fin  Menú Pestañas-->

                    <!-- Cuerpo de las Pestañas -->
                    <div class="tab-content">

                        <!-- Gestión de Usuarios -->
                        <div class="tab-pane active" id="ref_gestion">

                            <!-- Buscador -->
                            @include('compras.proveedores.buscador_proveedores')
                            <!-- Gestión de Clientes -->
                            @include('compras.proveedores.gestion_proveedores')
                            <!-- Agregar Nuevo Cliente al sistema -->
                            @include('compras.proveedores.agregar_proveedor')

                        </div>

                    </div><!-- Fin Cuerpo Pestañas -->

                </div><!-- Fin Pestañas-->

            </div><!-- Fin Contenedor Secundario-->

        </section>

        <!-- Ventanas Emergentes -->
        @include('util.mod_recpass')
        @include('compras.proveedores.mod_proveedores')

        <!-- Pie de la pagina -->
        @include('util.footer')
        <!-- Script para Clientes -->
        {{ HTML::script('js/compras/contraladorAjax_Proveedores.js') }}
        {{ HTML::script('js/compras/utilidades_Proveedores.js') }}

    </body>

</html>