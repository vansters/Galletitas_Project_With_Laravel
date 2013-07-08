 <div id="tab2" class="hide">

            <!-- Alerta con Instrucciones -->
            <div class="row-fluid alert alert-info span11" id="alerta_registrarreceta">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Instrucciones:</strong> Ingresa la informaci&oacute;n solicitada. 
                <strong>¡Recuerda!</strong> todos los campos marcados con *  son obligatorios.
            </div>

            <form class="form-horizontal offset1" id="form_agregarReceta">
                    <div class="span8 offset3">
                        <?php $iii=date("Ymdhis"); ?>
                        <input type="hidden" value="{{$iii}}" name="idRecetario"/>
                        <label><b>Crear una nueva Receta</b></label>
                    </div>

                    <div class="span8">
                        <center>
                            <label>Nombre de la Galleta *</label>
                            <input type="text" class="input-large"  name="nombre" placeholder="Introduce Nombre ..."></input>
                        </center>
                        <br>  
                        <br>
                    </div>

                <div class="span5">
                    <div class="control-group">
                        <label>Ingrediente 1: </label>
                        <select name="tipo1">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 2: </label>
                        <select name="tipo2">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 3: </label>
                        <select name="tipo3">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 4: </label>
                        <select name="tipo4">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 5: </label>
                        <select name="tipo5">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 6: </label>
                        <select name="tipo6">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 7: </label>
                        <select name="tipo7">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 8: </label>
                        <select name="tipo8">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 9: </label>
                        <select name="tipo9">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>

                    <div class="control-group">
                        <label>Ingrediente 10: </label>
                        <select name="tipo10">
                            <option value=""></option>
                            @foreach($catalogos as $catalogo_mp)
                                <option value="{{$catalogo_mp->id}}"> {{$catalogo_mp->nombre}} </option>
                            @endforeach                    
                        </select>
                        <br>
                    </div>
                </div>

				<div class="span5">
                    <div class="control-group">
                        <label for="c1">Cantidad: </label>
                        <input type="text" class="input-large" name="c1">
                    </div>

                    <div class="control-group">
                        <label for="c2">Cantidad: </label>
                        <input type="text" class="input-large" name="c2">
                    </div>

                    <div class="control-group">
                        <label for="c3">Cantidad: </label>
                        <input type="text" class="input-large" name="c3">
                    </div>

                    <div class="control-group">
                        <label for="c4">Cantidad: </label>
                        <input type="text" class="input-large" name="c4">
                    </div>

                    <div class="control-group">
                        <label for="c5">Cantidad: </label>
                        <input type="text" class="input-large" name="c5">
                    </div>

                    <div class="control-group">
                        <label for="c6">Cantidad: </label>
                        <input type="text" class="input-large" name="c6">
                    </div>

                    <div class="control-group">
                        <label for="c7">Cantidad: </label>
                        <input type="text" class="input-large" name="c7">
                    </div>

                    <div class="control-group">
                        <label for="c8">Cantidad: </label>
                        <input type="text" class="input-large" name="c8">
                    </div>

                    <div class="control-group">
                        <label for="c9">Cantidad: </label>
                        <input type="text" class="input-large" name="c9">
                    </div>

                    <div class="control-group">
                        <label for="c10">Cantidad: </label>
                        <input type="text" class="input-large" name="c10">
                    </div>

                </div>
			</form>

        <div class="row-fluid span10">
			<hr class="span11"/>
            <a href="#" class="btn btn-info span3 offset3" id="btn_agregar">Agregar</a>
            <a href="#" class="btn  span3">Cancelar</a>
        </div>
</div>