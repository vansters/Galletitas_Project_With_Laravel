<!-- Buscador -->
<div class="row-fluid span11">
    <input type="text" class="span7" style="margin: 0 20px 0 20px" data-provide="typeahead" data-items="5" 
           data-source='["ventas","compras","administracion","produccion","calidad"]' 
           placeholder="{{ $sugerencias }}">

    <input type="submit" class="btn btn-info span2" value="Buscar">

    @if($text_btn != '')
        <!--  Boton Agregar -->
        <input type="submit" class="btn btn-danger" value="{{$text_btn}}" id="btn_agregar">
    @endif
</div>