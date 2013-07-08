<!-- Modal's Recuperar Contrasena -->
<div id="mod_contrasena" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Cambiar Contraseña</h3>
    </div>
    <div class="modal-body">
        <center>
            <form class="form-horizontal" id='cambiarPass'>

                <div class="control-group">
                    <label for="nombre">Ingresa tu contraseña actual*</label>
                    <input type="password" class="input-large" name="actualPass">
                </div>
                <hr>
                <div class="control-group">
                    <label for="pass">Nueva contraseña *</label>
                    <input type="password" class="input-large" name="nuevoPass" id="nuevoPass">
                </div>

                <div class="control-group">
                    <label for="passcon">Confirmar contraseña *</label>
                    <input type="password" class="input-large" name="conPass">
                </div>

            </form>
        </center>
    </div>
    <div class="modal-footer">
        <button class="btn btn-info" id="btn_cambiarPass">Aceptar</button>
        <button class="btn" data-dismiss="modal">Cerrar</button>
    </div>
</div>