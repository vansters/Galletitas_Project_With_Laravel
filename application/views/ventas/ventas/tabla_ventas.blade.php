<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            @foreach($titulos  as $t)
                <th><center>{{$t}}</center></th>
            @endforeach

        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
            <tr>
                 <td><center>{{$venta->id}}</center></td>
                 @foreach($clientes as $cliente)
                    @if($cliente->id == $venta->cliente_id)
                        <td><center>{{$cliente->nombre}}</center></td>
                    @endif
                 @endforeach
                 <td><center>{{$venta->fecha_entrega}}</center></td>
		          <td><center>$ {{$venta->total}}</center></td>
                 <td class="opciones">
                    <center>
                        <a data-toggle="modal" href="#mod_info{{$venta->id}}" title="Modificar Venta"  id="{{$venta->id}}"><i class="icon-edit"></i></a>
                        <a data-toggle="modal" href="#eli_info{{$venta->id}}" title="Eliminar Venta"  id="{{$venta->id}}"><i class="icon-trash"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
