<div id="tab2" class="hide">

    <!-- Alerta con Instrucciones -->
    <div class="row-fluid alert alert-info span11" id='alerta_registrarcliente'>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Instrucciones:</strong> Ingresa la información solicitada 
        <strong>Recuerda</strong> todos los campos marcados con *  son obligatorios.
    </div>

    <form class="form-horizontal offset1" id="form_agregarCliente">

        <!-- Datos del Cliente Columna 1 -->
        <div class="span5">

            <div class="control-group">
                <label for="nombre">Nombre *</label>
                <input type="text" class="input-large" name="nombre">
            </div>

            <div class="control-group">
                <label for="rfc">RFC *</label>
                <input type="text" class="input-large" name="rfc">
            </div>

            <div class="control-group">
                <label for="tel">Teléfono *</label>
                <input type="text" class="input-large" name="tel">
            </div>

            <div class="control-group">
                <label for="estado">Estado *</label>
                <select name="estado">
                    <option>Selecciona un Estado</option>
                    @foreach ($estados as $estado)
                        <option>{{$estado}}</option>
                    @endforeach
                </select>
            </div>

            <div class="control-group">
                <label for="delegacion">Delegación/Municipio  *</label>
                <input type="text" class="input-large" name="delegacion">
            </div>

        </div>

        <!-- Datos del Usuario Columna 2 -->
        <div class="span5" style="margin-bottom:30px;">

            <div class="control-group">
                <label for="passcon">Colonia/Localidad *</label>
                <input type="text" class="input-large" name="colonia">
            </div>

            <div class="control-group">
                <label for="pass">Calle *</label>
                <input type="text" class="input-large" name="calle">
            </div>

            <div class="control-group">
                <label for="pass">Número *</label>
                <input type="text" class="input-large" name="numero">
            </div>

            <div class="control-group">
                <label for="apMaterno">Código Postal *</label>
                <input type="text" class="input-large" name="codigo">
            </div>

            <div class="control-group">
                <label for="correo">Correo Electrónico *</label>
                <input type="text" placeholder="cliente@email.com" name="correo">
            </div>
        </div>
        
    </form>

    <div  class=" row-fluid span9 offset2">
        <!-- Botones del Formulario -->
        <a href="#" class="btn btn-info span3 offset1" id='btn_agregar'>Agregar</a> 
    </div>

</div>