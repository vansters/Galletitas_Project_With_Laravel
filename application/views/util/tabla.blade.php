
<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            @foreach($titulos  as $t)
                <th>{{$t}}</th>
            @endforeach

        </tr>
    </thead>
    <tbody>
        @for($i=0; $i<5; $i++)
            <tr>
                @foreach($contenidos as $c)
                 <td>{{$c}}</td>
             @endforeach
            </tr>
        @endfor
    </tbody>
</table>


