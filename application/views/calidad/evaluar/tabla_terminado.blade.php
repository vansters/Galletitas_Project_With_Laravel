<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            @foreach($titulos1  as $t)
                <th><center>{{$t}}</center></th>
            @endforeach            

        </tr>
    </thead>
    <tbody>
        @foreach($lotes as $lote)
            <tr>
            
                 <td><center>{{$lote->id_lote}}</center></td>
                 <td><center>{{$lote->estado}}</center></td>
                 <td><center>{{$lote->fecha_produccion}}</center></td>
                 <td><center>{{$lote->fecha_caducidad}}</center></td>
                 <td><center>{{$lote->linea_produccion}}</center></td>
                 <td><center>{{$lote->precio}}</center></td>                
                 <td><center>{{$lote->galleta_id}}</center></td>                 
                 <td class="opciones">
                    <center>
                    <a data-toggle="modal" href="#eval_lote_a{{$lote->id}}"title="Lote Aprovado" id="lote_{{$lote->id}}"><i class="icon-ok"></i></a>                                           
                    <a data-toggle="modal" href="#eval_lote{{$lote->id}}" title="Lote Rechazado"  id="lote_{{$lote->id}}"><i class="icon-remove"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="row-fluid span11 puff">
    <div class="pagination pagination-centered">
        <ul>
            
            @for($i = 1; $i <= $num_paginas2; $i++)
                @if($i == $pagina)
                    <li class="active"><a href="#" id="{{$i}}">{{$i}}</a></li>
                @else 
                    <li><a href="#" id="{{$i}}">{{$i}}</a></li>
                @endif
            @endfor
        </ul>
    </div>
</div>