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
        @foreach($compras as $compra)
            <tr>
                <td><center>{{$compra->id}}</center></td>
                <td><center>{{$compra->fecha_entrega}}</center></td>
                <td><center>{{$compra->estado}}</center></td>
                <td><center>{{$compra->total}}</center></td>
                @foreach($proveedores as $proveedor)
                    @if($proveedor->id == $compra->proveedor_id)
                        <td><center>{{$proveedor->nombre}}</center></td>
                    @endif
                @endforeach
                 <td class="opciones">
                    <center>
                        <a data-toggle="modal" href="#mod_info{{$compra->id}}" title="Modificar Compra"  id="{{$compra->id}}"><i class="icon-edit"></i></a>
                        <a data-toggle="modal" href="#eli_info{{$compra->id}}" title="Eliminar Compra"  id="{{$compra->id}}"><i class="icon-trash"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
