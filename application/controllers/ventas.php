<?php

class Ventas_Controller extends Base_Controller {

    //  --  Funcion Inicio Ventas
    public function action_inicio() {
        $util = new UtilidadesVentas();
        $datos = $util->contuirMainVentas();
        return View::make('ventas.main_ventas', $datos);
    }


//  ================================================================================================ 
//      Acciones para Clientes
//  ================================================================================================

    //  --  Función Gestión de Clientes -> (Inicio de Clientes)
    public function action_clientes() {
        $util = new UtilidadesVentas();
        $util->tablaClientes();
        $datos = $util->constuirClientes(1);
        unset($util);   //  --  Destruimos util
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',1,60);
        return View::make('ventas.clientes.clientes', $datos);
    }// --  Fin

    //  --  Función para Agregar Cliente
    public function action_agregarCliente(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();

        //  --  Validamos Cliente
        $val = $util->validarCliente();

        if ($val->passes()){    //  --  Validación
            //  --  Creamos un nuevo Cliente
            $cliente = new Cliente($util->datosCliente());
            //  --  Guardamos el Cliente
            $cliente->save();
            //  --  Generamos el Modal
            $datos = $util->modalAgregarCliente($cliente->nombre);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }else{
            //  --  Obtenemos los posibles Errores
            $e = $util->formatearErrores($val);
            $datos = $util->modalAgregarClienteError($e);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }
    }// --  Fin

    //  --  Función para modificar Cliente
    public function action_modificarCliente(){
        //  --  Traemos al cliente (Si Existe)
        $cliente =  Cliente::where('id','=',Input::get('id'))->first();
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();

        //  --  Verificamos cambios en datos unicos 
        if($cliente->rfc == Input::get('rfc') && $cliente->correo == Input::get('correo')){
            $clienteGuardar = $util->nuevosDatosClientes($cliente);
            $clienteGuardar->save();
            $datos = $util->modalModificarCliente($cliente->nombre);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }elseif($cliente->rfc != Input::get('rfc') && $cliente->correo == Input::get('correo')){
            //  --  Verificando que el Nuevo RFC no exista
            $val = $util->validarRFC();
            if($val->passes()){
                $clienteGuardar = $util->nuevosDatosClientes($cliente);
                $clienteGuardar->save();
                $datos = $util->modalModificarCliente($cliente->nombre);
                unset($util);   //  --  Destruimos util
                return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
        }elseif($cliente->rfc == Input::get('rfc') && $cliente->correo != Input::get('correo')){
            //  --  Verificando que el Nuevo Correo no exista
            $val = $util->validarCorreo();
            if($val->passes()){
                $clienteGuardar = $util->nuevosDatosClientes($cliente);
                $clienteGuardar->save();
                $datos = $util->modalModificarCliente($cliente->nombre);
                unset($util);   //  --  Destruimos util
                return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
        }else{
            $val = $util->validarCliente();            
            if($val->passes()){
                $clienteGuardar = $util->nuevosDatosClientes($cliente);
                $clienteGuardar->save();
                $datos = $util->modalModificarCliente($cliente->nombre);
                unset($util);   //  --  Destruimos util
                return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
        }  
        //  --  Obtenemos los posibles Errores
        $e = $util->formatearErrores($val);
        $datos = $util->modalModificarClienteError($e);
        unset($util);   //  --  Destruimos util
        return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip 
    }// --  Fin

    //  --  Función para eliminar a un Cliente
    public function action_eliminarCliente(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        //  --  Buscamos al Cliente
        $cliente = Cliente::find(Input::get('id'));
        if (is_object($cliente)){
            //  --  Desactivamos al Cliente()
            $cliente->status = 'Inactivo';
            $cliente->save();
            $datos = $util->modalEliminarCliente($cliente->nombre);
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }else{
            $datos = $util->modalEliminarClienteError($cliente->nombre);
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }
    }// --  Fin

    //  --  Función para Paginar Clientes (Usando Paginador)
    public function action_paginarCliente(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        $util->nuevaPaginaClientes(Input::get('pagina'));
        $datos = $util->paginarClientes(Input::get('pagina'));
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),60);
        unset($util);
        return View::make('ventas.clientes.gestion_clientes',$datos);
    }// --  Fin

    //  --  Función para Paginacion Automática sin Búsqueda
    public function action_autoPaginarClientes(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        $util->nuevaPaginaClientes((int)Cookie::get('pagina'));
        $datos = $util->paginarClientes((int)Cookie::get('pagina'));
        //  --   Verificando el # de Datos
        if(!is_object($util->clientes) && count($util->clientes) == 0){    //  --  Si la Pagina Esta vacía
            $util->nuevaPaginaClientes(((int)Cookie::get('pagina'))-1);
            $datos = $util->paginarClientes(((int)Cookie::get('pagina'))-1);  
        }
        unset($util);
        return View::make('ventas.clientes.gestion_clientes',$datos);
    }// --  Fin

    //  --  Funcion para Buscar Clientes
    public function action_buscarCliente(){
        //  --  Prametro de busqueda
        //$busqueda = '%'.Input::get('query').'%';
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        $datos = $util->autocompletadoClientes('%'.Input::get('query').'%');
        return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScript      
    }// --  Fin

    //  --  Funcion Paginar  Resultados Busqueda
    public function action_paginarResultados(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();

        $util->tablaClientesFiltro(Input::get('item'));
        $datos = $util->paginarClientes(0);

        unset($util);   //  --  Destruimos util

        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),10);

