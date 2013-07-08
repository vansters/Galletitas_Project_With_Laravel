<?php

class UtilidadesCompras {

    //  --  Constantes Genéricas para Proveedores
    public $titulo = 'Panel de Compras RIC';
    public $numPaginas;
    public $proveedores;
    public $compras;
    public $items_menu = array('Inicio', 'Proveedores', 'Compras');
    public $tit_link = 'Compras';
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
    public $estados_compra = array(   
                            'Espera',
                            'Entregado',
                            'Cancelado',                            
    );

    //  --  Obtener arreglo para construir la interfaz (mainCompras)
    public function construirMainCompras() {
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

//======================OPERACIONES EN PROVEEDORES
    //  --  Generar datos para tabla de proveedores
    public function tablaProveedores(){
        //  --  Contamos los proveedores y traemos los 5 primeros
        $this->numPaginas = ceil(Proveedor::count()/5);
        $this->proveedores = Proveedor::order_by('id', 'asc')->take(5)->get();    
    } 

    //  --  Obtener arreglo para construir la interfaz (Proveedores)
    public function constuirProveedores($pagina){
        $datos = array(
            'titulo'            => $this->titulo,

            'text_btn'          => 'Agregar Proveedor',

            'alertas'           =>  false,

            'titulos'           => array('id','RFC', 'Nombre', 'Estado', 'Telefono', 'Opciones'),

            'proveedores'          => $this->proveedores,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'act'               => 'Proveedores',

            'offset'            => $this->offset,

            'span'              => $this->span,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'estados'           => $this->estados
        );
        return $datos;
    }// -- Fin

    //  =====================================   Agregar un Proveedor
    //  --  Validemos Proveedor
    public function validarProveedor(){
        //  --  Recuperar Datos del Formulario
        $datos = array (
            'rfc'       =>  Input::get('rfc'),
            'correo'    =>  Input::get('correo') 
        );
        //  --  Reglas de validacion
        $reglas = array(
            'rfc'           =>  'unique:proveedor',
            'correo'        =>  'unique:proveedor', 
        );
        //  --  Mensajes de validacion personalizados
        $mensajes = array(
            'rfc_unique'                =>  'El RFC ingresado ya esta registrado en el sistema.',
            'correo_unique'             =>  'El Correo ingresado ya esta registrado en el sistema.',
        );
        $v = Validator::make($datos,$reglas,$mensajes);
        return $v;
    }// --  Fin

    //  --  Datos para agregar proveedor
    public function datosProveedor(){
        $insertar = array (
            'rfc'           =>  Input::get('rfc'),
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

    //  --  Modal registrar proveedor
    public function modalAgregarProveedor($nombre){
        $datos = array('funcion' =>  'Proveedor agregado',
                        'mensaje' => 'El Proveedor '.$nombre.' se agrego <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn btn-info" id="ref_gestion_mod">Ir a Gestion</button>
                                       <button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  --  Modal registrar proveedor Error
    public function modalAgregarProveedorError($errores){
        $datos = array('funcion' =>  'Error al agregar proveedor',
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

    //  =====================================   Paginando Proveedores
    //  --  Nueva pagina  de Proveedores
    public function nuevaPaginaProveedores($num){
      //  --  Contamos los usuarios y traemos la pagina
        $this->numPaginas = ceil(Proveedor::count()/5);
        $this->proveedores = Proveedor::order_by('id', 'asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla 
    public function paginarProveedores($pagina){
       $datos = array(
            'titulos'           => array('id','RFC', 'Nombre', 'Estado', 'Telefono', 'Opciones'),

            'proveedores'          => $this->proveedores,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'estados'           => $this->estados
        ); 
        return $datos;
    }// --  Fin

    //  --  Contruir tabla de proveedores (Con Filtro de Busqueda)
    public function tablaProveedoresFiltro($busqueda){
        $this->proveedores = Proveedor::where('correo','like',$busqueda)
                                    ->or_where('rfc','like',$busqueda)
                                    ->or_where('nombre','like',$busqueda)
                                    ->or_where('estado','like',$busqueda)
                                    ->get();
        $this->numPaginas = 0;
    }

    //  --  Contruir tabla de proveedores (Con Filtro de Busqueda)
    public function tablaProveedoresComprasFiltro($busqueda){
        $this->proveedores = Proveedor::where('nombre','=',$busqueda)
                                    ->or_where('rfc','=',$busqueda)
                                    ->first();
        return $this->proveedores->id;
    }

    //  =====================================   Modificar un Proveedor
    //  --  Nuevos datos de proveedor
    public function nuevosDatosProveedores($proveedor){
        $proveedor->rfc           =  Input::get('rfc');
        $proveedor->nombre        =  Input::get('nombre');
        $proveedor->telefono      =  Input::get('tel');
        $proveedor->estado        =  Input::get('estado');
        $proveedor->delegacion    =  Input::get('delegacion');
        $proveedor->colonia       =  Input::get('colonia');
        $proveedor->calle         =  Input::get('calle');
        $proveedor->numero        =  Input::get('numero');
        $proveedor->codigo        =  Input::get('codigo');
        $proveedor->correo        =  Input::get('correo');
        return $proveedor;
    }// --  Fin

    //  --  Modal Modificar proveedor
    public function modalModificarProveedor($nombre){
        $datos = array('funcion' =>  'Proveedor modificado',
                        'mensaje' => 'El Proveedor '.$nombre.' se modifico <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  --  Modal Modificar Error
    public function modalModificarProveedorError($errores){
        $datos = array('funcion' =>  'Error al modificar proveedor',
                        'mensaje' => $errores,
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 

    //  =====================================   Eliminar Proveedor
    //  --  Modal Eliminar proveedor
    public function modalEliminarProveedor($nombre){
        $datos = array('funcion' =>  'Proveedor eliminado',
                        'mensaje' => 'El Proveedor '.$nombre.' se elimino <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin

    //  --  Modal Eliminar proveedor
    public function modalEliminarProveedorError($nombre){
        $datos = array('funcion' =>  'Error al eliminar proveedor',
                        'mensaje' => 'El Proveedor '.$nombre.' no fue encontrado en el sistema.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin

    //  =====================================   Buscar un Proveedor
    //  --  Buscamos un Proveedor
    public function autocompletadoProveedores($busqueda){
        //  --  Consulta a la BD
        $proveedores = Proveedor::group_by('estado')
                                ->where('correo','like',$busqueda)
                                ->or_where('rfc','like',$busqueda)
                                ->or_where('nombre','like',$busqueda)
                                ->or_where('estado','like',$busqueda)
                                ->get(array('correo','estado','rfc','nombre'));
        //  --  Creamos un arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array(''));
        foreach ($proveedores as $value) {
            array_push($datos['datos'], $value->rfc);
            array_push($datos['datos'], $value->estado);
            array_push($datos['datos'], $value->correo);
            array_push($datos['datos'], $value->nombre);
        }
        return $datos;
    }

    //  --  Buscamos un Proveedor
    public function autocompletadoProveedoresCompras($busqueda){
        //  --  Consulta a la BD
        $proveedores = Proveedor::group_by('estado')
                                ->or_where('rfc','like',$busqueda)
                                ->or_where('nombre','like',$busqueda)
                                ->get(array('rfc','nombre'));
        //  --  Creamos un arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array(''));
        foreach ($proveedores as $value) {
            array_push($datos['datos'], $value->rfc);
            array_push($datos['datos'], $value->nombre);
        }
        return $datos;
    }
//======================FIN DE OPERACIONES EN PROVEEDORES

//======================OPERACIONES EN COMPRAS
    //  --  Obtener Arreglo de Interfaz (COMRAS)
    public function tablaCompras(){
        //  --  Contamos los proveedores y traemos los 5 primeros
        $this->numPaginas = ceil(Compra::count()/5);
        $this->compras = Compra::order_by('id', 'asc')->take(5)->get();    
    } 

    public function construirCompras($pagina) {
        $datos = array(
            'titulo'        => $this->titulo,
            'text_btn'      => 'Agregar Compra',
            'alertas'           =>  false,
            'titulos'       => array('ID Compra', 'Fecha Entrega', 'Estado de compra', 'Total', 'Proveedor','Opciones'),
            'compras'       => $this->compras,
            'num_paginas'   => $this->numPaginas,
            'pagina'        => $pagina,
            'act'           => 'Compras',
            'offset'        => $this->offset,
            'datos'         => array(''),
            'span'          => $this->span,
            'items_menu'    => $this->items_menu,
            'tit_link'      => $this->tit_link,
            'proveedores'   => Proveedor::get(),
            //'mp_proveedores'  =>MateriaProveedor::get()       
        );
        return $datos;
    }


    //  =====================================   Paginando Compras
    //  --  Nueva pagina  de Compras
    public function nuevaPaginaCompras($num){
      //  --  Contamos los usuarios y traemos la pagina
        $this->numPaginas = ceil(Compra::count()/5);
        $this->compras = Compra::order_by('id', 'asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla 
    public function paginarCompras($pagina){
       $datos = array(
            'titulos'       => array('ID Compra', 'Fecha Entrega', 'Estado', 'Total', 'Proveedor','Opciones'),

            'compras'          => $this->compras,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'act'               => 'Compras',

            'offset'            => $this->offset,

            'span'              => $this->span,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'proveedores'          => Proveedor::get()
        ); 
        return $datos;
    }// --  Fin

    //  --  Buscamos una Compra
    public function autocompletadoCompras($busqueda){
        //  --  Consulta a la BD
        $compras = Compra::group_by('estado')
                                ->where('id','like',$busqueda)                                
                                ->where(function($query) use($busqueda){
                                    $query->or_where('estado','like',$busqueda);
                                })
                                ->get(array('id','estado'));
        //  --  Creamos uasort(array, cmp_function)n arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array(''));
        foreach ($compras as $value) {
            array_push($datos['datos'], $value->id);
            array_push($datos['datos'], $value->estado);
        }
        return $datos;
    }

    public function tablaComprasFiltro($busqueda){
        $this->compras = Cliente::where('id','like',$busqueda)
                                    ->or_where('estado','like',$busqueda)
                                    ->get(array('id','estado')
                            );
        $this->numPaginas = 0;
    }
//======================FIN DE OPERACIONES EN COMPRAS



    //  --  Obtener Arreglo de Interfaz (Reportes)
    public function construirReportes() {
        $datos = array(
            'titulo' => $this->titulo,
            'usuario' => $this->usuario,
            'alertas'           =>  false,
            'num_paginas' => 10,
            'tit_menu' => $this->tit_menu,
            'tit_link' => $this->tit_link,
            'items_menu' => $this->items_menu,
            'act' => 'Reportes',
            'instrucciones_1' => '<strong>Instrucciones:</strong> Ingresa la información solicitada <strong>
        Recuerda!</strong> todos los campos marcados con *  son obligatorios.',
            'instrucciones_2' => '<strong>Tipos de Reporte:</strong> Puede seleccionar más de uno,  si así lo requieres.',
            'offset' => $this->offset,
            'span' => $this->span,
            'pagina'       => 1
        );
        return $datos;
    }



}