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