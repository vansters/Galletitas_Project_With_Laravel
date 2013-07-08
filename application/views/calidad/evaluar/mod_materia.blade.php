@foreach($materias as $materia_prima)

    <!-- Modal's Materia prima Rechazada -->
    <div id="eval_materia{{$materia_prima->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Materia Prima Rechazada</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal offset1 info" id="form_evaluarMateria-{{$materia_prima->id}}">
            <div id="controles{{$materia_prima->id}}">

                <!-- Datos del Cliente Columna 1 -->
                <div class="span5">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><h4><center>Información</center></h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>ID: </strong><input type="text" class="input-mini uneditable-input" value="{{$materia_prima->id}}" 
                                    disabled="disabled" name="id"></td>
                            </tr>
                            <tr>                                
                              @foreach($materiasp as $catalogo_mp)  
                                        @if($catalogo_mp->id == $materia_prima->catalogo_mp_id)
                              <td><strong>Nombre: </strong> {{$catalogo_mp->nombre}}</td>
                                        @endif
                                    @endforeach 
                            </tr>
                            <tr>
                               <td><strong>ID Compra: </strong>{{$materia_prima->compra_id}}</td>
                            </tr>
                            <tr>
                                <td><strong>Caducidad: </strong>{{$materia_prima->fecha_caducidad}}</td>
                            </tr>
                            <tr>
                                <td><strong>Cantidad: </strong>{{$materia_prima->cantidad}}</td>
                            </tr>
                            <tr>
                                <td><strong>Estado: </strong><input type="text" class="input-small uneditable-input" value="Rechazado" 
                                    disabled="disabled" name="estado"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Datos del Cliente Columna 1 -->
                <div class="span5 offset1">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><h4><center>Evaluación</center></h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="control-group">
                                        <strong>
                                            <center>Departamento Involucrado</center>
                                        </strong>
                                        <input type="text" class="uneditable-input" value="Compras" disabled="disabled" name="depto">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="control-group">
                                        <strong>
                                            <center>Descripción</center>
                                        </strong>
                                        <textarea rows="4" cols="1" autofocus="autofocus" name="mensaje"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>    
            </form>

        </div>

        <div class="modal-footer">
            <button class="btn btn-info btn_evaluar" id="{{$materia_prima->id}}">Guardar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
                
    </div>
@endforeach

@foreach($materias as $materia_prima)

    <!-- Modal's Materia prima Rechazada -->
    <div id="eval_materia_a{{$materia_prima->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Materia Prima Aprobada</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal offset1 info" id="form_evaluarMateriaAprovada-{{$materia_prima->id}}">
            <div id="controles{{$materia_prima->id}}">

                <!-- Datos del Cliente Columna 1 -->
                <div align="center">
              <center> <table class="table table-bordered table-striped">
                <tbody>
                <thead>
                            <tr>
                                <th><h4><center>Evaluación</center></h4></th>
                            </tr>
                        </thead>
                <tr>
                <td>
                <div class="control-group">
                <strong><center> Se cambiara el Estado a:     <input type="text" class="input-small uneditable-input" 
                      value="Aprobado"  disabled="disabled" name="estado_a"> de la Materia con Id: {{$materia_prima->id}}                       
                    </center>                      
                      </strong>
                      </div>                 
                      </tbody>                                                                                                                 
                      </table></center> 
            </div>
             
            </div>   
            </form>

        </div>

        <div class="modal-footer">
            <button class="btn btn-info btn_Aceptar" id="{{$materia_prima->id}}">Aceptar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
                
    </div>
@endforeach