        return View::make('ventas.clientes.gestion_clientes', $datos,200);
    }// --  Fin


//  ================================================================================================ 
//      Fin Acciones para Clientes
//  ================================================================================================







//  ================================================================================================ 
//      Acciones para Ventas
//  ================================================================================================

    //  --  Función Gestión de ventas -> (Inicio de Ventas)
    public function action_ventas() {
        $util = new UtilidadesVentas();
        $util->tablaVentas();
        $datos = $util->constuirVentas(1);
        unset($util);   //  --  Destruimos util
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',1,60);
        return View::make('ventas.ventas.ventas', $datos);
    }// --  Fin

 //  --  Función para Agregar Venta
    public function action_agregarVenta(){
        //  --  Clase con métodos auxiliares
        $contenido = Lote::where('estado','=','Aprobado')->get();
        $numContenido = Lote::where('estado','=','Aprobado')->count();
        $CONTEO=0;
        for($i=0;$i<$numContenido;$i++)
        {
            if(Input::get('id_lote_aprobado_'.($contenido[$i]->id)) == $contenido[$i]->id)
            {
                $CONTEO++;
            }
        }
        if($CONTEO > 0)
        {
            $util = new UtilidadesVentas();
            $venta = new Venta($util->datosVenta());
            //  --  Guardamos el Venta
            $venta->save();
            //  -- Actualizar Lotes
            $util->actualizaLotes($venta);
            //  --  Generamos el Modal
            $datos = $util->modalAgregarVenta($venta->cliente);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }
        else
        {
            $datos = array(
                'funcion' =>  'Venta No Agregada',
                'mensaje' => 'La Venta esta vacia.',
                'opciones'=>  '<button class="btn btn-info" id="ref_gestion_mod">Ir a Gestion</button><button class="btn" data-dismiss="modal">Cerrar</button>'
                );
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip   
        }
    }// --  Fin*/

    //  --  Función para modificar Venta
    public function action_modificarVenta(){
        //  --  Traemos la venta (Si Existe)
        $venta =  Venta::where('id','=',Input::get('id'))->first();
        $contenidoAnterior = Lote::where('id_venta','=',Input::get('id'))->get();
        $numContenidoAnterior = Lote::where('id_venta','=',Input::get('id'))->count();
        $contenidoNuevo = Lote::where('estado','=','Aprobado')->get();
        $numContenidoNuevo = Lote::where('estado','=','Aprobado')->count();
        $CONTEO=0;
        for($i=0;$i<$numContenidoAnterior;$i++)
        {
            if(Input::get('id_lote_vendido_'.($contenidoAnterior[$i]->id)) == $contenidoAnterior[$i]->id)
            {
                $CONTEO++;
            }
        }
        //Comprobar que la venta no este vacia
        if(Input::get('total_lotesAprovados') != 0)
        {
            for($i=0;$i<$numContenidoNuevo;$i++)
            {
                if(Input::get('id_lote_aprobado_'.($contenidoNuevo[$i]->id)) == $contenidoNuevo[$i]->id)
                {
                    $CONTEO--;
                }
            }
        }
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        //  --  Verificamos cambios en datos unicos 
        if($venta->id == Input::get('id') && $CONTEO < $numContenidoAnterior)
        {
            $ventaGuardar = $util->nuevosDatosVentas($venta);
            $ventaGuardar->save();
            $datos = $util->modalModificarVenta($venta->id);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }
        else
        {
            if($CONTEO == $numContenidoAnterior)
            {
                //  --  Obtenemos los posibles Errores
                $e = "No pude dejar la venta vacia";
                $datos = $util->modalModificarVentaError($e);
                unset($util);   //  --  Destruimos util
                return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
            else
            {
                //  --  Obtenemos los posibles Errores
                $e = $util->formatearErrores($val);
                $datos = $util->modalModificarVentaError($e);
                unset($util);   //  --  Destruimos util
                return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
        }   
    }// --  Fin

    //  --  Función para eliminar a una Venta
    public function action_cancelarVenta(){
       //  --  Traemos la venta (Si Existe)
        $venta =  Venta::where('id','=',Input::get('id'))->first();
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();

        //  --  Verificamos cambios en datos unicos 
        if($venta->id == Input::get('id'))
        {
            $ventaGuardar = $util->datosCancelarVenta($venta);
            $ventaGuardar->save();
            $datos = array('funcion' =>  'Venta Cancelada',
                        'mensaje' => 'La venta '.$venta->id.' se canceló <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
            //$datos = $util->modalEliminarVenta($venta->id);
            unset($util);   //  --  Destruimos util
           return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }
        else
        {
            //  --  Obtenemos los posibles Errores
            //$datos = $util->modalEliminarVentaError($venta->id);
            $datos = array('funcion' =>  'Error al cancelar venta',
                        'mensaje' => 'La venta '.$id.' no fue encontrado en el sistema.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        } 
    }// --  Fin

    //  --  Función para Paginar Ventas (Usando Paginador)
    public function action_paginarVenta(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        $util->nuevaPaginaVentas(Input::get('pagina'));
        $datos = $util->paginarVentas(Input::get('pagina'));
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),60);    }// --  Fin

    //  --  Función para Paginacion Automática sin Búsqueda
    public function action_autoPaginarVentas(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        $util->nuevaPaginaVentas((int)Cookie::get('pagina'));
        $datos = $util->paginarVentas((int)Cookie::get('pagina'));
        //  --   Verificando el # de Datos
        if(!is_object($util->ventas) && count($util->ventas) == 0){    //  --  Si la Pagina Esta vacía
            $util->nuevaPaginaVentas(((int)Cookie::get('pagina'))-1);
            $datos = $util->paginarVentas(((int)Cookie::get('pagina'))-1);  
        }
        unset($util);
        return View::make('ventas.ventas.gestion_ventas',$datos);
    }// --  Fin

     //  --  Funcion para Buscar Clientes
    public function action_buscarVenta(){
        //  --  Prametro de busqueda
        //$busqueda = '%'.Input::get('query').'%';
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();
        $datos = $util->autocompletadoVentas('%'.Input::get('query').'%');
        return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScript      
    }// --  Fin

    //  --  Funcion Paginar  Resultados Busqueda
    public function action_paginarResultadosVentas(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesVentas();

        $util->tablaVentasFiltro(Input::get('item'));
        $datos = $util->paginarVentas(0);

        unset($util);   //  --  Destruimos util

        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),10);

        return View::make('ventas.ventas.gestion_ventas', $datos,200);
    }// --  Fin

//  ================================================================================================ 
//      Fin Acciones para Ventas
//  ================================================================================================





//  ================================================================================================ 
//      Inicio Acciones para Reportes Ventas
//  ================================================================================================

    //  --  Función Gestión de Reportes de Ventas
    public function action_reportes() {
        $util = new UtilidadesVentas();
        $datos = $util->constuirReportes();
        return View::make('ventas.reportes.reportes', $datos);
    }// --  Fin


    //  --  Función para Generar Reporte Situacion de Ventas
    public function action_reporteVentas(){
        //  --  Creamos un Nuevo Reporte
        $reporte  =  new HTML2PDF('P','A4','es');

        $ventasTotal  = Venta::where('created_at','>=',Input::get('fechaInicio'))
                                ->where('created_at','<=',Input::get('fechaFinal'))->count();

        if ($ventasTotal == 0){
            $util = new UtilidadesVentas();
            $datos = $util->constuirReportes();
            return View::make('ventas.reportes.reportesError', $datos);
        }else{

        $datos = array(
                        'estatus'       => array('Ventas en Espera','Ventas Entregadas','Ventas Canceladas'),
                        'colores'       => array('#BDDA4C','#FF9A68','#69ABBF','#FFDE68','#008080','#BFF4F9',
                                                '#B3DB66','#CA6500','#E78585','#FF09FF','#AA5555','#444444',
                                                '#C7B747','#FE7073','#E1742B','#9EFD71','#9CDDE2','#64F13A'),
                        'ventas'        => array(
                                                    Venta::where('estado','=','Espera')
                                                            ->where('created_at','>=',Input::get('fechaInicio'))
                                                            ->where('created_at','<=',Input::get('fechaFinal'))->count(),
                                                    Venta::where('estado','=','Entregado')
                                                            ->where('created_at','>=',Input::get('fechaInicio'))
                                                            ->where('created_at','<=',Input::get('fechaFinal'))->count(),
                                                    Venta::where('estado','=','Cancelado')
                                                            ->where('created_at','>=',Input::get('fechaInicio'))
                                                            ->where('created_at','<=',Input::get('fechaFinal'))->count()
                                                ),
                        'ventasTotal'   => $ventasTotal,
                        'factor'        => ($ventasTotal*200)/10,
                        'titulosTabla'  => array('ID de Venta','Cliente', 'Fecha Entrega', 'Total'),
                        'datosTabla'    => Venta::where('created_at','>=',Input::get('fechaInicio'))
                                                    ->where('created_at','<=',Input::get('fechaFinal'))->get(),
                        'clientes'      => Cliente::all()  
                    );

        //  --  Datos para el Reporte
        $reporte->writeHTML(View::make('ventas.reportes.reporteVentas', $datos));

        return Response::make(  $reporte->Output('reporteVentas.pdf'), 
                                200, 
                                array('Content-type' => 'application/pdf')
                            );
    }
    }// --  Fin


    //  --  Función para Generar Reporte de Clientes
    public function action_reporteClientes(){
        //  --  Creamos un Nuevo Reporte
        $reporte  =  new HTML2PDF('P','A4','es');

        $ventasTotal  = Venta::where('created_at','>=',Input::get('fechaInicio'))
                                ->where('created_at','<=',Input::get('fechaFinal'))->count();

        $clientes  = Cliente::join('venta', 'cliente.id', '=', 'venta.cliente_id')
                                        ->where('venta.created_at','>=',Input::get('fechaInicio'))
                                        ->where('venta.created_at','<=',Input::get('fechaFinal'))
                                        ->group_by('venta.cliente_id')
                                        ->order_by('cliente.nombre', 'asc')
                                        ->take(10)
                                        ->get(array('cliente.id','cliente.nombre','cliente.rfc','cliente.estado',
                                            'cliente.telefono','cliente.status'));

        $ventas = array('id' => array(),'cliente' => array(),'numCompras' => array()); 

        foreach ($clientes as  $value) {
            $num = Venta::where('venta.created_at','>=',Input::get('fechaInicio'))
                          ->where('venta.created_at','<=',Input::get('fechaFinal'))
                          ->where('cliente_id','=',$value->id)
                          ->count();
            array_push($ventas['id'], $value->id);              
            array_push($ventas['cliente'], $value->nombre);
            array_push($ventas['numCompras'], $num);
        }


        if ($ventasTotal == 0){
            $util = new UtilidadesVentas();
            $datos = $util->constuirReportes();
            return View::make('ventas.reportes.reportesError', $datos);
        }else{

        $datos = array(
                        'datosClientes' => $ventas,

                        'colores'       => array('#BDDA4C','#FF9A68','#69ABBF','#FFDE68','#008080','#BFF4F9',
                                                '#B3DB66','#CA6500','#E78585','#FF09FF','#AA5555','#444444',
                                                '#C7B747','#FE7073','#E1742B','#9EFD71','#9CDDE2','#64F13A'),

                        'datosCli'      => $clientes,

                        'ventasTotal'   => $ventasTotal,

                        'factor'        => ($ventasTotal*200)/10,

                        'titulosTabla'  => array('ID ','RFC', 'Nombre', 'Estado', 'Teléfono', 'Estatus'),  
                    );

        //  --  Datos para el Reporte
        $reporte->writeHTML(View::make('ventas.reportes.reporteClientes', $datos));

        return Response::make(  $reporte->Output('reporteClientes.pdf'), 
                                200, 
                                array('Content-type' => 'application/pdf')
                            );
        }
    }// --  Fin


    //  --  Funcion para Generar Reporte de Productos
    public function action_reporteProductos(){
     
     //  --  Creamos un Nuevo Reporte
        $reporte  =  new HTML2PDF('P','A4','es');

        $ventasTotal  = Venta::where('created_at','>=',Input::get('fechaInicio'))
                                ->where('created_at','<=',Input::get('fechaFinal'))->count();

        $galletas = Galleta::all();

        $infoLotes  = Lote::where('estado','=','Vendido')->get();

        $datosProductos = array('id' => array(),'galleta' => array(),'numPaquetes' => array()); 

        foreach ($galletas as $galleta) {
            $cantidad = 0;
            foreach ($infoLotes as $lote) {
               if ( $galleta->id == $lote->galleta_id){
                    array_push($datosProductos['id'], $galleta->id);
                    array_push($datosProductos['galleta'], $galleta->nombre);
                    $paquetes = Lote::where('estado','=','Vendido')
                                      ->where('galleta_id','=', $galleta->id)
                                      ->get();
                    foreach ($paquetes as $paquete) {
                        $cantidad = $cantidad + $paquete->cantidad;        
                    } 
                    array_push($datosProductos['numPaquetes'], $cantidad);       
                }
            }
        }
        $totalVendidos = 0;

        for ($i=0; $i < count($datosProductos); $i++) { 
            $totalVendidos = $totalVendidos + $datosProductos['numPaquetes'][$i];
        }


        if ($ventasTotal == 0){
            $util = new UtilidadesVentas();
            $datos = $util->constuirReportes();
            return View::make('ventas.reportes.reportesError', $datos);
        }else{

        $datos = array(
                        'galletas'      => $galletas,

                        'totalPaquetes' => $totalVendidos,

                        'colores'       => array('#BDDA4C','#FF9A68','#69ABBF','#FFDE68','#008080','#BFF4F9',
                                                '#B3DB66','#CA6500','#E78585','#FF09FF','#AA5555','#444444',
                                                '#C7B747','#FE7073','#E1742B','#9EFD71','#9CDDE2','#64F13A'),

                        'ventasTotal'   => $ventasTotal,

                        'datosProduc'   => $datosProductos,

                        'factor'        => ($totalVendidos*200)/100000,
                    );

        //  --  Datos para el Reporte
        $reporte->writeHTML(View::make('ventas.reportes.reporteProductos', $datos));

        return Response::make(  $reporte->Output('reporteProductos.pdf'), 
                                200, 
                                array('Content-type' => 'application/pdf')
                            );
        }   
    }
//  ================================================================================================ 
//      Fin Acciones para Reportes Ventas
//  ================================================================================================


}