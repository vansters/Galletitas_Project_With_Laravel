<?php

################################################################################
/* 	Enrutando los Controladores ======================================= */
Route::controller('Administracion');
Route::controller('Compras');
Route::controller('Ventas');
Route::controller('Calidad');
Route::controller('Produccion');


################################################################################
/*  Pagina Index de Autenticacion ======================================= */
Route::get('/', function() {
            return View::make('home.index')->with('titulo', 'Bienvenido');
        });


################################################################################
/*  Pagina de Documentación del Framework ================================= */
Route::get('doc', function() {
            return View::make('home.doc');
        });



//  --  Envio de Correo Electronico para Recuperar Pass
Route::post('recuperarPass', function(){
    $datos = array('info' => '');

        //  Envio de Mensaje
        Message::send(function($message)
        {
            //  --  Buscando al Usuario
            $usuario = Usuario::where('correo','=',Input::get('id'))
                                ->or_where('rfc','=',Input::get('id'))
                                ->first();

            if (is_object($usuario)){  //  --  El Usuario Existe
                $correo = $usuario->correo;
                $id = $usuario->rfc;
                $nombre = $usuario->nombre.' '.$usuario->appaterno;
                $link = 'http://galletitaescom.pagodabox.com/';

                try{
                    //  --  Generando Nuevo Pass
                    $pass = substr(md5(microtime()),1,15);
                    $hashPass = Hash::make($pass);
                    $usuario->password = $hashPass;
                    $usuario->save();

                    $message->to($correo);
                    $message->from('galletitas.equipo2@gmail.com', 'Galletitas SA de CV');

                    $message->subject('Solicitud de restablecimiento de contraseña');
                    $message->body('view: correo');

                    $message->body->nombre = $nombre;
                    $message->body->rfc = $id ;
                    $message->body->link = $link ;
                    $message->body->pass = $pass ;

                    $message->html(true); 
                }catch(Exception $e){
                    return Response::json('Error',202);
                }


            }else{
                return Response::json('No Existe',201);   //  --  El Usuario No Existe
            }

        });

        return Response::json('Bien',200);   //  --  Envio correcto
});




################################################################################        
/*      Eventos (Error 404 - 500)   */
Event::listen('404', function() {
            return Response::error('404');
        });

Event::listen('500', function() {
            return Response::error('500');
        });


/*      Filtrando las Rutas    */
Route::filter('before', function() {
            // Do stuff before every request to your application...
        });

Route::filter('after', function($response) {
            // Do stuff after every request to your application...
        });

Route::filter('csrf', function() {
            if (Request::forged())
                return Response::error('500');
        });

Route::filter('auth', function() {
            if (Auth::guest())
                return Redirect::to('login');
        });