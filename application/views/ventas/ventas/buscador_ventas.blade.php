<!-- Buscador -->
<div class="row-fluid span10  offset1" id="buscaClientes">
	
	<!-- Alerta con Instrucciones -->
    <div class="row-fluid alert alert-info span10 " id="alerta_Gestion">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Instrucciones:</strong> Usa el buscador de Ventas para filtrar resultados o utiliza el paginador.
    </div>

	<input type="text" class="span7 offset1"  style="margin: 0 20px 0 20px" data-provide="typeahead" 
		data-items="5" placeholder="Ingresa búsqueda  ID de Venta o RFC de Cliente." id="buscadorVentas" autocomplete="off">

    <!--  Botón Agregar -->
    <input type="submit" class="btn btn-danger" value="{{$text_btn}}" id="btn_agregarVenta">

</div>



