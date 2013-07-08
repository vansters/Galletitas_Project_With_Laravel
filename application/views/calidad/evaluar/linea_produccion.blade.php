<div class="tab-pane" id="ref_produccion">
    <!-- Alerta con Instrucciones -->
    <div class="row-fluid alert alert-info span11">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Instrucciones:</strong> Ingresa la informaci&oacute;n solicitada. 
        <strong>¡Recuerda!</strong> todos los campos marcados con * son obligatorios.
    </div>

    <div class="row-fluid span11">
        <!-- Datos del lote -->
        <form class="form-horizontal span4 offset1">
            <label><b>Informaci&oacute;n de la l&iacute;nea de producci&oacute;n</b></br></br></label>
            <label>L&iacute;nea de producci&oacute;n: *</label>
            <select>
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
            <label>Producto actual: *</label>
            <select>
                <option>Emperador</option>
            </select>
            <label>Receta del producto: *</label>
            <select>
                <option>Vanilla</option>
                <option>Chocolate</option>
                <option>Lim&oacute;n</option>
            </select>
        </form>
        <form class="form-horizontal span4 offset1">
            </br></br>
            <label>Integridad de la materia prima: *</label>
            <select>
                <option>Buena</option>
                <option>Media</option>
                <option>Mala</option>
            </select>
            <label>Galletas a producir: *</label>
            <input type="text" class="input-large">
            <label>D&iacute;a de evaluaci&oacute;n</label>
            <input type="date" class="input" disabled="disabled"/>
        </form>
    </div>
    <div class="row-fluid span11">
        <hr class="span11"/>
        <form class="form-horizontal span4 offset1">
            <label><b>Ingresar datos del informe</b></label></br>
            <label>¿Sali&oacute; a tiempo la producci&oacute;n? *</label>
            <select>
                <option>Si</option>
                <option>No</option>										
            </select>
            <label>¿Hubo alg&uacute;n lote con errores?: *</label>
            <select>
                <option>Si</option>
                <option>No</option>
            </select>
        </form>
        <form class="form-horizontal span4 offset1">
            </br>
            </br>
            <label>Comentarios de la presentaci&oacute;n: *</label>
            <textarea rows="4" cols="40"></textarea>						
        </form>
    </div>
    <div class="row-fluid span10">
        <hr class="span11"/>
        <a href="#" class="btn btn-info span3 offset3">Evaluar</a>
        <a href="#" class="btn  span3">Cancelar</a>
    </div>
</div>