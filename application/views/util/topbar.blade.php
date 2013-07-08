<header>
    <div class="row-fluid">
        <div class="span12 barra_sup">

        @if($alertas == true)
            <!-- Contador de Alertas -->
            <div class="span2 offset1 btn_alertas">
                <span class="badge badge-important" id="cont_alertas">3</span> <i class="icon-envelope icon-white"></i> Pendientes
            </div> 
            <!-- Ultima Alerta para el Usuario -->
            <div class="row-fluid alert alert-error span5">
                <strong>Cuidado!</strong> la materia prima "Levadura " con ID "MC3245" ya esta caduca.
            </div> 

            <!-- Boton de opciones para el Usuario  -->
            <div class="span3 ">
                <div class="btn-group">
                    <button class="btn "> <i class="icon-user"></i>{{ Auth::user()->nombre.' '.Auth::user()->appaterno }}</button>
                    <button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a data-toggle="modal" href="#mod_contrasena">Cambiar Contraseña</a></li>
                        <li class="divider"></li>
                        <li>{{ HTML::link_to_action('administracion@logout', 'Cerrar Sesión') }}</li>
                    </ul>
                </div>
            </div>
        @else
            <!-- Boton de opciones para el Usuario  -->
            <div class="span3 offset9 ">
                <div class="btn-group">
                    <button class="btn "> <i class="icon-user"></i>{{ Auth::user()->nombre.' '.Auth::user()->appaterno }}</button>
                    <button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a data-toggle="modal" href="#mod_contrasena">Cambiar Contraseña</a></li>
                        <li class="divider"></li>
                        <li>{{ HTML::link_to_action('administracion@logout', 'Cerrar Sesión') }}</li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</header>