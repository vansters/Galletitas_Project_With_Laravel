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
        @foreach($lotes as $lote)
            <tr>
                 <td><center>{{$lote->id_lote}}</center></td>
                 <?php $galleta3=Galleta::find($lote->galleta_id); ?>
                 <td><center>{{$galleta3->nombre}}</center></td>
                 <td><center>{{$lote->fecha_caducidad}}</center></td>
                 <td><center>{{$lote->fecha_produccion}}</center></td>
                 <td><center>{{$lote->estado}}</center></td>
                 @if($lote->linea_produccion=='LP1')
                 	<td><center>Línea de producción 1</center></td>
                 @elseif($lote->linea_produccion=='LP2')
                 	<td><center>Línea de producción 2</center></td>
                 @else
                 	<td><center>Liínea de producción 3</center></td>
                 @endif
                 <td class="opciones">
                    <center>
                        <a data-toggle="modal" href="#mod_info{{$lote->id}}" title="Modificar Lote" id="{{$lote->id}}"><i class="icon-edit"></i></a>
                        <a data-toggle="modal" href="#eli_info{{$lote->id}}" title="Eliminar Lote"  id="{{$lote->id}}"><i class="icon-trash"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
