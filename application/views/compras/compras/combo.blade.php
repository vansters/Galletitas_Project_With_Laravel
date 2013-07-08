<!-- COMBO DE MATERIAS PRIMAS DEPENDIENDO DEL PROVEEDOR -->
<div id="comboMP">
    <form class="span8 offset2">
        <h5>Selecciona una Materia Prima</h5>
        <select id="comboMateriaPrima" class="span7">
            @foreach ($datos as $dato)
                <option>{{$dato}}</option>
            @endforeach
        </select>
        <input type="text" class="cantidad input-small" placeholder="Cantidad" id="cantidad">
        <input class="btn btn-danger span2" value="+" style="margin-top: -10px;" id="btn_agregarMP"/>
    </form>
</div>