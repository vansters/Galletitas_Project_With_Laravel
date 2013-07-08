
@foreach($clientes as $cliente)

    <!-- Modal's Modificar Información -->
    <div id="mod_info{{$cliente->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Modificar Información Cliente</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal offset1" id="form_modCliente-{{$cliente->id}}">
            <div id="controles{{$cliente->id}}">

                <!-- Datos del Cliente Columna 1 -->
                <div class="span5">
                    
                    <div class="control-group hide">
                        <label for="nombre">ID </label>
                        <input type="text" class="input-large" value="{{$cliente->id}}" name="id">
                    </div>

                    <div class="control-group">
                        <label for="nombre">Nombre *</label>
                        <input type="text" class="input-large" name="nombre" value="{{$cliente->nombre}}">
                    </div>

                    <div class="control-group">
                        <label for="rfc">RFC *</label>
                        <input type="text" class="input-large" name="rfc" value="{{$cliente->rfc}}">
                    </div>

                    <div class="control-group">
                        <label for="tel">Teléfono *</label>
                        <input type="text" class="input-large" name="tel" value="{{$cliente->telefono}}">
                    </div>

                    <div class="control-group">
                        <label for="estado">Estado *</label>
                        <select name="estado">
                            <option>{{$cliente->estado}}</option>
                            @foreach ($estados as $estado)
                                <option>{{$estado}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="control-group">
                        <label for="delegacion">Delegación/Municipio  *</label>
                        <input type="text" class="input-large" name="delegacion" value="{{$cliente->delegacion}}">
                    </div>

                </div>

                <!-- Datos del Usuario Columna 2 -->
                <div class="span5" style="margin-bottom:30px; margin-left: 50px;">

                    <div class="control-group">
                        <label for="colonia">Colonia/Localidad *</label>
                        <input type="text" class="input-large" name="colonia" value="{{$cliente->colonia}}">
                    </div>

                    <div class="control-group">
                        <label for="calle">Calle *</label>
                        <input type="text" class="input-large" name="calle" value="{{$cliente->calle}}">
                    </div>

                    <div class="control-group">
                        <label for="numero">Número *</label>
                        <input type="text" class="input-large" name="numero" value="{{$cliente->numero}}">
                    </div>

                    <div class="control-group">
                        <label for="codigo">Código Postal *</label>
                        <input type="text" class="input-large" name="codigo" value="{{$cliente->codigo}}">
                    </div>

                    <div class="control-group">
                        <label for="correo">Correo Electrónico *</label>
                        <input type="text" placeholder="cliente@email.com" name="correo" value="{{$cliente->correo}}">
                    </div>
                </div>

            </div>    
            </form>

        </div>

        <div class="modal-footer">
            <button class="btn btn-info btn_modificar" id="{{$cliente->id}}">Guardar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
                
    </div>
@endforeach

@foreach($clientes as $cliente)
    <!-- Modal's Eliminar usuario -->
    <div id="eli_info{{$cliente->id}}" class="modal_1 hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Eliminar Cliente</h3>
        </div>
        <div class="modal-body">
            <div class="alert alert-error span12 ">
                ¿Deseas eliminar al cliente <strong>{{$cliente->nombre}}</strong> permanentemente del sistema?
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn_eliminar" data-dismiss="modal" id="{{$cliente->id}}">Aceptar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
@endforeach