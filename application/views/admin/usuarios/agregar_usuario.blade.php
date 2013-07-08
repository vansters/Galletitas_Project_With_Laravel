<div id="tab2" class="hide">

    <!-- Alerta con Instrucciones -->
    <div class="row-fluid alert alert-info span11" id='alerta_registrarUsuario'>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Instrucciones:</strong> Ingresa la información solicitada. 
        <strong>Recuerda</strong> todos los campos marcados con * son obligatorios.
    </div>

    <!-- Formulario para Registrar Nuevo Usuario -->
    <form class="form-horizontal offset1" id='form_registrarUsuario'>

        <!-- Datos del Usuario Columna 1 -->
        <div class="span5">

            <div class="control-group">
                <label for="nombre">Nombre (s) *</label>
                <input type="text" class="input-large" name="nombre">
            </div>

            <div class="control-group">
                <label for="apPaterno">Apellido Paterno *</label>
                <input type="text" class="input-large" name="apPaterno">
            </div>

            <div class="control-group">
                <label for="apMaterno">Apellido Materno *</label>
                <input type="text" class="input-large" name="apMaterno">
            </div>

            <div class="control-group">
                <label for="depto">Departamento *</label>
                <select name="depto">
                    <option></option>
                    @foreach ($departamentos as $departamento)
                        <option>{{$departamento}}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- Datos del Usuario Columna 2 -->
        <div class="span5" style="margin-bottom:30px;">

            <div class="control-group">
                <label for="rfc">Nombre de Usuario (RFC) *</label>
                <input type="text" class="input-large" name="rfc">
            </div>

            <div class="control-group">
                <label for="pass">Contraseña *</label>
                <input type="password" class="input-large" name="pass" id="pass">
            </div>

            <div class="control-group">
                <label for="passcon">Confirmar contraseña *</label>
                <input type="password" class="input-large" name="passcon">
            </div>

            <div class="control-group">
                <label for="correo">Correo Electrónico *</label>
                <input type="text" placeholder="usuario@email.com" name="correo">
            </div>
        </div>

    </form>

    <div  class=" row-fluid span9 offset2">
        <!-- Botones del Formulario -->
        <a href="#" class="btn btn-info span3 offset1" id='btn_agregarUsuario'>Agregar</a> 
        <a href="#" class="btn  span3">Cancelar</a> 
    </div>
    
</div>
