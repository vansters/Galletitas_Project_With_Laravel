<!doctype html>
<html lang="en">
    <!-- Header de la Aplicación  =================================================================================== -->
    @include('util.head')
    <body>
        <!-- Barra Superior ===================================================================================-->
        @include('util.topbar')


        <!-- Contenedor Central ===================================================================================-->
        <section class=" row-fluid">

            <!-- Menú de la Vista  =================================================================================== -->
            @include('util.menu')


            <!-- Contenido =================================================================================== -->
            <div class="row-fluid contenedor_tabs span10 offset1">
                <!-- Menu con Tabs -->
                <div class="tabbable tabs-left">

                    <!-- Items del Menú  -->
                    <ul class="nav nav-tabs">

                        <!-- Pesta&ntilde;a Activada -->
                        <li class="active">
                            <a href="#ref_servicio" data-toggle="tab">
                                <center><h5>Atencion al Cliente</h5></center>
                            </a>
                        </li>                                              
                    </ul>

                    <!-- Cuerpo de las Tabs -->
                    <div class="tab-content">
                        <!-- Tab Evaluación de Producto Terminado -->
                        @include('calidad.quejas.servicio_cliente')

                    </div>
                </div>
            </div>

        </section>

        <!-- Ventanas Emergentes  =================================================================================== -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicación  =================================================================================== -->
        @include('util.footer')
        
        {{	HTML::script('js/calidad/Utilidades.js') }}
		{{	HTML::script('js/calidad/ControladorAjax_Calidad.js') }}                
        
    </body>
</html>
