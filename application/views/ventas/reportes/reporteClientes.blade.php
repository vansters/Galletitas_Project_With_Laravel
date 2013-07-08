<html>
<style type="text/css">
<!--
table {
    font: 11px Verdana, Arial, Helvetica, sans-serif;
    padding-top: 10px;
}

table tr td{
    padding-left: 15px;
    padding-right: 20px;
    padding-bottom: 20px;
}

.agrandar{
    width: 150px;
}

.centrar{
    text-align: center;
}

.bajar{
    padding-top: 20px;
}
.bbajar{
    padding-top: 15px;
}

.barra{
    height: 50px;
}

-->
</style>

<body>

    <!-- Cabecera de la Aplicación -->
    <div style="background-color:#3f4551; height:20px; width: 400px; padding-left: 150px;">
        <h2 style="margin-left: 100px; color: #FFFFFF; ">Galletitas S.A de C.V.</h2>
    </div>
    <div style="padding-top: -70px; padding-left: 650px;">
       {{ HTML::image('/img/icono.jpg') }}  
    </div> 

    <!-- Titulo del Reporte -->
    <div style="text-align:center; padding-top: -30px;">
        <hr>
        <h3>Reporte Mejores de Clientes</h3>
    </div>

    <!-- Tabla Base con Datos -->
    <div>
        <table>
            <tr>
                <h4>
                    <td>Ventas Totales en el Periodo :</td>
                    <td>{{$ventasTotal}}  Ventas </td>
                </h4>
                <h5>
                    <td></td>
                    <td>Fecha Inicial</td>
                    <td>Fecha Final </td>
                </h5>
            </tr>
            <tr>
                <h4>
                    <td></td>
                    <td></td>
                </h4>
                <h5>
                    <td >Período del Reporte</td>
                    <td></td>
                    <td></td>
                </h5>
            </tr>
            <tr>
                <h4>
                    <td></td>
                    <td></td>
                </h4>
                <h5>
                    <td></td>
                    <td class="centrar">{{Input::get('fechaInicio')}}</td>
                    <td class="centrar">{{Input::get('fechaFinal')}}</td>
                </h5>
            </tr>
            
        </table>
    </div>

    
    <!-- Gráfico de Barras -->
    <div style="text-align:center; padding-top: -50px;">
        <hr>
        <h3>Gráfico mejores Clientes</h3>
    </div>
    <!-- Graficos de las Ventas-->
    <div>
        <table>
            @for ($i=0; $i < count($datosClientes) ; $i++) 
            <tr>
                <h5>
                    <td class="bajar">{{$datosClientes['cliente'][$i]}}</td>
                    <td class="bajar">{{$datosClientes['numCompras'][$i]}} Ventas</td>
                    <td>
                        <div class="barra" style="width:{{$factor*$datosClientes['numCompras'][$i]}};">
                            <div style="background-color:{{$colores[$i];}}">
                                <h1></h1>
                            </div> 
                        </div> 
                    </td>
                    <td class="bajar">
                        {{ ($datosClientes['numCompras'][$i]*100)/$ventasTotal }} %
                    </td>
                    <td class="bajar">de las Ventas del Período</td>
                </h5>
            </tr>
            @endfor
        </table>
    </div>

    <!-- Grafico de Barras -->
    <div style="text-align:center; padding-top: 0px;">
        <hr>
        <h3>Datos de los Clientes</h3>
    </div>
 
    <div style="padding-left: 40px;">
        <table border="1">
            <thead>
                <tr>
                    @foreach($titulosTabla  as $t)
                    <h4>
                        <th class="centrar">{{$t}}</th>
                    </h4>
                    @endforeach
                </tr>
                <tr>
                    <th style="height: 10px;"></th><th></th><th></th><th></th><th></th><th></th>
                </tr>
            </thead>
            <tbody>
                <h5>    
                @foreach($datosCli as $cliente)
                    <tr>
                         <td class="centrar bbajar">{{$cliente->id}}</td>
                         <td class="centrar bbajar">{{$cliente->rfc}}</td>
                         <td class="centrar bbajar">{{$cliente->nombre}}</td>
                         <td class="centrar bbajar">{{$cliente->estado}}</td>
                         <td class="centrar bbajar">{{$cliente->telefono}}</td>
                         <td class="centrar bbajar">{{$cliente->status}}</td>
                    </tr>
                @endforeach
                </h5>
            </tbody>
        </table>
    </div>

</body>

</html>