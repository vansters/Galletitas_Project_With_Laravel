
@foreach($proveedores as $proveedor)

    <!-- Modal's Modificar Información -->
    <div id="mod_info{{$proveedor->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Modificar Información Proveedor</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal offset1" id="form_modProveedor-{{$proveedor->id}}">
            <div id="controles{{$proveedor->id}}">

                <!-- Datos del Proveedor Columna 1 -->
                <div class="span5">
                    
                    <div class="control-group hide">
                        <label for="nombre">ID </label>
                        <input type="text" class="input-large" value="{{$proveedor->id}}" name="id">
                    </div>

                    <div class="control-group">
                        <label for="nombre">Nombre *</label>
                        <input type="text" class="input-large" name="nombre" value="{{$proveedor->nombre}}">
                    </div>

                    <div class="control-group">
                        <label for="rfc">RFC *</label>
                        <input type="text" class="input-large" name="rfc" value="{{$proveedor->rfc}}">
                    </div>

                    <div class="control-group">
                        <label for="tel">Telefono *</label>
                        <input type="text" class="input-large" name="tel" value="{{$proveedor->telefono}}">
                    </div>

                    <div class="control-group">
                        <label for="estado">Estado *</label>
                        <select name="estado">
                            <option>{{$proveedor->estado}}</option>
                            @foreach ($estados as $estado)
                                <option>{{$estado}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="control-group">
                        <label for="delegacion">Delegacion *</label>
                        <input type="text" class="input-large" name="delegacion" value="{{$proveedor->delegacion}}">
                    </div>

                </div>

                <!-- Datos del Usuario Columna 2 -->
                <div class="span5" style="margin-bottom:30px; margin-left: 50px;">

                    <div class="control-group">
                        <label for="colonia">Colonia o localidad *</label>
                        <input type="text" class="input-large" name="colonia" value="{{$proveedor->colonia}}">
                    </div>

                    <div class="control-group">
                        <label for="calle">Calle *</label>
                        <input type="text" class="input-large" name="calle" value="{{$proveedor->calle}}">
                    </div>

                    <div class="control-group">
                        <label for="numero">Numero *</label>
                        <input type="text" class="input-large" name="numero" value="{{$proveedor->numero}}">
                    </div>

                    <div class="control-group">
                        <label for="codigo">Codigo Postal *</label>
                        <input type="text" class="input-large" name="codigo" value="{{$proveedor->codigo}}">
                    </div>

                    <div class="control-group">
                        <label for="correo">Correo Electronico*</label>
                        <input type="text" placeholder="proveedor@email.com" name="correo" value="{{$proveedor->correo}}">
                    </div>
                </div>

            </div>    
            </form>

        </div>

        <div class="modal-footer">
            <button class="btn btn-info btn_modificar" id="{{$proveedor->id}}">Guardar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
                
    </div>
@endforeach

@foreach($proveedores as $proveedor)
    <!-- Modal's Eliminar usuario -->
    <div id="eli_info{{$proveedor->id}}" class="modal_1 hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Eliminar Proveedor</h3>
        </div>
        <div class="modal-body">
            <div class="alert alert-error span12 ">
                ¿Deseas eliminar al proveedor <strong>{{$proveedor->nombre}}</strong> permanentemente del sistema?
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn_eliminar" data-dismiss="modal" id="{{$proveedor->id}}">Aceptar</button>
            <button class="btn" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
@endforeach