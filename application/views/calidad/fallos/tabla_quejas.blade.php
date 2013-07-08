<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            @foreach($titulos1  as $tf)
                <th><center>{{$tf}}</center></th>
            @endforeach

        </tr>
    </thead>
    <tbody>
        @foreach($quejas as $queja)
            <tr>
            
                 <td><center>{{$queja->id}}</center></td>
                 <td><center>{{$queja->created_at}}</center></td>
                 <td><center>{{$queja->modulo}}</center></td>
                 <td><center>{{$queja->comentario}}</center></td>
                 <td><center>{{$queja->lote_id_id}}</center></td>                 
            </tr>
        @endforeach
    </tbody>
</table>

<div class="row-fluid span11 puff">
    <div class="pagination pagination-centered">
        <ul>
            
            @for($i = 1; $i <= $num_paginas3; $i++)
                @if($i == $pagina)
                    <li class="active"><a href="#" id="{{$i}}">{{$i}}</a></li>
                @else 
                    <li><a href="#" id="{{$i}}">{{$i}}</a></li>
                @endif
            @endfor
        </ul>
    </div>
</div>