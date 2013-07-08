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
        <h3>Reporte Productos mas Vendidos</h3>
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
        <h3>Gráfico Productos mas Vendidos</h3>
    </div>
    <!-- Graficos de las Ventas-->
    <div>
        <table>
            @for ($i=0; $i < count($datosProduc) ; $i++)
                <tr>
                    <h5>
                        <td class="bajar">{{$datosProduc['galleta'][$i]}}</td>
                    </h5>
                        <td class="bajar">{{$datosProduc['numPaquetes'][$i]}}  Paquetes Vendidos</td>
                        <td>
                            <div class="barra" style="width:{{($datosProduc['numPaquetes'][$i])/100}};">
                                <div style="background-color:{{$colores[$i];}}">
                                    <h1></h1>
                                </div> 
                            </div> 
                        </td>
                        <td class="bajar">
                            @if ( $datosProduc['numPaquetes'][$i] == 0){
                                {{ ($datosProduc['numPaquetes'][$i]*100) }} %
                            @else
                                {{ number_format(($datosProduc['numPaquetes'][$i]*100)/$totalPaquetes, 2, '.', '')}} %
                            @endif
                        </td>
                        <td class="bajar"> del Total de Paquetes</td>
                </tr>  
            @endfor
            
        </table>
    </div>


</body>

</html>