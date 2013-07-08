<?php

class UtilidadesAdmin {

    //  --  Constantes Genéricas para todo el Modulo
    public $titulo = 'Panel de Administración';
    public $numPaginas;
    public $usuarios;
   

    //  --  Obtener arreglo para construir la interfaz
    public function constuirUsuarios($pagina) {
        $datos = array(
            'titulo'            => $this->titulo,

            'text_btn'          => 'Agregar Usuario',

            'alertas'           =>  false,

            'titulos'           => array('id','RFC', 'Nombre (s)', 'Apellido (s)', 'Departamento', 'Opciones'),

            'usuarios'          => $this->usuarios,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'departamentos'      => array('Administración','Compras','Calidad','Producción','Ventas')
        );
        return $datos;
    }// --  Fin constuirUsuarios


    //  --  Validar datos de Login
    public function validarLogin(){
        //  --  Recuperar datos del formulario
        $datos = array(
            'username'  => Input::get('nomUsuario'),
            'password'  => Input::get('passUsuario')
        );
        //  --  Reglas de validacion
        $reglas = array(
            'username'  =>  'required',
            'password'  =>  'required'
        );
        //  --  Mensajes de validacion personalizados
        $mensajes = array(
            'username_required' =>  'El nombre de usuario es requerido',
            'password_required' =>  'Contraseña requerida' 
        );
        $v = Validator::make($datos,$reglas,$mensajes);
        $this->usuario = $datos;
        return $v;
    }// --  Fin validarLogin


    //  --  Validar Registrar Usuario
    public function validarRegistrarUsuario(){
        //  --  Recuperar datos del formulario
        $datos = array (
            'rfc'           =>  Input::get('rfc'),
            'correo'        =>  Input::get('correo')
        );
        //  --  Reglas de validacion
        $reglas = array(
            'rfc'           =>  'unique:users',
            'correo'        =>  'unique:users', 
        );
        //  --  Mensajes de validacion personalizados
        $mensajes = array(
            'rfc_unique'                =>  'El RFC ingresado ya está registrado en el sistema.',
            'correo_unique'             =>  'El correo ingresado ya está registrado en el sistema.',
        );
        $v = Validator::make($datos,$reglas,$mensajes);
        return $v;
    }// -- Fin validarRegistrarUsuario

    //  --  Datos para Registrar Usuario
    public function datosRegistrarUsuario(){
        $insertar = array (
            'nombre'        =>  Input::get('nombre'),
            'apPaterno'     =>  Input::get('apPaterno'),
            'apMaterno'     =>  Input::get('apMaterno'),
            'depto'         =>  Input::get('depto'),
            'rfc'           =>  Input::get('rfc'),
            'password'      =>  Hash::make(Input::get('pass')),
            'correo'        =>  Input::get('correo')
        );
        return $insertar;
    }// --  Fin datosRegistrarUsuario


