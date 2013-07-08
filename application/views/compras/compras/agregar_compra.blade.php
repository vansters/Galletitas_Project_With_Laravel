<div id="tab2" class="hide">
    <!-- Alerta con Instrucciones -->
   <!-- Buscador -->

   
    <div class="row-fluid span10  offset1" id="buscaProveedoresCompras">
        
        <!-- Alerta con Instrucciones -->
        <div class="row-fluid alert alert-info span11 " id="alerta_Gestion">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Instrucciones:</strong> Usa el buscador de proveedores para filtrar resultados o utiliza el paginador.
        </div>

        <center>
            <input type="text" class="span8" data-provide="typeahead" 
                data-items="5" placeholder="Ingresa busqueda  RFC, Correo, Nombre o Estado." id="buscadorProveedoresCompras" autocomplete="off">
        </center>
        <center>
            <!-- combo -->
            <div id = "combo">
                @include('compras.compras.combo')
            </div>
        </center>

    </div>

    <div class="row-fluid">
 
        <!-- Datos para el Sistema -->
        <div class="form-horizontal span8 offset2">
            <center><h5>Selecciona una Materia Prima</h5></center>
            <table class="table table-bordered table-striped " class="elementos1" id = "tablaMP">
                <thead>
                    <tr>
                        <th >ID</th>
                        <th class="span3">Materia Prima</th>
                        <th class="span1">Cantidad</th>
                        <th class="span2">Precio</th>
                        <th >Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>            
        </div>
        <!--  Botones   ===================================================================================-->
        <div class="row-fluid span10">
            <hr>
            <a href="#" class="btn btn-info span3 offset3">Agregar</a>
            <a href="#" class="btn  span3">Cancelar</a>  
        </div>
    </div>

</div>