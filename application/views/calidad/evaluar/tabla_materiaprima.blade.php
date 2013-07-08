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
        @foreach($materias as $materia_prima)
            <tr>
            
                 <td><center>{{$materia_prima->id}}</center></td>
                 <td><center>{{$materia_prima->compra_id}}</center></td>
                 <td><center>{{$materia_prima->fecha_caducidad}}</center></td>
                  @foreach($materiasp as $catalogo_mp)  
                                        @if($catalogo_mp->id == $materia_prima->catalogo_mp_id)
                                            <td align="center">{{$catalogo_mp->nombre}}</td>
                                        @endif
                                    @endforeach                 
                 <td><center>{{$materia_prima->cantidad}}</center></td>
                 <td><center>{{$materia_prima->estado}}</center></td>                 
                 <td class="opciones">
                    <center>
                    <a data-toggle="modal" href="#eval_materia_a{{$materia_prima->id}}" title="Materia Aprobada" id="materia_{{$materia_prima->id}}"><i class="icon-ok"></i></a>                                           
                    <a data-toggle="modal" href="#eval_materia{{$materia_prima->id}}" title="Materia Rechazada"  id="materia_{{$materia_prima->id}}"><i class="icon-remove"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="row-fluid span11 puff">
    <div class="pagination pagination-centered">
        <ul>
            
            @for($i = 1; $i <= $num_paginas1; $i++)
                @if($i == $pagina)
                    <li class="active"><a href="#" id="{{$i}}">{{$i}}</a></li>
                @else 
                    <li><a href="#" id="{{$i}}">{{$i}}</a></li>
                @endif
            @endfor
        </ul>
    </div>
</div>