<?php

class Compras_Controller extends Base_Controller {

    //  --  Funcion Inicio Compras
    public function action_inicio() {
        $util = new UtilidadesCompras();
        $datos = $util->construirMainCompras();
        return View::make('compras.main_compras', $datos);
    }


//  ================================================================================================ 
//      Acciones para Proveedores
//  ================================================================================================

    //  --  Función Gestión de Proveedores -> (Inicio de Proveedores)
    public function action_proveedores() {
        $util = new UtilidadesCompras();
        $util->tablaProveedores();
        $datos = $util->constuirProveedores(1);
        unset($util);   //  --  Destruimos util
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',1,60);
        return View::make('compras.proveedores.proveedores', $datos);
    }// --  Fin

    //  --  Función para Agregar Proveedor
    public function action_agregarProveedor(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();

        //  --  Validamos Proveedor
        $val = $util->validarProveedor();

        if ($val->passes()){    //  --  Validación
            //  --  Creamos un nuevo Proveedor
            $proveedor = new Proveedor($util->datosProveedor());
            //  --  Guardamos el Proveedor
            $proveedor->save();
            //  --  Generamos el Modal
            $datos = $util->modalAgregarProveedor($proveedor->nombre);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }else{
            //  --  Obtenemos los posibles Errores
            $e = $util->formatearErrores($val);
            $datos = $util->modalAgregarProveedorError($e);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }
    }// --  Fin

    //  --  Función para modificar Proveedor
    public function action_modificarProveedor(){
        //  --  Traemos al proveedor (Si Existe)
        $proveedor =  Proveedor::where('id','=',Input::get('id'))->first();
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();

        //  --  Verificamos cambios en datos unicos 
        if($proveedor->rfc == Input::get('rfc') && $proveedor->correo == Input::get('correo')){
            $proveedorGuardar = $util->nuevosDatosProveedores($proveedor);
            $proveedorGuardar->save();
            $datos = $util->modalModificarProveedor($proveedor->nombre);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }else{
            $val = $util->validarProveedor();
            if($val->passes()){
                $proveedorGuardar = $util->nuevosDatosProveedores($proveedor);
                $proveedorGuardar->save();
                $datos = $util->modalModificarProveedor($proveedor->nombre);
                unset($util);   //  --  Destruimos util
                return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
            }else{
                //  --  Obtenemos los posibles Errores
                $e = $util->formatearErrores($val);
                $datos = $util->modalModificarProveedorError($e);
                unset($util);   //  --  Destruimos util
                return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
        }   
    }// --  Fin

    //  --  Función para eliminar a un Proveedor
    public function action_eliminarProveedor(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        //  --  Buscamos al Proveedor
        $proveedor = Proveedor::find(Input::get('id'));
        if (is_object($proveedor)){
            //  --  Borramos al Usuario
            $proveedor->delete();
            $datos = $util->modalEliminarProveedor($proveedor->nombre);
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }else{
            $datos = $util->modalEliminarProveedorError($proveedor->nombre);
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }
    }// --  Fin

    //  --  Función para Paginar Proveedores (Usando Paginador)
    public function action_paginarProveedor(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        $util->nuevaPaginaProveedores(Input::get('pagina'));
        $datos = $util->paginarProveedores(Input::get('pagina'));
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),60);
        unset($util);
        return View::make('compras.proveedores.gestion_proveedores',$datos);
    }// --  Fin

    //  --  Función para Paginacion Automática sin Búsqueda
    public function action_autoPaginarProveedores(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        $util->nuevaPaginaProveedores((int)Cookie::get('pagina'));
        $datos = $util->paginarProveedores((int)Cookie::get('pagina'));
        //  --   Verificando el # de Datos
        if(!is_object($util->proveedores) && count($util->proveedores) == 0){    //  --  Si la Pagina Esta vacía
            $util->nuevaPaginaProveedores(((int)Cookie::get('pagina'))-1);
            $datos = $util->paginarProveedores(((int)Cookie::get('pagina'))-1);  
        }
        unset($util);
        return View::make('compras.proveedores.gestion_proveedores',$datos);
    }// --  Fin

    //  --  Funcion para Buscar Proveedores
    public function action_buscarProveedor(){
        //  --  Prametro de busqueda
        //$busqueda = '%'.Input::get('query').'%';
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        $datos = $util->autocompletadoProveedores('%'.Input::get('query').'%');
        return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScript      
    }// --  Fin

    //  --  Funcion para Buscar Proveedores EN COMPRAS
    public function action_buscarProveedorCompras(){
        //  --  Prametro de busqueda
        //$busqueda = '%'.Input::get('query').'%';
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        $datos = $util->autocompletadoProveedoresCompras('%'.Input::get('query').'%');
        return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScript      
    }// --  Fin

    //  --  Funcion Paginar  Resultados Busqueda
    public function action_paginarResultados(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();

        $util->tablaProveedoresFiltro(Input::get('item'));
        $datos = $util->paginarProveedores(0);

        unset($util);   //  --  Destruimos util

        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),10);

        return View::make('compras.proveedores.gestion_proveedores', $datos,200);
    }// --  Fin

    //  --  Funcion Paginar  MATERIAS PRIMAS DE PROVEEDORES EN COMPRAS!!!!
    public function action_llenarCombosCompras(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();

        $id_Proveedor = $util->tablaProveedoresComprasFiltro(Input::get('item'));
        
        $materias = MateriaProveedor::where('proveedor_id','=',$id_Proveedor)->get();

        $datos = array('');
        $ids = array('');

        foreach ($materias as $value) {
            $nombrMateria  =  Catalogo::find($value->catalogo_mp_id);
            array_push($datos, $nombrMateria->nombre);
            array_push($ids, $value->catalogo_mp_id);
        }

        //var_dump($datos);

        $paff = array(
            'datos'     =>  $datos
            );

        unset($util);   //  --  Destruimos util
        return View::make('compras.compras.combo', $paff,200);
    }// --  Fin


