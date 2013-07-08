
@foreach($ventas as $venta)

    <!-- Modal's Modificar Información -->
    <div id="mod_info{{$venta->id}}" class="modal_2 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Modificar Información Venta</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal" id="form_modVenta_{{$venta->id}}">
            <div id="controles{{$venta->id}}">

                <!-- Datos de la Venta Columna 1 -->
                <div class="span6">
                    <center><b>Contenido Actual</b></center>
                    <div class="control-group hide">
                        <label for="nombre">ID </label>
                        <input type="text" name="id" value="{{$venta->id}}">
                        <label for="nombre">Lotes Aprovados </label>
                        <input type="text" name="total_lotesAprovados" value="{{$total_lotesAprobados}}">
                    </div>

					<table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><center>Lote</center></th>
                                <th><center>Galletas</center></th>
                                <th><center>Eliminar</center></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($lotes_vendidos as $lote_vendido)
                                @if($lote_vendido->id_venta == $venta->id)
                                    <tr>
                                    	<td>{{$lote_vendido->id_lote}}</td>
    								    @foreach($galletas as $galleta)
                                            @if($galleta->id == $lote_vendido->galleta_id)
                                                <td><center>{{$galleta->nombre}}</center></td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <center>
                                                <input type="checkbox" name="id_lote_vendido_{{$lote_vendido->id}}" value="{{$lote_vendido->id}}">
                                            </center>
                                        </td>
                                    </tr>
                                @endif
							@endforeach
                        </tbody>
					</table>

                    <div class="control-group">
                        <b>Fecha de Entrega:</b> <input type="date" name="fecha" value="{{$venta->fecha_entrega}}">
                    </div>
                    <div class="control-group">
                        <b>Entregado:</b> <input type="checkbox" name="estado" value="entregado">
                    </div>
                    <div class="control-group">
                        <b>Total:</b> ${{$venta->total}}
                    </div>
                </div>

                <!-- Datos de la Venta Columna 2 -->
                <div class="span6" >
                    <center><b>Lotes Disponibles</b></center>
                    @if($total_lotesAprobados != 0)
		            <div class="control-group">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><center>Lote</center></th>
                                    <th><center>Galletas</center></th>
                                    <th><center>Precio</center></th>
                                    <th><center>Agregar</center></th>
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach($lotes_aprobados as $lote_aprobado)
                                <tr>
                                    <td>{{$lote_aprobado->id_lote}}</td>
                                    @foreach($galletas as $galleta)
                                        @if($galleta->id == $lote_aprobado->galleta_id)
                                            <td><center>{{$galleta->nombre}}</center></td>
                                        @endif
                                    @endforeach
                                    <td>$ {{$lote_aprobado->precio}}</td>
                                    <td>
                                        <center>
                                            <input type="checkbox"  name="id_lote_aprobado_{{$lote_aprobado->id}}" value="{{$lote_aprobado->id}}">
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <br/><br/><h5 align="center">No hay lotes para agregar a la venta</h5>
                    @endif
                </div>

            </div>    
            </form>

        </div>

        <div class="modal-footer">
            <button class="btn btn-info btn_modificar" id="{{$venta->id}}">Guardar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
                
    </div>

    <!-- Modal's Eliminar Venta -->
    <div id="eli_info{{$venta->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Cancelar Venta</h3>
        </div>

        <div class="modal-body">
            <div class="alert alert-error span12 ">
                ¿Deseas Cancelar la Venta?
            </div>
            <form class="form-horizontal offset1" id="form_eliminar_{{$venta->id}}">
                <div id="controles{{$venta->id}}">
                     <div class="control-group hide">
                        <label for="nombre">ID </label>
                        <input type="text" class="input-large" name="id" value="{{$venta->id}}">
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn btn-info btn_cancelar" id="{{$venta->id}}">Si</button>
            <button class="btn" data-dismiss="modal">No</button>
        </div>
    </div>
@endforeach
