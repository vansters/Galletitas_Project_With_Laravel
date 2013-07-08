<!-- Ventana emergente recuperar contraseña -->
<div id="modal_recContra" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <!-- Cabecera -->
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Recuperar Contraseña</h3>
    </div>
    <!-- Cuerpo -->
    <div class="modal-body">
        <div id="imagenCarga" class="hide">
            <center>
                <label>Se esta procesando tu solicitud espera</label>
                <br>
                {{ HTML::image('/img/ajax-loader.gif') }}
            </center>
        </div>

        <div id="formRecuperaPass">
            <div>
                <label>Ingresar nombre de usuario o el email con el que se te registró  en el sistema.</label> 
            </div>
            <div class="input-prepend input-append">
                <span class="add-on">@</span>
                <input class="span5" type="text" placeholder="     Ejemplo: usuario@mail.com" id="recuperarPass">
                <button class="btn btn-info" type="button" id="btn_recuperarPass">Recuperar</button>
            </div>
        </div>
        <div id="info" class="hide">
        </div>
        
    </div>
    <!-- Pie -->
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal">Cancelar</button>
    </div>
</div>