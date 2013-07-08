<div class="tab-pane active" id="ref_servicio">

    <!-- Alerta con Instrucciones -->
    <div class="row-fluid alert alert-info span11">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Instrucciones:</strong> Ingresar el lote y el resto de la informaci&oacute;n. 
        <strong>Recuerda</strong> todos los campos marcados con *  son obligatorios.
    </div>
 <!-- <div class="row-fluid span11"> -->
        <!-- Datos del lote -->
        <form class="form-horizontal offset1" id='form_servicio'>
        <br>
        <br>
        <br>
        <label><b>Informaci&oacute;n de la Queja</b></label>
        <br>
        <br>
        <div class="span5">
            <div class="control-group">
                    <label>Identificador del lote: *</label>
                   <!-- <input type="text" class="input-large" name="iden_lote"/>-->
    <input type="text" class="input-large"  data-provide="typeahead" data-items="5" 
    placeholder="Ingresa búsqueda  Id" id="buscadorLote" autocomplete="off" name="iden_lote">
            </div>           
             <div class="control-group">
            <label>Modulo:</label>
          <select name="modulo">                
                <option>Ventas</option>
                <option>Producion</option>
            </select>  
              </div>	               ‎            
             </div> 
          <div class="span5">                                
            <div class="control-group">
            <label>Comentarios: *</label>
            <textarea rows="4" cols="40" name="comentarios"></textarea>
            </div>                                                                    	              
         </div>
            <!-- </div> -->
       </form>
       <br>
       <br>
    <div  class=" row-fluid span9 offset2">
      <center>  <a href="#" class="btn btn-info span3 offset1" id="btn_queja">Guardar</a> </center>                   
    </div>       
                        </div>