@foreach($usuarios as $usuario)

    <!-- Modal's Modificar Información -->
    <div id="mod_info{{$usuario->id}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Modificar Información</h3>
        </div>

        <div class="modal-body">

                <form class="form-horizontal offset3" id="form_modUsuario-{{$usuario->id}}">
                <div id="controles{{$usuario->id}}">

                    <div class="control-group hide">
                        <label for="nombre">ID </label>
                        <input type="text" class="input-large" value="{{$usuario->id}}" name="id">
                    </div>

                    <div class="control-group">
                        <label for="nombre">Nombre (s) </label>
                        <input type="text" class="input-large" value="{{$usuario->nombre}}" name="nombre">
                    </div>

                    <div class="control-group">
                        <label for="apPaterno">Apellido Paterno </label>
                        <input type="text" class="input-large" value="{{$usuario->appaterno}}" name="apPaterno">
                    </div>

                    <div class="control-group">
                        <label for="apMaterno">Apellido Materno </label>
                        <input type="text" class="input-large requerido" value="{{$usuario->apmaterno}}" name="apMaterno">
                    </div>

                    <div class="control-group">
                        <label for="depto">Departamento </label>
                        <select name="depto">
                                    <option selected="selected">{{$usuario->depto}}</option>
                            @foreach ($departamentos as $departamento)
                                @if($departamento != $usuario->depto)
                                    <option>{{$departamento}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="control-group">
                        <label for="rfc">Nombre de Usuario (RFC) </label>
                        <input type="text" class="input-large" value="{{$usuario->rfc}}" name="rfc">
                    </div>

                    <div class="control-group">
                        <label for="correo">Correo Electrónico </label>
                        <input type="text" value="{{$usuario->correo}}" name="correo">
                    </div>
                    
                </div>      
                </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn_modificar" id="{{$usuario->id}}">Guardar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
@endforeach


@foreach($usuarios as $usuario)
    <!-- Modal's Eliminar usuario -->
    <div id="eli_info{{$usuario->id}}" class="modal_1 hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Eliminar Usuario</h3>
        </div>
        <div class="modal-body">
            <div class="alert alert-error span12 ">
                ¿Deseas eliminar al usuario <strong>{{$usuario->nombre}}&nbsp;&nbsp;{{$usuario->appaterno}}
                &nbsp;&nbsp;{{$usuario->apmaterno}}</strong> permanentemente del sistema?
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn_eliminar" data-dismiss="modal" id="{{$usuario->id}}">Aceptar</button>
            <button class="btn" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
@endforeach