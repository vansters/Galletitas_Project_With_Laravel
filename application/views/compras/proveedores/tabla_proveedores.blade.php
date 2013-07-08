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
        @foreach($proveedores as $proveedor)
            <tr>
                 <td><center>{{$proveedor->id}}</center></td>
                 <td><center>{{$proveedor->rfc}}</center></td>
                 <td><center>{{$proveedor->nombre}}</center></td>
                 <td><center>{{$proveedor->estado}}</center></td>
                 <td><center>{{$proveedor->telefono}}</center></td>
                 <td class="opciones">
                    <center>
                        <a data-toggle="modal" href="#mod_info{{$proveedor->id}}" title="Modificar Proveedor"  id="{{$proveedor->id}}"><i class="icon-edit"></i></a>
                        <a data-toggle="modal" href="#eli_info{{$proveedor->id}}" title="Eliminar Proveedor"  id="{{$proveedor->id}}"><i class="icon-trash"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
