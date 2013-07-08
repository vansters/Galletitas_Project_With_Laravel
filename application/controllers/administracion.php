<?php

class Administracion_Controller extends Base_Controller {

    //  --  Función para index (login)
    public function action_index() {

        //  --  Clase con métodos axilares para administración
        $util = new UtilidadesAdmin();

        //  --  Recuperando formulario  y  construyendo validación
        $val = $util->validarLogin();

        if ($val->passes()){    //  --  Validación

            if (Auth::attempt($util->usuario)){ //  --  Autenticando Usuario

                if (strtolower(Auth::user()->depto) == 'administración'){// --  Entramos a administración
                    $util->tablaUsuarios();
                    $datos = $util->constuirUsuarios(1);
                    unset($util);   //  --  Destruimos util
                    return View::make('admin.main_admin', $datos);
                }else{
                    $accion = $util->quitarAcentos((Auth::user()->depto)).'@inicio';
                    unset($util);   //  --  Destruimos util
                    return Redirect::to_action($accion);// --  Entramos a otro modulo 
                }

            }else{
                return View::make('home.error_index',$util->error(1));
            }

        }else{
            return View::make('home.error_index',$util->error(2));
        }  
    }// --  Fin index


    //  --  Función para Logout
    public function action_logout() {
        Auth::logout();
        return Redirect::to('/');
    }// --  Fin Logout


    //  --  Función para registrar nuevo usuario
    public function action_registrar(){

        //  --  Clase con métodos axilares para administración
        $util = new UtilidadesAdmin();

        //  --  Recuperando formulario  y  construyendo validación
        $val = $util->validarRegistrarUsuario();

        if ($val->passes()){    //  --  Validación
            //  --  Creamos un Nuevo Usuario
            $usuario = new Usuario($util->datosRegistrarUsuario());
            //  --  Guardamos el Usuario
            $usuario->save();
            $datos = $util->modalRegistrar($usuario->nombre,$usuario->apPaterno,$usuario->apMaterno);
            return Response::json($datos);  //  --  Enviamos los Datos x JSON a JavaScript
        }else{
            //  --  Obtenemos los posibles Errores
            $mensajes = $val->errors->all();
            $errores = array();
            //  --  Guardando Errores en un Arreglo
            foreach ($mensajes as $e) {
                    $errores = $e;
            }

            $datos = array('status'  => 'mal','funcion'  => 'Error al agregar usuario', 'mensaje' => $errores,);
            return Response::json($datos);  //  --  Enviamos los Datos x JSON a JavaScrip
        }

    }// --  Fin registrar

