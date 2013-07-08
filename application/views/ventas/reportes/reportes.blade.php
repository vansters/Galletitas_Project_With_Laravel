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
                <!-- Menu de Tabs   -->
                <div class="tabbable tabs-left">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#determinado" data-toggle="tab">
                                <center><h5>Generar Reporte</h5></center>
                            </a>
                        </li>
                    </ul>

                    <!-- Cuerpo de las Tabs -->
                    <div class="tab-content">

                        <div class="tab-pane active" id="determinado">

                            <!-- Alerta con Indicaciones    -->
                            <div class="row-fluid alert alert-info span11  alertaAgregar">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Instrucciones:</strong> Ingresa la información solicitada <strong>Recuerda</strong>todos los campos marcados con *  son obligatorios.
                            </div>

                            <!-- Eleccion dle Periodo del Reporte  -->
                            <div class="row-fluid  span11">
                                <h5 class="offset4">Selecciona el Período</h5>
                                <form class="row-fluid" id="periodo">
                                    <!-- Perido de Evaluacion para el Reporte    -->
                                    <div class="row-fluid" id="opc2">
                                        <div class="input-append offset1"> 
                                            <label>Fecha Inicial *</label>
                                            <input type="date" class="input" name="fechaInicio"/>
                                        </div>

                                        <div class="input-append offset2">
                                            <label>Fecha Final *</label>
                                            <input type="date" class="input" name="fechaFinal"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <hr class="span10">

                            <!-- Alerta con Indicaciones    -->
                            <div class="row-fluid span10 offset1">
                                <div class="span3">
                                    <center>
                                        <button class="btn btn-info" id="repoVentas">
                                            {{ HTML::image('/img/report-icon.png') }}
                                            <br>
                                            <h5>Reporte Ventas</h5>
                                        </button>
                                    </center>
                                </div>
                                <div class="span3">
                                    <center>
                                        <button class="btn btn-info" id="repoClientes">
                                            {{ HTML::image('/img/report-icon.png') }}
                                            <br>
                                            <h5>Reporte Clientes</h5>
                                        </button>
                                    </center>
                                </div>
                                <div class="span3">
                                    <center>
                                        <button class="btn btn-info" id="repoProductos">
                                            {{ HTML::image('/img/report-icon.png') }}
                                            <br>
                                            <h5>Reporte Productos</h5>
                                        </button>
                                    </center>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Ventanas Emergentes   -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicación   -->
        @include('util.footer')

        <!-- 	Scrip para ocultar le panel de Gestión   -->
        {{ HTML::script('js/ventas/controladorAjax_reportes.js') }}

    </body>
</html>