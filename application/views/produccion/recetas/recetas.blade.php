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
                <!-- Menu con Tabs -->
                <div class="tabbable tabs-left">

                    <!-- Items del Menu  -->
                    <ul class="nav nav-tabs">
                        <!-- Pesta&ntilde;a Activada -->
                        <li class="active">
                            <a href="#ref_gestion" data-toggle="tab" id="btn_gestion">
                                <center><h5>Gestión de Recetas</h5></center>
                            </a>
                        </li>
                    </ul>

                    <!-- Cuerpo de las Tabs -->
                    <div class="tab-content">

                        <div class="tab-pane active" id="ref_gestion">

                            <!-- Buscador de Recetas -->
                            @include('produccion.recetas.buscador_recetas')
                            <!-- Gestion de Recetas-->
                            @include('produccion.recetas.gestion_recetas')
                            <!-- Agregar una nueva Recetas -->
                            @include('produccion.recetas.agregar_receta')

                        </div>

                    </div>
                </div>
            </div>

        </section>

        <!-- Ventanas Emergentes  =================================================================================== -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicacion  =============================================================================== -->
        @include('util.footer')

        <!-- Script para Produccion -->
        {{ HTML::script('js/produccion/recetas/controladorAjax_Recetas.js') }}
        {{ HTML::script('js/produccion/recetas/utilidades_Recetas.js') }}
        
    </body>
</html>