    //  --  Funcion para Paginar Tabla de Usuarios
    public function action_paginar(){
        Cookie::forget('busqueda');
        //  --  Clase con métodos axilares para administración
        $util = new UtilidadesAdmin();
        $util->tablaUsuariosPaginar(Input::get('pagina'));
        $datos = $util->paginarUsuarios(Input::get('pagina'));
        unset($util);   //  --  Destruimos util
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),10);
        return View::make('admin.usuarios.usuarios', $datos);
    }// --  Fin paginar 


    //  --  Funcion para Autopaginar tabla de usuarios
    public function action_paginarR(){
        //  --  Clase con métodos axilares para administración
        $util = new UtilidadesAdmin();
        $util->tablaUsuariosPaginar((int)Cookie::get('pagina'));
        $datos = $util->paginarUsuarios((int)Cookie::get('pagina'));  
        
        unset($util);   //  --  Destruimos util
        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::put('pagina',Cookie::get('pagina'));
        
        return View::make('admin.usuarios.usuarios', $datos,200);
    }// --  Fin Autopaginar tabla de usuarios




    //  --  Funcion para Modificar Usuario
    public function action_modificar(){
        //  --  Validemos que el Usuario Exista
        $usuario = Usuario::where('id','=',Input::get('id'))->first();

/*----*/if ($usuario->rfc == Input::get('rfc') && $usuario->correo == Input::get('correo')){
            $util = new UtilidadesAdmin();
            $usuario->nombre    = Input::get('nombre');
            $usuario->apPaterno = Input::get('apPaterno');
            $usuario->apMaterno = Input::get('apMaterno');
            $usuario->depto     = Input::get('depto');
            //  --  Guardamos el Usuario     
            $usuario->save();
            $datos = $util->modalModificar($usuario->nombre,$usuario->apPaterno,$usuario->apMaterno);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScript
/*----*/}elseif($usuario->rfc != Input::get('rfc') && $usuario->correo == Input::get('correo')){
            //  --  Clase con métodos axilares para administración
            $util = new UtilidadesAdmin();
            //  --  Recuperando formulario  y  construyendo validación
            $val = $util->validarModificarUsuario(1);
            if ($val->passes()){
                //  --  Asignamos Valores
                $usuario->nombre    = Input::get('nombre');
                $usuario->apPaterno = Input::get('apPaterno');
                $usuario->apMaterno = Input::get('apMaterno');
                $usuario->depto     = Input::get('depto');
                $usuario->rfc       = Input::get('rfc');
                //  --  Guardamos el Usuario     
                $usuario->save();
                $datos = $util->modalModificar($usuario->nombre,$usuario->apPaterno,$usuario->apMaterno);
                return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScript
            }else{
                //  --  Obtenemos los posibles Errores
                $mensajes = $val->errors->all();
                $errores = array();
                //  --  Guardando Errores en un Arreglo
                foreach ($mensajes as $e) {
                        $errores = $e;
                }

                $datos = array('status'  => 'mal','funcion'  => 'Error al modificar usuario', 'mensaje' => $errores,);
                return Response::json($datos,202);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
/*----*/}elseif($usuario->rfc == Input::get('rfc') && $usuario->correo != Input::get('correo')){
            //  --  Clase con métodos axilares para administración
            $util = new UtilidadesAdmin();
            //  --  Recuperando formulario  y  construyendo validación
            $val = $util->validarModificarUsuario(2);
            if ($val->passes()){
                //  --  Asignamos Valores
                $usuario->nombre    = Input::get('nombre');
                $usuario->apPaterno = Input::get('apPaterno');
                $usuario->apMaterno = Input::get('apMaterno');
                $usuario->depto     = Input::get('depto');
                $usuario->correo    = Input::get('correo');
                //  --  Guardamos el Usuario     
                $usuario->save();
                $datos = $util->modalModificar($usuario->nombre,$usuario->apPaterno,$usuario->apMaterno);
                return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScript
            }else{
                //  --  Obtenemos los posibles Errores
                $mensajes = $val->errors->all();
                $errores = array();
                //  --  Guardando Errores en un Arreglo
                foreach ($mensajes as $e) {
                        $errores = $e;
                }

                $datos = array('status'  => 'mal','funcion'  => 'Error al modificar usuario ', 'mensaje' => $errores,);
                return Response::json($datos,202);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
/*----*/}else{
            //  --  Clase con métodos axilares para administración
            $util = new UtilidadesAdmin();
            //  --  Recuperando formulario  y  construyendo validación
            $val = $util->validarModificarUsuario(3);
            if ($val->passes()){
                //  --  Asignamos Valores
                $usuario->nombre    = Input::get('nombre');
                $usuario->apPaterno = Input::get('apPaterno');
                $usuario->apMaterno = Input::get('apMaterno');
                $usuario->depto     = Input::get('depto');
                $usuario->rfc       = Input::get('rfc');
                $usuario->correo    = Input::get('correo');
                //  --  Guardamos el Usuario     
                $usuario->save();
                $datos = $util->modalModificar($usuario->nombre,$usuario->apPaterno,$usuario->apMaterno);
                return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScript
            }else{
                //  --  Obtenemos los posibles Errores
                $mensajes = $val->errors->all();
                $errores = array();
                //  --  Guardando Errores en un Arreglo
                foreach ($mensajes as $e) {
                        $errores = $e;
                }

                $datos = array('status'  => 'mal','funcion'  => 'Error al modificar usuario ', 'mensaje' => $errores,);
                return Response::json($datos,202);  //  --  Enviamos los Datos x JSON a JavaScrip
            }
        }        
    }


    //  --  Funcion para Eliminar Usuarios
    public function action_eliminar(){
        $util = new UtilidadesAdmin();
        //  --  Buscamos Usuario
        $usuario = Usuario::find(Input::get('id'));
        if ($usuario->id == Auth::user()->id){
            $respuesta = $util->modalEliminar($usuario->nombre,$usuario->apPaterno,$usuario->apMaterno);
            $datos = $respuesta['mal']; 
        }else{
            $usuario->delete();
            $respuesta = $util->modalEliminar($usuario->nombre,$usuario->apPaterno,$usuario->apMaterno);
            $datos = $respuesta['bien'];   
        }
        return Response::json($datos);  //  --  Enviamos los Datos x JSON a JavaScript
    }

    //  --  Funcion para Cambiar Password
    public function action_cambiarpass(){
        $util = new UtilidadesAdmin();

        //  --  Buscamos al Usuario
        $usuario = Usuario::find(Auth::user()->id);
        //  --  Verificamos la contrasena 
        if (Hash::check(Input::get('actualPass'), $usuario->password)){
            $usuario->password = Hash::make(Input::get('nuevoPass'));
            $usuario->save();
            $respuesta = $util->modalCambiarPass();
            $datos= $respuesta['bien'];
        }else{
            $respuesta = $util->modalCambiarPass();
            $datos= $respuesta['mal'];
        }

        return Response::json($datos);  //  --  Enviamos los Datos x JSON a JavaScript
    }


    //  --  Funcion para Buscar Usuarios
    public function action_buscar(){
        //  --  Prametro de busqueda
        $busqueda = '%'.Input::get('query').'%';
        //  --  Consulta a la BD
        $usuarios = Usuario::where('correo','like',$busqueda)
                             ->or_where('rfc','like',$busqueda)
                             ->or_where('depto','like',$busqueda)
                             ->get(array('depto','rfc','correo'));
        //  --  Creamos un arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array('Administración','Compras','Calidad','Producción','Ventas'));
        foreach ($usuarios as $value) {
            array_push($datos['datos'], $value->correo);
            array_push($datos['datos'], $value->rfc);
        }

        return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScript      
    }

    //  --  Funcion para Renderizar la tabla  busqueda
    public function action_paginarResul(){
        //  --  Clase con métodos axilares para administración
        $util = new UtilidadesAdmin();

        $util->tablaUsuariosFiltro(Input::get('item'));
        $datos = $util->paginarUsuarios(0); 

        unset($util);   //  --  Destruimos util

        //  --  Creamos una Cookie con la Ultima Pag Visitada
        Cookie::forget('pagina');
        Cookie::put('pagina',Input::get('pagina'),10);

        return View::make('admin.usuarios.usuarios', $datos,200);
    }


    //  --  Función para Generar PDF's
    public function action_pdf(){
        
        $html2pdf = new HTML2PDF('P', 'A4', 'es');

        $html2pdf->WriteHTML(View::make('ejemplopdf')
            ->with('valor1', 100)
            ->with('valor2', 50)
            ->with('valor3', 125));
        return Response::make(  $html2pdf->Output('reporte.pdf'), 
                                200, 
                                array('Content-type' => 'application/pdf')
                            );
    }


}
