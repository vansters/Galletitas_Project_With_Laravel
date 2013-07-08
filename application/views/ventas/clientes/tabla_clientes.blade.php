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
        @foreach($clientes as $cliente)
            <tr>
                 <td><center>{{$cliente->id}}</center></td>
                 <td><center>{{$cliente->rfc}}</center></td>
                 <td><center>{{$cliente->nombre}}</center></td>
                 <td><center>{{$cliente->estado}}</center></td>
                 <td><center>{{$cliente->telefono}}</center></td>
                 <td class="opciones">
                    <center>
                        <a data-toggle="modal" href="#mod_info{{$cliente->id}}" title="Modificar Cliente"  id="{{$cliente->id}}"><i class="icon-edit"></i></a>
                        <a data-toggle="modal" href="#eli_info{{$cliente->id}}" title="Eliminar Cliente"  id="{{$cliente->id}}"><i class="icon-trash"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
