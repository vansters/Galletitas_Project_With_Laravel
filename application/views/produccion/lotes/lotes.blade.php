<!doctype html>
<html lang="en">
    <!-- Header de la Aplicación  =================================================================================== -->
    @include('util.head')
    <body>
        <!-- Barra Superior ===================================================================================-->
        @include('util.topbar')


        <!-- Contenedor Central ===================================================================================-->
        <section class=" row-fluid">

            <!-- Menu de la Vista  =================================================================================== -->
            @include('util.menu')


            <!-- Contenido -->
            <div class="row-fluid contenedor_tabs span10 offset1">
                <!-- Menú con Tabs -->
                <div class="tabbable tabs-left">

                    <!-- Items del Menú  -->
                    <ul class="nav nav-tabs">
                        <!-- Pesta&ntilde;a Activada -->
                        <li class="active">
                            <a href="#ref_gestion" data-toggle="tab" id="btn_gestion">
                                <center><h5>Gestión de Lotes</h5></center>
                            </a>
                        </li>  
                    </ul>

                    <!-- Cuerpo de las Tabs -->
                    <div class="tab-content">

                        <div class="tab-pane active" id="ref_gestion">

                            <!-- Buscador de Lotes -->
                            @include('produccion.lotes.buscador_lotes')
                            <!-- Gestion de Lotes-->
                            @include('produccion.lotes.gestion_lotes')
                            <!-- Agrega Nuevo lote al Sistema -->
                            @include('produccion.lotes.alta_lote')                           

                        </div>

                    </div>
                </div>
            </div>

        </section>

        <!-- Ventanas Emergentes  -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicación -->
        @include('util.footer')


        <!-- Script para Clientes -->
        {{ HTML::script('js/produccion/lotes/contraladorAjax_Lotes.js') }}
        {{ HTML::script('js/produccion/lotes/utilidades_Lotes.js') }}

    </body>
</html>
