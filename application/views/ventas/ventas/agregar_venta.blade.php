<div id="tab2">
    @if($total_lotesAprobados != 0)
        <!-- Alerta con Instrucciones -->
        <div class="row-fluid alert alert-info span10">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Instrucciones:</strong> Ingresa la información solicitada <strong>Recuerda</strong> todos los campos marcados con *  son obligatorios.
        </div>

        <form class="form-horizontal span8 offset1" id="Agregar_venta">

            <div class="row-fluid span12" id="controles">
                <h5>Seleccione un Cliente *</h5> 
                <div class="row-fluid">
                    <select name="cliente" class="row-fluid">
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row-fluid">
                    <hr> 
                    <h5>Agregar Producto *</h5>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><center>Lote</center></th>
                            <th><center>Galletas</center></th>
                            <th><center>Precio</center></th>
                            <th><center>Agregar</center></th>
                        </tr>
                        @foreach($lotes_aprobados as $lote_aprobado)
                            <tr>
                                <td><center>{{$lote_aprobado->id_lote}}</center></td>
                                @foreach($galletas as $galleta)
                                    @if($galleta->id == $lote_aprobado->galleta_id)
                                        <td><center>{{$galleta->nombre}}</center></td>
                                    @endif
                                @endforeach
                                <td><center>{{$lote_aprobado->precio}}</center></td>
                                <td><center><input type="checkbox" class="input-large" name="id_lote_aprobado_{{$lote_aprobado->id}}" value="{{$lote_aprobado->id}}"></center></td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="row-fluid">
                    <hr>  
                    <br/>
                    <b>Fecha de Entrega:</b> <input type="date" name="fecha">
                    <a href="#" class="btn btn-info btn_altaVenta offset2" id='btn_altaVenta'>Agregar Venta</a>
                </div>
            </div>
        </form>

        <div class="row-fluid span10">
            
        </div>
    @else
        <div class="row-fluid span12">
            <br/><br/><h5 align="center">No hay lotes para vender</h5>
        </div>
    @endif
</div>
