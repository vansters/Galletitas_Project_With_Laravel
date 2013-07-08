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
        @foreach($usuarios as $usuario)
            <tr>
                 <td><center>{{$usuario->id}}</center></td>
                 <td><center>{{$usuario->rfc}}</center></td>
                 <td><center>{{$usuario->nombre}}</center></td>
                 <td><center>{{$usuario->appaterno}}&nbsp;&nbsp;{{$usuario->apmaterno}}</center></td>
                 <td><center>{{$usuario->depto}}</center></td>
                 <td class="opciones">
                    <center>
                        <a data-toggle="modal" href="#mod_info{{$usuario->id}}" title="Modificar Usuario"  id="{{$usuario->id}}"><i class="icon-edit"></i></a>
                        <a data-toggle="modal" href="#eli_info{{$usuario->id}}" title="Eliminar Usuario"  id="{{$usuario->id}}"><i class="icon-trash"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
