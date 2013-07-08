@foreach($galletas as $galleta)  
<!-- Ventanas Emergentes  =================================================================================== -->
        <!-- Modal's Modificar -->

    <div id="mod_info{{$galleta->id}}" class="modal_1 hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h3>Modificar Información de una Receta</h3></center>
            </div>

            <div class="modal-body" id="controlMR{{$galleta->id}}">
 
                    <form class="form-horizontal" id="form_modReceta{{$galleta->id}}" >

                        <center>
                            <div class="control-group">
                                <label> Tipo de Receta *</label>
                                <input type="text" class="hide" name="galleta" value="{{$galleta->id}}">
                                {{$galleta->nombre}}
                            </div>
                        </center>

                        </center><h4>Información de Ingredientes</h4></center>
                        @foreach($recetarios as $recetario)
                            @foreach($catalogos as $catalogo)
                                @if(($galleta->id==$recetario->galleta_id) && ($recetario->catalogo_mp_id==$catalogo->id))
                                        <div class="span5">
                                            <label>Ingrediente : </label>
                                            {{$catalogo->nombre}}
                                            <!--<input type="text" class="input-large form-horizontal" name="" value="{{$catalogo->nombre}}"> -->
                                        </div>

                                        <div class="span5">
                                            <label>Cantidad : </label>
                                            <input type="text" class="input-mini form-horizontal" name="cantidad{{$recetario->id}}" value="{{$recetario->cantidad}}">
                                        </div>
                                @endif
                            @endforeach
                        @endforeach
                    </form>  
            </div>

            <div class="modal-footer">
                <button class="btn btn-info btn_modifReceta" id="{{$galleta->id}}">Guardar</button>
                <button class="btn" data-dismiss="modal">Cerrar</button>
            </div>
    </div>
@endforeach




<!-- Modal's Eliminar-->
@foreach($galletas as $galleta)
        <div id="eli_info{{$galleta->id}}" class="modal_1 hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Eliminar Receta</h3>
            </div>
            
            <div class="modal-body" id="controlMR2{{$galleta->id}}">
                <div class="alert alert-error span12">
                    ¿Deseas eliminar la receta  <strong>{{$galleta->nombre}}&nbsp;&nbsp;
                    </strong>permanentemente del sistema?
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-info btn_EliminarReceta" data-dismiss="modal" id="{{$galleta->id}}">Aceptar</button>
                <button class="btn" data-dismiss="modal">Cancelar</button>
            </div>
        </div> 
@endforeach