//  ================================================================================================ 
//      Fin Acciones para Proveedores
//  ================================================================================================


    public function action_hola(){
        
        $materias = MateriaProveedor::get();

        var_dump($materias);

        /*
        $datos = array('');

        foreach ($materias as $value) {
            $nombrMateria  =  Catalogo::find($value->catalogo_mp_id);
            array_push($datos, $nombrMateria->nombre);
        }

        $paff = array(
            'datos'     =>      $datos
            );

        unset($util);   //  --  Destruimos util
        return View::make('compras.compras.comboMateriaPrima', $paff,200);
        */

    }
//  ================================================================================================ 
//      Acciones para COMPRAS
//  ================================================================================================
        //  --  Función Gestión de Compras -> (Inicio de Compras)
    public function action_compras() {
        $util = new UtilidadesCompras();
        $util->tablaCompras();
        $datos = $util->construirCompras(1);
        unset($util); 
        //  --  Datos para Construir la Interfaz
        Cookie::forget('pagina');
        Cookie::put('pagina',1,60);
        return View::make('compras.compras.compras', $datos);
    }

    //  --  Función para Paginar Compras (Usando Paginador)
    public function action_paginarCompra(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        $util->nuevaPaginaCompras(Input::get('pagina'));
        $datos = $util->paginarCompras(Input::get('pagina'));
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),60);
        unset($util);
        return View::make('compras.compras.gestion_compras',$datos);
    }// --  Fin

    //  --  Función para Paginacion Automática sin Búsqueda
    public function action_autoPaginarCompras(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        $util->nuevaPaginaCompras((int)Cookie::get('pagina'));
        $datos = $util->paginarCompras((int)Cookie::get('pagina'));
        //  --   Verificando el # de Datos
        if(!is_object($util->compras) && count($util->compras) == 0){    //  --  Si la Pagina Esta vacía
            $util->nuevaPaginaCompras(((int)Cookie::get('pagina'))-1);
            $datos = $util->paginarCompras(((int)Cookie::get('pagina'))-1);  
        }
        unset($util);
        return View::make('compras.´compras.gestion_compras',$datos);
    }// --  Fin

    //  --  Funcion para Buscar Compras
    public function action_buscarCompra(){
        //  --  Prametro de busqueda
        //$busqueda = '%'.Input::get('query').'%';
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();
        $datos = $util->autocompletadoCompras('%'.Input::get('query').'%');
        return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScript      
    }// --  Fin

    //  --  Funcion Paginar  Resultados Busqueda
    public function action_paginarResultadosCompra(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCompras();

        $util->tablaComprasFiltro(Input::get('item'));
        $datos = $util->paginarCompras(0);

        unset($util);   //  --  Destruimos util

        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),10);

        return View::make('compras.compras.gestion_compras', $datos,200);
    }// --  Fin
//  ================================================================================================ 
//      FIN Acciones para COMPRAS
//  ================================================================================================


    //  --  Funcion Gestion de REPORTES
    public function action_reportes() {
        $Const_V = new ConstantesCompras();
        //  --  Datos para Construir la Interfaz
        $Const_V->setUsuario(Auth::user()->nombre.' '.Auth::user()->appaterno);
        $datos = $Const_V->constuirReportes();
        return View::make('compras.reportes.reportes', $datos);
    }
}