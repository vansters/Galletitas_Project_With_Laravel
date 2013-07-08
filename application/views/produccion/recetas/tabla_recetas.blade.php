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
        @foreach($galletas as $galleta)
            <tr>
                 <td><center>{{$galleta->id}}</center></td>                 
                       
                        <td align ="center"><center>{{$galleta->nombre}}</center></td>                       
                 
                 <td class="opciones">
                    <center>
                        <a data-toggle="modal" href="#mod_info{{$galleta->id}}" title="Modificar Receta" id="{{$galleta->id}}"><i class="icon-edit"></i></a>
                        <!--<a data-toggle="modal" href="#eli_info{{$galleta->id}}" title="Eliminar Receta"  id="{{$galleta->id}}"><i class="icon-trash"></i></a>-->
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>