    //  --  Modal registrar usuario
    public function modalRegistrar($nombre,$apPaterno,$apMaterno){
        $datos = array('status'   => 'ok',
                        'funcion' => 'Usuario agregado',
                        'mensaje' => 'El usuario '.$nombre.' '.$apPaterno.' '.$apMaterno.
                                         ' se agrego <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn btn-info" id="ref_gestion_mod">Ir a Gestion</button>
                                       <button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;

    }// --  Fin modalRegistrar


    //  --  Generar datos para tabla de gestion
    public function tablaUsuarios(){
        //  --  Contamos los usuarios y traemos los 5 primeros
        $this->numPaginas = ceil(Usuario::count()/5);
        $this->usuarios = Usuario::order_by('id', 'asc')->take(5)->get();
    }// --  Fin tablaUsuarios


    //  --  Generar Tabla de Gestion de Usuarios (Paginacion)
    public function tablaUsuariosPaginar($num){
        //  --  Contamos los usuarios y traemos la pagina
        $this->numPaginas = ceil(Usuario::count()/5);
        $this->usuarios = Usuario::order_by('id', 'asc')->skip(5*($num-1))->take(5)->get();
    }// --  Fin tablaUsuarioPaginar


    //  --  Generar Tabla de RFC Buscado
    public function tablaUsuariosFiltro($busqueda){

        $this->usuarios = Usuario::where('correo','like',$busqueda)
                             ->or_where('rfc','like',$busqueda)
                             ->or_where('depto','like',$busqueda)
                             ->get();
        $this->numPaginas = 0;

    }// --  Fin tablaUsuarioFiltro



    //  --  Construir la tabla 
    public function paginarUsuarios($pagina){
       $datos = array(
            'text_btn'          => 'Agregar Usuario',

            'alertas'           =>  false,

            'titulos'           => array('id','RFC', 'Nombre (s)', 'Apellido (s)', 'Departamento', 'Opciones'),

            'usuarios'          => $this->usuarios,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'departamentos'      => array('Administración','Compras','Calidad','Producción','Ventas')
        ); 
        return $datos;
    }// --  Fin paginarUsuarios


        //  --  Validar Modificar Usuario
    public function validarModificarUsuario($tipo){

        if($tipo==1){
            $datos = array (
                'rfc'           =>  Input::get('rfc')
            );
          $reglas = array(
            'rfc'           =>  'unique:users',
          );
          $mensajes = array(
            'rfc_unique'    =>  'El RFC ingresado ya está registrado en el sistema.',
          ); 
        }elseif ($tipo==2){
            $datos = array (
                'correo'        =>  Input::get('correo')
            );
            $reglas = array(
                'correo'    =>  'unique:users',
            );
            $mensajes = array(
                'correo_unique'  =>  'El correo ingresado ya está registrado en el sistema.',
            ); 
        }elseif($tipo==3){
            $datos = array (
                'rfc'           =>  Input::get('rfc'),
                'correo'        =>  Input::get('correo')
            );
            $reglas = array(
                'rfc'           =>  'unique:users',
                'correo'        =>  'unique:users',
            );
            $mensajes = array(
                'rfc_unique'          =>  'El RFC ingresado ya está registrado en el sistema.',
                'correo_unique'       =>  'El correo ingresado ya está registrado en el sistema.',
            );
        }
        $v = Validator::make($datos,$reglas,$mensajes);
        return $v;
    }// -- Fin validarModificarUsuario


    //  --  Modal Modificar usuario
    public function modalModificar($nombre,$apPaterno,$apMaterno){
        $datos = array(
                        'status'  => 'ok',
                        'funcion' => 'Usuario Modificado',
                        'mensaje' => 'El usuario '.$nombre.' '.$apPaterno.' '.$apMaterno.
                                     ' se actualizo <strong>exitosamente</strong>.',
                        'opciones'=> '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin modalModificar


    //  --  Modal Eliminar usuario
    public function modalEliminar($nombre,$apPaterno,$apMaterno){
        $datos_1 = array('status'   => 'ok',
                        'funcion' => 'Usuario Eliminado',
                        'mensaje' => 'El usuario '.$nombre.' '.$apPaterno.' '.$apMaterno.
                                         ' se eliminó <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        $datos_2 = array('status'   => 'ok',
                        'funcion' => 'Error al eliminar',
                        'mensaje' => 'El usuario '.$nombre.' '.$apPaterno.' '.$apMaterno.
                                     'es un administrador y actualmente tiene una sesión activa.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );

        $datos =  array(
            'bien' => $datos_1,
            'mal'  => $datos_2
            );
        return $datos;
    }// --  Fin modalModificar

    //  --  Errores login
    public function error($tipo){
        $datos;
        if ($tipo == 1){
            $datos = array(
                    'titulo'    => 'Bienvenido',
                    'error'     => '<strong>Error</strong> lo sentimos el usuario no es válido 
                                    si el problema persiste contacta con el administrador.'
                );
        }else{
            $datos = array(
                'titulo'    => 'Bienvenido',
                'error'     => '<strong>Error</strong> faltan datos para ingresar a el sistema.'
            );
        }
        return $datos;
    }

    //  --  Modal Eliminar usuario
    public function modalCambiarPass(){
        $datos_1 = array('status'   => 'ok',
                        'funcion' => 'Contraseña modificada',
                        'mensaje' => 'La contraseña fue cambiada  <strong>exitosamente</strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        $datos_2 = array('status'   => 'mal',
                        'funcion' => 'Error al cambiar contraseña',
                        'mensaje' => 'Debes ingresar tu contraseña actual correctamente',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );

        $datos =  array(
            'bien' => $datos_1,
            'mal'  => $datos_2
            );
        return $datos;
    }// --  Fin modalModificar



    function quitarAcentos($text){
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array (
            // Espacios, puntos y comas por guion
            '/[\., ]+/' => '-',
 
            // Vocales
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',
 
            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',
 
            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',
 
            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',
 
            // Agregar aqui mas caracteres si es necesario
 
        );
 
        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }// --  Fin quitarAcentos

}

?>
