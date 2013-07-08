@foreach($compras as $compra)

    <!-- Modal's Modificar Información -->
    <div id="mod_info{{$compra->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Modificar Información Compra</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal offset1" id="form_modCompra-{{$compra->id}}">
            <div id="controles{{$compra->id}}">

                <!-- Datos de Compra Columna 1 -->
                <div class="span5">
                    
                    <div class="control-group hide">
                        <label for="id">ID </label>
                        <input type="text" class="input-large" value="{{$compra->id}}" name="id">
                    </div>

                    <div class="control-group">
                        <label for="fecha">Fecha de entrega *</label>
                        <input type="text" class="input-large" name="fecha_entrega" value="{{$compra->fecha_entrega}}">
                    </div>

                    <div class="control-group">
                        <label for="total">Total *</label>
                        <input type="text" class="input-large" name="total" value="{{$compra->total}}">
                    </div>

                    <div class="control-group">
                        <label for="proveedor_id">Proveedor *</label>
                        <input type="text" class="input-large" name="tel" value="{{$compra->proveedor_id}}">
                    </div>

                   
                </div>
            </div>    
            </form>

        </div>

        <div class="modal-footer">
            <button class="btn btn-info btn_modificar" id="{{$compra->id}}">Guardar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
                
    </div>
@endforeach

@foreach($compras as $compra)
    <!-- Modal's Eliminar usuario -->
    <div id="eli_info{{$compra->id}}" class="modal_1 hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Eliminar Compra</h3>
        </div>
        <div class="modal-body">
            <div class="alert alert-error span12 ">
                ¿Deseas eliminar la compra <strong>{{$compra->nombre}}</strong> permanentemente del sistema?
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn_eliminar" data-dismiss="modal" id="{{$compra->id}}">Aceptar</button>
            <button class="btn" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
@endforeach