<div id="tab2" class="hide">

    <!-- Alerta con Instruciones -->
    <div class="row-fluid alert alert-info span11" id="alerta_registrarlote'">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Instrucciones:</strong> Ingresa la informaci&oacute;n solicitada. 
		<strong>¡Recuerda!</strong> todos los campos marcados con * son obligatorios.
    </div>

    <form class="form-horizontal offset1" id="form_agregarLote">
        <div class="span8 offset3">
            <?php $iii=date("Ymdhis"); ?>
            <input type="hidden" value="{{$iii}}" name="idLote"/>
            <label><b>Alta de un lote de productos</b></label>
        </div>
        
        <div class="span5">
            
            <div class="control-group">
                <label>Línea de Producción: *</label>
                <select name="linea">
                    <option value="LP1"> Línea de producción 1     </option>
                    <option value="LP2"> Línea de producción 2     </option>
                    <option value="LP3"> Línea de producción 3     </option>
                </select>  
            </div>

            <div class="control-group">
                <label>Fecha de Producción: *</label>
                <input type="date" class="input-large" name="fProduc"/>
            </div>

            <div class="control-group">
                <label>Fecha de Caducidad: *</label>
                <input type="date" class="input-large" name="fCad" />    
            </div> 

        </div>

        <div class="span5">

           <div class="control-group">
                <label>Tipo de Galleta: *</label>
                <select name="galleta">
                    @foreach($galletas  as $galleta)
                    	<option value="{{$galleta->id}}">{{$galleta->nombre}} </option>
                    @endforeach                    
                </select>  
            </div>

            <div class="control-group">
                 <label>Cantidad de Paquetes: *</label>
                <input type="number" step="1000" max="5000" min="0" class="input-large" name="cantidad" />   
            </div>

            <div class="control-group">
                 <label>Estado: *</label>
                <input type="text" class="input-large" name="estado" value="Pendiente" disabled="disabled"/>   
            </div>

        </div>

    </form>
	
    <div class="row-fluid span10">
        <hr class="span11"/>
        <a href="#" class="btn btn-info span3 offset3" id="btn_agregar">Agregar</a>
        <a href="#" class="btn  span3" id="cancel">Cancelar</a>
    </div>
</div>
