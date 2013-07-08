@foreach($lotes as $lote)

    <!-- Modal's Modificar Información -->
    <div id="eval_lote{{$lote->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Modificar Lote Rechazado</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal offset1" id="form_evaluarLote-{{$lote->id}}">
            <div id="controles{{$lote->id}}">

                <!-- Datos del Cliente Columna 1 -->
                <div class="span5">
                    <table class="table table-bordered table-striped">
                     <thead>
                               <tr>
                               <th>
                                 <h4><center> Información </center></h4>
                               </th>
                               </tr>
                     </thead>
        <tbody>
            <tr>
               <td> <strong> Id Lote: </strong><input type="text" class="input-mini uneditable" value="{{$lote->id}}" name="id"></td>
            </tr>
            <tr>
               <td> <strong> Fecha Caducidad: </strong>{{$lote->fecha_caducidad}}</td>
            </tr>
            <tr>
               <td> <strong> Fecha Producción: </strong>{{$lote->fecha_produccion}}</td>
            </tr>
            <tr>            
               <td> <strong> Linea Producción: </strong>{{$lote->linea_produccion}}</td>
            </tr>
          <tr>
               <td> <strong> Estado: </strong><input type="text" class="input-small uneditable" value="Rechazado" name="estado"></td>
            </tr>
            <tr>
               <td> <strong> Precio: </strong>{{$lote->precio}}</td>
            </tr>
        </tbody>            
                    </table>
                    </div>
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
                                        <input type="text" class="uneditable-input" value="Producción" disabled="disabled" name="departo">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="control-group">
                                        <strong>
                                            <center>Descripción</center>
                                        </strong>
                                        <textarea rows="4" cols="1" autofocus="autofocus" name="descripcion"></textarea>
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
            <button class="btn btn-info btn_evaluar_lote" id="{{$lote->id}}">Guardar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
    <br>
    <br>
</div>         
@endforeach

@foreach($lotes as $lote)

    <!-- Modal's Lote  Aprobado -->
    <div id="eval_lote_a{{$lote->id}}" class="modal_1 hide fade">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Lote Aprobado</h3>
        </div>

        <div class="modal-body">
    
            <form class="form-horizontal offset1 info" id="form_evaluarLoteAprovado-{{$lote->id}}">
            <div id="controles{{$lote->id}}">

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
                      value="Aprobado"  disabled="disabled" name="estado_a"> del Lote con ID: {{$lote->id_lote}}                       
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
            <button class="btn btn-info btn_Aceptar_lote" id="{{$lote->id}}">Aceptar</button>
            <button class="btn" data-dismiss="modal">Cerrar</button>
        </div>
                
    </div>
@endforeach
