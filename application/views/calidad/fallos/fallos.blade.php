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
                            <a href="#ref_fallos" data-toggle="tab">
                                <center><h5>Visualizar Fallos</h5></center>
                            </a>
                        </li>     
                        <li>                                                                 
                            <a href="#ref_quejas" data-toggle="tab">
                                <center><h5>Visualizar Quejas</h5></center>
                            </a>
                        </li>                                              
                    </ul>

                    <!-- Cuerpo de las Tabs -->
                    <div class="tab-content">
                        <!-- Tab Evaluación de Producto Terminado -->
                        @include('calidad.fallos.visualizar_fallos')
                        @include('calidad.fallos.visualizar_queja')

                    </div>
                </div>
            </div>

        </section>

        <!-- Ventanas Emergentes  =================================================================================== -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicación  =================================================================================== -->
        @include('util.footer')
        
        {{	HTML::script('js/calidad/Utilidades_Evaluar.js')}}
		  {{	HTML::script('js/calidad/ControladorAjax_Evaluar.js')}}        
        
    </body>
</html>
