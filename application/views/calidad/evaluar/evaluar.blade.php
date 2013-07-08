<!doctype html>
<html lang="en">
    <!-- Header de la Aplicacion  =================================================================================== -->
    @include('util.head')
    <body>
        <!-- Barra Superior ===================================================================================-->
        @include('util.topbar')


        <!-- Contenedor Central ===================================================================================-->
        <section class=" row-fluid">

            <!-- Menu de la Vista  =================================================================================== -->
            @include('util.menu')


            <!-- Contenido =================================================================================== -->
            <div class="row-fluid contenedor_tabs span10 offset1">
                <!-- Menu con Tabs -->
                <div class="tabbable tabs-left">

                    <!-- Items del Menú  -->
                    <ul class="nav nav-tabs">

                        <!-- Pestaña Activada -->
                        <li class="active">
                            <a href="#ref_materia" data-toggle="tab" >
                                <center><h5>Materia Prima</h5></center>
                            </a>
                        </li>
                        <li>
                            <a href="#ref_terminado" data-toggle="tab" >
                                <center><h5>Lote terminado</h5></center>
                            </a>
                        </li>                                      
                    </ul>

                    <!-- Cuerpo de las Tabs -->
                                      
                    <div class="tab-content">                       
                                                
                        @include('calidad.evaluar.materia_prima')
                        @include('calidad.evaluar.producto_terminado')  
                        
 
                    </div><!-- Fin Cuerpo Pestañas -->                                         
                    
                </div>
            </div>

        </section>

        <!-- Ventanas Emergentes  =================================================================================== -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicacion  =================================================================================== -->
        @include('util.footer')
        
        <!-- ESto lo hice con Mario ATENCION  -->
        
		{{	HTML::script('js/calidad/Utilidades_Evaluar.js')}}
		{{	HTML::script('js/calidad/ControladorAjax_Evaluar.js')}}
       
    </body>
</html>
