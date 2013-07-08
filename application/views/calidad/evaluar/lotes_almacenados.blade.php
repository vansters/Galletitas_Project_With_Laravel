<div class="tab-pane" id="ref_almacenados">
    <!-- Alerta con Instrucciones -->
    <div class="row-fluid alert alert-info span11">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Instrucciones:</strong> Ingresa la informaci&oacute;n solicitada. 
        <strong>¡Recuerda!</strong> todos los campos marcados con * son obligatorios.
    </div>

    <div class="row-fluid span11">
        <!-- Datos del lote -->
        <form class="form-horizontal offset1" id='form_registrarLote'>
        
        <label><b>Informaci&oacute;n del lote</b></label>
        <div class="span5">
            <div class="control-group">
                    <label>Identificador del lote: *</label>
                    <input type="text" class="input-large" name="iden_lote"/>
            </div>
               <div class="control-group">			
            <label>Galleta producida:</label>
            <input type="text" class="input-large" name="ga_producida"/>
                 </div>
                        <div class="control-group">
            <label>Fecha de producci&oacute;n:</label>
            <input type="date" class="input-large" name="fe_producion" />
                             </div>
		   ‎<div class="control-group">
            <label>Fecha de caducidad:</label>
            <input type="date" class="input-large" name="fe_caducidad">
            </div>
            		   ‎<div class="control-group">
            <label>Fecha arribo al almac&eacute;n: *</label>
            <input type="date" class="input-large" name="fe_arribo"/>
                        </div>           
             </div>      
            <div class="span5">
             ‎<div class="control-group">
            <label>Integridad del lote: *</label>
            <select name="integridad">
                <option>Buena</option>
                <option>Media</option>
                <option>Mala</option>
            </select>
            </div>
            ‎<div class="control-group">
            <label>¿Aun es comerciable?: *</label>
            <select name="comerciable">
                <option>Si</option>
                <option>No</option>
            </select>
            </div>
            ‎<div class="control-group">
            <label>Comentarios del lote: *</label>
            <textarea rows="4" cols="40" name="comentarios"></textarea>
            </div>
         </div>   
            </div>
       </form>
       
    <div  class=" row-fluid span9 offset2">
        <a href="#" class="btn btn-info span3 offset1" id="btn_enviarLote">Evaluar</a>
        <a href="#" class="btn  span3">Cancelar</a>
    </div>
    
    
</div>