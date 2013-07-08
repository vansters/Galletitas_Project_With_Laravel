<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            @foreach($titulos  as $tf)
                <th><center>{{$tf}}</center></th>
            @endforeach

        </tr>
    </thead>
    <tbody>
        @foreach($fallos as $fallo)
            <tr>
            
                 <td><center>{{$fallo->id}}</center></td>
                 <td><center>{{$fallo->created_at}}</center></td>
                 <td><center>{{$fallo->departamento}}</center></td>
                 <td><center>{{$fallo->descripcion}}</center></td>
                 <td><center>{{$fallo->materia_prima_id}}</center></td>
                 <td><center>{{$fallo->lote_id}}</center></td>                
            </tr>
        @endforeach
    </tbody>
</table>

<div class="row-fluid span11 puff">
    <div class="pagination pagination-centered">
        <ul>
            
            @for($i = 1; $i <= $num_paginas; $i++)
                @if($i == $pagina)
                    <li class="active"><a href="#" id="{{$i}}">{{$i}}</a></li>
                @else 
                    <li><a href="#" id="{{$i}}">{{$i}}</a></li>
                @endif
            @endfor
        </ul>
    </div>
</div>