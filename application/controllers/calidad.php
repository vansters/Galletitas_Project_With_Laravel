<?php

class Calidad_Controller extends Base_Controller {

    //  --  Funcion Inicio Calidad
    public function action_inicio() {
        $util = new UtilidadesCalidad();
        $datos = $util->construirMainCalidad();
        return View::make('calidad.main_calidad', $datos);
    }

    //  --  Funcion para Evaluar
    public function action_evaluar() {
    	
      $util= new UtilidadesCalidad();                                   
      $util->tablaMateria();      
      $util->tablaTerminado();
      $datos= $util->construirEvaluar(1);                  
      return View::make('calidad.evaluar.evaluar', $datos);
              
    }
 
    
   public function action_registrar(){
     
        $util = new UtilidadesCalidad();                                     
        $queja = new Queja($util->datosRegistrarQueja());                
        $queja->save();           
        $notificacion = new Notificacion($util->datosRegistrarNotificacion_Queja());
        $notificacion->save();
        $datos = $util->modalRegistrar($queja->id,$queja->lote_id_id);
        return Response::json($datos);  //  --  Enviamos los Datos x JSON a JavaScript                             
    }// --  Fin registrar
 
public function action_registrarfallo(){
     
        $util = new UtilidadesCalidad();            

            $fallo = new Fallo($util->datosRegistrarFallo_Lote());                
            $fallo->save(); 
            $notificacion = new Notificacion($util->datosRegistrarNotificacion_Lote());
            $notificacion->save();                                   
            $datos = $util->modalRegistrar_fallo($fallo->lote_id);
            return Response::json($datos);  //  --  Enviamos los Datos x JSON a JavaScript
            
    }// --  Fin registrar*/
   
 //  --  Función para Evaluar una Materia prima
    public function action_evaluarMateriar(){
    	//************************************************************
                 $util = new UtilidadesCalidad();        	
    	    	    	//************************************************************
    	    	    	    	    	    	    	    	        	
        //  --  Traemos la Materia prima (Si Existe)
        $materia = Materia::find(Input::get('id'));
        //  --  Comprobamos que la Materia Existe
        if(is_object($materia)){
            //  --  Cambiamos el Estado de la Materia (Usa UtilidadesCalidad para Mantener el Código mas Simple y Ordenado)
            $materia->estado = Input::get('estado');
            
            //********************************************                    
            $fallo = new Fallo($util->datosRegistrarFallo());
            $fallo->save();            
            //***********************************************************   
            $notificacion = new Notificacion($util->datosRegistrarNotificacion());
            $notificacion->save();
            //***********************************************************   

            $materia->save();
            $util = new UtilidadesCalidad();
            $datos = $util->modalevaluarMateria($materia->id);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }else{
            $util = new UtilidadesCalidad();
            $datos = $util->modalevaluarMateriaError();
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }  
    }// --  Fin
    
    
    //  --  Función para Aprovar una Materia prima
    
    public function action_aprobarMateriar(){
        //  --  Traemos la Materia prima (Si Existe)
        $materia = Materia::find(Input::get('id'));
        //  --  Comprobamos que la Materia Existe
        if(is_object($materia)){
            //  --  Cambiamos el Estado de la Materia (Usa UtilidadesCalidad para Mantener el Código mas Simple y Ordenado)
            $materia->estado = 'Aprobado';
            //  --  Guardamos el Objeto Nuevamente
            $materia->save(); 
            $util = new UtilidadesCalidad();
            $datos = $util->modalaprobarMateria($materia->id);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip                       
        }else{
            $util = new UtilidadesCalidad();
            $datos = $util->modalevaluarMateriaError();
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }  
    }// --  Fin
    
       //Funcion que Aprueba un Lote Terminado 
       
    public function action_aprobarLote(){
        //  --  Traemos la Materia prima (Si Existe)
        $lote = Lote::find(Input::get('id'));
        //  --  Comprobamos que la Materia Existe
        if(is_object($lote)){
            //  --  Cambiamos el Estado de la Materia (Usa UtilidadesCalidad para Mantener el Código mas Simple y Ordenado)
            $lote->estado = 'Aprobado';
            //  --  Guardamos el Objeto Nuevamente
            $lote->save(); 
            $util = new UtilidadesCalidad();
            $datos = $util->modalaprobarLote($lote->id_lote);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip                       
        }else{
            $util = new UtilidadesCalidad();
            $datos = $util->modalevaluarLoteError();
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }  
    }// --  Fin
    
    //  --  Función para Evaluar Lote Terminado
    
    public function action_evaluarLote(){

        //  --  Traemos la Materia prima (Si Existe)
        $lote = Lote::find(Input::get('id'));        
        //  --  Comprobamos que la Materia Existe
        if(is_object($lote)){
            //  --  Cambiamos el Estado de la Materia (Usa UtilidadesCalidad para Mantener el Código mas Simple y Ordenado)
            $lote->estado = Input::get('estado');                                    
            $lote->save();        
            $util = new UtilidadesCalidad();                       
            $datos = $util->modalevaluarLote($lote->id_lote);
            unset($util);   //  --  Destruimos util
            return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScrip
        }else{
            $util = new UtilidadesCalidad();
            $datos = $util->modalevaluarLoteError();
            unset($util);   //  --  Destruimos util
            return Response::json($datos,201);  //  --  Enviamos los Datos x JSON a JavaScrip
        }  
    }// --  Fin
    

 //  --  Funcion para paginar Materias
    public function action_paginarMaterias(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCalidad();
        $util->nuevaPaginaMateria(Input::get('pagina'));
        $datos = $util->paginarMateria(Input::get('pagina'));
        unset($util);
        return View::make('calidad.evaluar.tabla_materiaprima',$datos); 
    }
    
       public function action_paginarLote(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCalidad();
        $util->nuevaPaginarLote(Input::get('pagina'));
        $datos = $util->paginarLote(Input::get('pagina'));
        unset($util);
        return View::make('calidad.evaluar.tabla_terminado',$datos); 
    }

    public function action_paginarFallo(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCalidad();
        $util->nuevaPaginarFallo(Input::get('pagina'));
        $datos = $util->paginarFallo(Input::get('pagina'));
        unset($util);
        return View::make('calidad.fallos.tabla_fallos',$datos); 
    }
    
      public function action_paginarQueja(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesCalidad();
        $util->nuevaPaginarQueja(Input::get('pagina'));
        $datos = $util->paginarQueja(Input::get('pagina'));
        unset($util);
        return View::make('calidad.fallos.tabla_quejas',$datos); 
    }

  //  --  Funcion para Buscar Materia Prima
    public function action_buscarLote(){  
        $util = new UtilidadesCalidad();
        $datos = $util->autocompletadoLote('%'.Input::get('query').'%');
        return Response::json($datos,200);  //  --  Enviamos los Datos x JSON a JavaScript      
    }// --  Fin

/////////////////////////////////////////////////////////////////////////////////////////

    //  --  Funcion para Quejas
    public function action_quejas() {
        $util = new UtilidadesCalidad();
        //  --  Datos para Construir la Interfaz
        $datos = $util->contruirQuejas();
        return View::make('calidad.quejas.quejas', $datos);
    }
    
///////////////////////////////////////////////////////////////////////////
    
    //  --  Funcion para Fallos
    public function action_fallos() {
      $util= new UtilidadesCalidad();       
      $util->tablaFallos();  
      $util->tablaQuejas();  
      $datos= $util->construirFallo(1);                                 
      return View::make('calidad.fallos.fallos', $datos);
    }   
   
    ///////////////////////////////////////////////////////////////       

}

