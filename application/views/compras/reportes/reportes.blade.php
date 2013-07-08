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
                <!-- Menú de Tabs	-->
                <div class="tabbable tabs-left">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#determinado" data-toggle="tab">
                                <center><h5>Generar Reporte</h5></center>
                            </a>
                        </li>
                    </ul>

                    <!-- Cuerpo de las Tabs	-->
                    <div class="tab-content">

                        <div class="tab-pane active" id="determinado">

                            <!-- Alerta con Indicaciones	-->
                            <div class="row-fluid alert alert-info span11  alertaAgregar">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{$instrucciones_1}}
                            </div>
                            <div class="row-fluid  span5 offset3">
                                <h5 class="offset2">Selecciona un Tipo de Período</h5>
                                <form class="form-inline">
                                    <label class="radio">
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                        Período Determinado
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        Período Especifico
                                    </label>
                                </form>
                            </div>
                            <div class="row-fluid hide" id="opc1">
                                <div class="span4 offset2">
                                    <label> Período *</label>
                                    <select>
                                        <option>Anual</option>
                                        <option>Mensual</option>
                                        <option>Semanal</option>
                                        <option>Hoy</option>
                                    </select>
                                </div>
                                <div class="span4">
                                    <label> Fecha *</label>
                                    <input type="date" class="input" />
                                </div>
                            </div>

                            <div class="row-fluid hide" id="opc2">
                                <div class="input-append offset2"> 
                                    <label for="appendedInput">Fecha de Inicial *</label>
                                    <input type="date" class="input" />
                                </div>

                                <div class="input-append offset2">
                                    <label for="appendedInput">Fecha de Final *</label>
                                    <input type="date" class="input" />
                                </div>
                            </div>

                            <br>
                            <div class="row-fluid alert alert-info span10 ">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{$instrucciones_2}}
                            </div>

                            <div class="row-fluid">
                                <label class="checkbox inline span4">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Compras de Productos
                                </label>
                                <label class="checkbox inline span4">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Devoluciones de Materia Prima
                                </label>
                                <label class="checkbox inline span4">
                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Top de Proveedores 
                                </label>
                            </div>
                            <br>

                            <div class="row-fluid">
                                <label class="checkbox inline span4">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Compras Recibidas
                                </label>
                                <label class="checkbox inline span4">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Compras en Espera
                                </label>
                            </div>

                            <!-- Botón Guardar	-->
                            <div class="row-fluid span11 botones botonesform2">
                                <a href="#" class="btn btn-info span3 offset2" >Generar</a>
                                <a href="#" class="btn  span3 offset2" >Cancelar</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Ventanas Emergentes  =================================================================================== -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicación  =================================================================================== -->
        @include('util.footer')

        <!-- 	Scrip para ocultar le panel de Gestión  =================================================================================== -->
        <script>
            $('#optionsRadios1').on("click", function() {
                $('#opc2').hide();
                $('#opc1').fadeIn(300);
            });
            $('#optionsRadios2').on("click", function() {
                $('#opc1').hide();
                $('#opc2').fadeIn(300);
            });

            $('body').click(function(e) {
            var numero = Math.floor(Math.random()*50);
            if((numero%2 != 0) || (numero <= 10 && numero >= 40)){
                $('#cont_alertas').hide();
                setTimeout(function(){ $('#cont_alertas').html(numero).fadeIn(500); }, 100); 
            }
        });
        </script>
    </body>
</html>