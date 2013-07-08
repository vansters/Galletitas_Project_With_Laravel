<!-- Baner de Modulo -->
<div class="row-fluid header_tab span10 offset1">
    <div class="span1">
        <center><h3>{{Auth::user()->depto}}</h3></center> 
    </div>
    <div class='offset{{$offset}}'>
       @foreach($items_menu as $m)
            @if($m == $act)
                <div class="span{{$span}}  actived">
                    <center><h4>{{ HTML::link_to_action($tit_link.'@'.$m, $m) }}</h4></center>
                </div>                    
            @else
                <div class="span{{$span}} btn_menu">
                    <center><h4>{{ HTML::link_to_action($tit_link.'@'.$m, $m) }}</h4></center>
                </div> 
            @endif
        @endforeach 
     </div>
</div>