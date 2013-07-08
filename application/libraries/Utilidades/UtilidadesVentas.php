<?php

class UtilidadesVentas {

	//	--	Constantes Genéricas para Clientes
	public $titulo = 'Panel de Ventas';
	public $numPaginas;
	public $clientes;
    public $items_menu = array('Inicio', 'Clientes', 'Ventas','Reportes');
    public $tit_link = 'Ventas';
    public $offset = '3';
    public $span = '2';
    public $estados = array(   
                            'Aguascalientes (AGS)',
                            'Baja California Norte (BCN)',
                            'Baja California Sur (BCS)',
                            'Campeche (CAM)',
                            'Chiapas (CHIS)',
                            'Chihuahua (CHIH)',
                            'Coahuila (COAH)',
                            'Colima (COL)',
                            'Distrito Federal (DF)',
                            'Durango (DGO)',
                            'Guanajuato (GTO)',
                            'Guerrero (GRO)',
                            'Hidalgo (HGO)',
                            'Jalisco (JAL)',
                            'México - Estado de (EDM)',
                            'Michoacán (MICH)',
                            'Morelos (MOR)',
                            'Nayarit (NAY)',
                            'Nuevo León (NL)',
                            'Oaxaca (OAX)',
                            'Puebla (PUE)',
                            'Querétaro (QRO)',
                            'Quintana Roo (QROO)',
                            'San Luis Potosí (SLP)',
                            'Sinaloa (SIN)',
                            'Sonora (SON)',
                            'Tabasco (TAB)',
                            'Tamaulipas (TAMPS)',
                            'Tlaxcala (TLAX)',
                            'Veracruz (VER)',
                            'Yucatán (YUC)',
                            'Zacatecas (ZAC)',
    );


//  =====================================   Construir pagina de inicio del Modulo 

    //  --  Obtener arreglo para construir la interfaz (mainVentas)
    public function contuirMainVentas() {
        $datos = array(
            'titulo'            => $this->titulo,

            'alertas'           =>  false,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'act'               => 'Inicio',

            'offset'            => $this->offset,

            'span'              => $this->span
        );
        return $datos;
    }// --  Fin



//  =====================================   Construir Gestión Clientes

    //  --  Generar datos para tabla de clientes
    public function tablaClientes(){
        //  --  Contamos los clientes y traemos los 5 primeros
        $this->numPaginas = ceil(Cliente::where('status','!=','inactivo')->count()/5);
        $this->clientes = Cliente::where('status','!=','inactivo')->
                                   order_by('id', 'asc')->take(5)->get();    
    } 

	//	--	Obtener arreglo para construir la interfaz (Clientes)
	public function constuirClientes($pagina){
		$datos = array(
            'titulo'            => $this->titulo,

            'text_btn'          => 'Agregar Cliente',

            'alertas'           =>  false,

            'titulos'           => array('Id','RFC', 'Nombre', 'Estado', 'Teléfono', 'Opciones'),

            'clientes'          => $this->clientes,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'act'               => 'Clientes',

            'offset'            => $this->offset,

            'span'              => $this->span,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'estados'           => $this->estados
        );
        return $datos;
	}// -- Fin

//  =====================================   Agregar un Cliente
    //  --  Validemos Cliente
    public function validarCliente(){
        //  --  Recuperar Datos del Formulario
        $datos = array (
            'rfc'       =>  Input::get('rfc'),
            'correo'    =>  Input::get('correo') 
        );
        //  --  Reglas de validacion
        $reglas = array(
            'rfc'           =>  'unique:cliente',
            'correo'        =>  'unique:cliente', 
        );
        //  --  Mensajes de validación personalizados
        $mensajes = array(
            'rfc_unique'                =>  'El RFC ingresado ya está registrado en el sistema.',
            'correo_unique'             =>  'El correo ingresado ya está registrado en el sistema.',
        );
        $v = Validator::make($datos,$reglas,$mensajes);
        return $v;
    }// --  Fin

    
    //  --  Validemos Nuevo RFC para Cliente
    public function validarRFC(){
        //  --  Recuperar Datos del Formulario
        $datos = array (
            'rfc'       =>  Input::get('rfc'),
        );
        //  --  Reglas de validación
        $reglas = array(
            'rfc'           =>  'unique:cliente',
        );
        //  --  Mensajes de validación personalizados
        $mensajes = array(
            'rfc_unique'                =>  'El RFC ingresado ya está registrado en el sistema.',
        );
        $v = Validator::make($datos,$reglas,$mensajes);
        return $v;
    }// --  Fin


