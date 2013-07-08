<!-- Modal's Eliminar  -->      
@foreach($lotes  as $lote)
	<div id="eli_info{{$lote->id}}" class="modal_2 hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Eliminar Lote </h3>
            </div>
            <div class="modal-body" id="controlEL{{$lote->id}}">
            	<input type="hidden" name="id" value="{{$lote->id}}"/>
                <div class="row-fluid alert alert-error span11">                    
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php $galleta3=Galleta::find($lote->galleta_id); ?>
                    El Lote con el ID <strong>{{$lote->id_lote}}</strong> con Producto: <strong>{{$galleta3->nombre}}</strong> se eliminara de forma permanente del sistema.
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info btn_EliminarLote" data-dismiss="modal" id="{{$lote->id}}">Aceptar</button>
                <button class="btn" data-dismiss="modal">Cancelar</button>
            </div>
        </div>  
@endforeach


<!-- Modal's Modificar -->
@foreach($lotes  as $lote)

        <div id="mod_info{{$lote->id}}" class="modal_1 hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Modificar Información de un Lote  </h3>
            </div>
            <div class="modal-body" id="controlML{{$lote->id}}">
                <center>
                    <h4>Informaci&oacute;n t&eacute;cnica del lote</h4>
                    <br>
                    <label><strong>ID Lote: </strong><i>{{$lote->id_lote}}</i></label>
                    <?php $galleta2=Galleta::find($lote->galleta_id); ?>
                    
                    <label><strong>Galleta:</strong> <i>{{$galleta2->nombre}}</i></label>
                    <label><strong>Fecha de Caducidad:</strong> <i>{{$lote->fecha_caducidad}}</i></label>
                    <label><strong>Fecha de Producci&oacute;n:</strong> <i>{{$lote->fecha_produccion}}</i></label>
                    <br>
     			    <hr>
                </center>
 			
        		<form class="form-horizontal" id="form_modifLot{{$lote->id}}">
                    <center><h4>Informaci&oacute;n a modificar</h4></center>
                    <input type="hidden" name="id" value="{{$lote->id}}"/>
                    <br>
                    <div class="span5 offset1">
                        <label><strong>Fecha de Caducidad *</strong></label>
                        <input type="date" class="input-large" name="fCad"/ value="{{$lote->fecha_caducidad}}"> 
                    </div>

                    <div class="span5">
                       <label><strong>Fecha de Produccion *</strong></label>
                        <input type="date" class="input-large" name="fProduc" value="{{$lote->fecha_produccion}}"/> 
                    </div>
                </form>  
            </div>

            <div class="modal-footer">
                <button class="btn btn-info btn_modifLote" id="{{$lote->id}}">Guardar</button>
                <button class="btn" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
@endforeach