    //  --  Validemos Nuevo RFC para Cliente
    public function validarCorreo(){
        //  --  Recuperar Datos del Formulario
        $datos = array (
            'correo'    =>  Input::get('correo') 
        );
        //  --  Reglas de validación
        $reglas = array(
            'correo'        =>  'unique:cliente', 
        );
        //  --  Mensajes de validacion personalizados
        $mensajes = array(
            'correo_unique'             =>  'El Correo ingresado ya está registrado en el sistema.',
        );
        $v = Validator::make($datos,$reglas,$mensajes);
        return $v;
    }// --  Fin


    //  --  Datos para agregar cliente
    public function datosCliente(){
        $insertar = array (
            'rfc'           =>  strtoupper(Input::get('rfc')),
            'nombre'        =>  Input::get('nombre'),
            'telefono'      =>  Input::get('tel'),
            'estado'        =>  Input::get('estado'),
            'delegacion'    =>  Input::get('delegacion'),
            'colonia'       =>  Input::get('colonia'),
            'calle'         =>  Input::get('calle'),
            'numero'        =>  Input::get('numero'),
            'codigo'        =>  Input::get('codigo'),
            'correo'        =>  Input::get('correo'),
        );
        return $insertar;
    }// --  Fin

    //  --  Modal registrar cliente
    public function modalAgregarCliente($nombre){
        $datos = array('funcion' =>  'Cliente agregado',
                        'mensaje' => 'El cliente '.$nombre.' se agregó <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn btn-info" id="ref_gestion_mod">Ir a Gestion</button>
                                       <button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  --  Modal registrar cliente Error
    public function modalAgregarClienteError($errores){
        $datos = array('funcion' =>  'Error al agregar cliente',
                        'mensaje' => $errores,
                        'opciones'=>  '<button class="btn btn-info" id="ref_gestion_mod">Ir a Gestion</button>
                                       <button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  --  Convertir Errors en una array JSON
    public function formatearErrores($val){
        $mensajes = $val->errors->all();
        $errores = array();
        foreach ($mensajes as $e) {
            $errores = $e;
        }
        return $errores;
    }// --  Fin

//  =====================================   Paginando Clientes
    //  --  Nueva pagina  de Clientes
    public function nuevaPaginaClientes($num){
      //  --  Contamos los usuarios y traemos la pagina
        $this->numPaginas = ceil(Cliente::where('status','!=','inactivo')->count()/5);
        $this->clientes = Cliente::where('status','!=','inactivo')->
                                   order_by('id', 'asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla 
    public function paginarClientes($pagina){
       $datos = array(
            'titulos'           => array('id','RFC', 'Nombre', 'Estado', 'Telefono', 'Opciones'),

            'clientes'          => $this->clientes,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'estados'           => $this->estados
        ); 
        return $datos;
    }// --  Fin

    //  --  Contruir tabla de clientes (Con Filtro de Busqueda)
    public function tablaClientesFiltro($busqueda){
        $this->clientes = Cliente::where('status','!=','inactivo')
                            ->where(function($query) use($busqueda){
                                $query->or_where('correo','like',$busqueda);
                                $query->or_where('rfc','like',$busqueda);
                                $query->or_where('nombre','like',$busqueda);
                                $query->or_where('estado','like',$busqueda);
                            })
                            ->get();
        $this->numPaginas = 0;
    }

//  =====================================   Modificar un Cliente
    //  --  Nuevos datos de cliente
    public function nuevosDatosClientes($cliente){
        $cliente->rfc           =  strtoupper(Input::get('rfc'));
        $cliente->nombre        =  Input::get('nombre');
        $cliente->telefono      =  Input::get('tel');
        $cliente->estado        =  Input::get('estado');
        $cliente->delegacion    =  Input::get('delegacion');
        $cliente->colonia       =  Input::get('colonia');
        $cliente->calle         =  Input::get('calle');
        $cliente->numero        =  Input::get('numero');
        $cliente->codigo        =  Input::get('codigo');
        $cliente->correo        =  Input::get('correo');
        return $cliente;
    }// --  Fin

    //  --  Modal Modificar cliente
    public function modalModificarCliente($nombre){
        $datos = array('funcion' =>  'Cliente modificado',
                        'mensaje' => 'El cliente '.$nombre.' se modificó <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  --  Modal Modificar Error
    public function modalModificarClienteError($errores){
        $datos = array('funcion' =>  'Error al modificar cliente',
                        'mensaje' => $errores,
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

//  =====================================   Eliminar Cliente
    //  --  Modal Eliminar cliente
    public function modalEliminarCliente($nombre){
        $datos = array('funcion' =>  'Cliente eliminado',
                        'mensaje' => 'El cliente '.$nombre.' se eliminó <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin

    //  --  Modal Eliminar cliente
    public function modalEliminarClienteError($nombre){
        $datos = array('funcion' =>  'Error al eliminar cliente',
                        'mensaje' => 'El cliente '.$nombre.' no fue encontrado en el sistema.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin

//  =====================================   Buscar un Cliente
    //  --  Buscamos un Cliente
    public function autocompletadoClientes($busqueda){
        $b = $busqueda;
        //  --  Consulta a la BD
        $clientes = Cliente::group_by('estado')
                                ->where('status','!=','inactivo')
                                ->where(function($query) use($busqueda){
                                    $query->or_where('correo','like',$busqueda);
                                    $query->or_where('rfc','like',$busqueda);
                                    $query->or_where('nombre','like',$busqueda);
                                    $query->or_where('estado','like',$busqueda);
                                })
                                ->get(array('correo','rfc','nombre','estado'));
        //  --  Creamos un arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array(''));
        foreach ($clientes as $value) {
            array_push($datos['datos'], $value->rfc);
            array_push($datos['datos'], $value->estado);
            array_push($datos['datos'], $value->correo);
            array_push($datos['datos'], $value->nombre);  
        }
        return $datos;
    }




//  --------------------    Ventas Ventas ------------------------------
//  --------------------------------------------------------------------

//  =====================================   Construir Gestión Ventas

    //  --  Generar datos para tabla de ventas
    public function tablaVentas(){
        //  --  Contamos las ventas y traemos los 5 primeros
        $this->numPaginas = ceil(Venta::where('estado','=','Espera')->count()/5);
        $this->ventas = Venta::where('estado','=','Espera')->order_by('id', 'asc')->take(5)->get();    
    } 

    //  --  Obtener arreglo para construir la interfaz (Ventas)
    public function constuirVentas($pagina){
        $datos = array(
            'titulo'            => $this->titulo,

            'text_btn'          => 'Agregar Ventas',

            'alertas'           =>  false,

            'titulos'           => array('ID de Venta','Cliente', 'Fecha Entrega','Total' , 'Opciones'),

            'ventas'            => $this->ventas,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'act'               => 'Ventas',

            'offset'            => $this->offset,

            'span'              => $this->span,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'galletas'          => Galleta::get(),
            
            'lotes_aprobados'   => Lote::where('estado','=','Aprobado')->get(),

            'total_lotesAprobados' => Lote::where('estado','=','Aprobado')->count(),
            
            'lotes_vendidos'    => Lote::where('estado','=','Vendido')->get(),

            'clientes'          => Cliente::where('status','=','Activo')->get()
        );
        return $datos;
    }// -- Fin

//  =====================================   Agregar una Venta

    //  --  Datos para agregar Venta
    public function datosVenta(){
        $total=0;
        $contenido = Lote::where('estado','=','Aprobado')->get();
        $numContenido = Lote::where('estado','=','Aprobado')->count();
        for($i=0;$i<$numContenido;$i++)
        {
            if(Input::get('id_lote_aprobado_'.($contenido[$i]->id)) == $contenido[$i]->id)
            {
                $contenido[$i]->estado = 'Vendido';
                $total = $total + $contenido[$i]->precio;
                $contenido[$i]->save();
            }
        }
        $insertar = array (
            'cliente_id'       =>   Input::get('cliente'),
            'estado'           =>   'Espera',
            'total'            =>   $total,
            'fecha_entrega'    =>   Input::get('fecha')
        );
        return $insertar;
    }// --  Fin

    //  -- Actualizar Lotes
    public function actualizaLotes($venta){
        $contenido = Lote::where('estado','=','Vendido')->get();
        $numContenido = Lote::where('estado','=','Vendido')->count();
        for($i=0;$i<$numContenido;$i++)
        {
            if($contenido[$i]->id_venta == NULL)
            {
                $contenido[$i]->id_venta = $venta->id;
                $contenido[$i]->save();
            }
        }
        $cliente = Cliente::where('id','=',$venta->cliente_id)->increment('numCompras');
    }
    //  --  Fin


    //  --  Modal registrar venta
    public function modalAgregarVenta($id){
        $datos = array('funcion' =>  'Venta agregada',
                        'mensaje' => 'La Venta '.$id.' se agregó <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn btn-info" id="ref_gestion_mod">Ir a Gestion</button>
                                       <button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  --  Modal registrar venta Error
    public function modalAgregarVentaError($errores){
        $datos = array('funcion' =>  'Error al agregar venta',
                        'mensaje' => $errores,
                        'opciones'=>  '<button class="btn btn-info" id="ref_gestion_mod">Ir a Gestion</button>
                                       <button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

//  =====================================   Paginando Ventas
    //  --  Nueva pagina  de Ventas
    public function nuevaPaginaVentas($num){
      //  --  Contamos los usuarios y traemos la pagina
        $this->numPaginas = ceil(Venta::where('estado','=','Espera')->count()/5);
        $this->ventas = Venta::where('estado','=','Espera')->order_by('fecha_entrega', 'asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla 
    public function paginarVentas($pagina){
       $datos = array(
            'titulos'           => array('ID de Venta','Cliente', 'Fecha Entrega','Total' , 'Opciones'),

            'ventas'            => $this->ventas,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'galletas'          => Galleta::get(),
            
            'lotes_aprobados'   => Lote::where('estado','=','Aprobado')->get(),

            'total_lotesAprobados' => Lote::where('estado','=','Aprobado')->count(),
            
            'lotes_vendidos'    => Lote::where('estado','=','Vendido')->get(),

            'clientes'          => Cliente::where('status','=','Activo')->get()

        ); 
        return $datos;
    }// --  Fin

    //  --  Contruir tabla de clientes (Con Filtro de Busqueda)
    public function tablaVentasFiltro($busqueda){
        $this->ventas = Venta::where('estado','=','Espera')
                                ->where(function($query) use($busqueda){
                                $query->or_where('cliente_id','like', Cliente::where('nombre', '=', $busqueda)->first()->id);
                                $query->or_where('id','like',$busqueda);
                            })
                            ->get();
        $this->numPaginas = 0;
    }


//  =====================================   Modificar una Venta
    //  --  Nuevos datos de venta
    public function nuevosDatosVentas($venta){
        $contenidoAnterior = Lote::where('id_venta','=',$venta->id)->get();
        $numContenidoAnterior = Lote::where('id_venta','=',$venta->id)->count();
        $contenidoNuevo = Lote::where('estado','=','Aprobado')->get();
        $numContenidoNuevo = Lote::where('estado','=','Aprobado')->count();
        for($i=0;$i<$numContenidoAnterior;$i++)
        {
            if(Input::get('id_lote_vendido_'.($contenidoAnterior[$i]->id)) == $contenidoAnterior[$i]->id)
            {
                $contenidoAnterior[$i]->id_venta = NULL;
                $contenidoAnterior[$i]->estado = 'Aprobado';
                $venta->total = $venta->total - $contenidoAnterior[$i]->precio;
                $contenidoAnterior[$i]->save();
            }
        }
        for($i=0;$i<$numContenidoNuevo;$i++)
        {
            if(Input::get('id_lote_aprobado_'.($contenidoNuevo[$i]->id)) == $contenidoNuevo[$i]->id)
            {
                $contenidoNuevo[$i]->id_venta = $venta->id;
                $contenidoNuevo[$i]->estado = 'Vendido';
                $venta->total = $venta->total + $contenidoNuevo[$i]->precio;
                $contenidoNuevo[$i]->save();
            }
        }

        $venta->fecha_entrega = Input::get('fecha');
        if(Input::get('estado') == 'entregado')
        {
            $venta->estado = 'Entregado';    
        }
        return $venta;
    }// --  Fin

    //  --  Modal Modificar Venta
    public function modalModificarVenta($id){
        $datos = array('funcion' =>  'Venta modificada',
                        'mensaje' => 'La venta '.$id.' se modificó <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  --  Modal Modificar Error
    public function modalModificarVentaError($errores){
        $datos = array('funcion' =>  'Error al modificar venta',
                        'mensaje' => $errores,
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin

//  =====================================   Cancelar Venta
    //  --  Modal Cancelar venta

    public function datosCancelarVenta($venta){
        $contenido = Lote::where('id_venta','=',$venta->id)->get();
        $numContenido = Lote::where('id_venta','=',$venta->id)->count();
        for($i=0;$i<$numContenido;$i++)
        {
            $contenido[$i]->id_venta = NULL;
            $contenido[$i]->estado = 'Aprobado';
            $contenido[$i]->save();
        }
        $cliente = Cliente::where('id','=',$venta->cliente_id)->decrement('numCompras');
        $venta->estado = 'Cancelado';
        $venta->total = 0;
        return $venta;
    }// --  Fin

//  =====================================   Buscar una Venta
    //  --  Buscamos una Venta
    public function autocompletadoVentas($busqueda){
        $b = $busqueda;
        //  --  Consulta a la BD
        $ventas = Venta::group_by('estado')
                                ->where('estado','=','Espera')
                                ->where(function($query) use($busqueda){
                                    $query->or_where('cliente_id','like', Cliente::where('nombre', '=', $busqueda)->first()->id);
                                    $query->or_where('id','like',$busqueda);
                                })
                                ->get(array('cliente_id','id'));
        //  --  Creamos un arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array(''));
        foreach ($ventas as $value) {
            array_push($datos['datos'], $value->cliente_id);
            array_push($datos['datos'], $value->id); 
        }
        return $datos;
    }




// --   Auxiliares para Reportes  ---------------------------------------
//---------------------------------------------------------------------

//  --  Obtener Arreglo de Interfaz (Reportes)
    public function constuirReportes() {
        $datos = array(
            'titulo'            => $this->titulo,

            'alertas'           =>  false,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'act'               => 'Reportes',

            'offset'            => $this->offset,

            'span'              => $this->span
        );
        return $datos;
    }

    
}


