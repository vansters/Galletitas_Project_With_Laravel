<?php

class Produccion_Controller extends Base_Controller {

    //  --  Funcion Inicio Produccion
    public function action_inicio() {
        $util = new UtilidadesProduccion();
        $datos = $util->contuirMainProduccion();
        return View::make('produccion.main_Produccion', $datos);
    }

//  ================================================================================================ 
//      Acciones para Recetas
//  ================================================================================================

   public function action_contenidoDelLote($materia, $lotee)
    {
        $insertar2 = array(
            'materia_prima_id'  => $materia,
            'lote_id'       => $lotee
        );
        $cont_lote = new Contenido($insertar2);
        $cont_lote->save();
    }

    //  --  Funcion para Lotes
    public function action_lotes() {
        $util = new UtilidadesProduccion();
        $util->tablalotes();
        $util->combogalletas();
        $datos = $util->constuirLotes(1);
        return View::make('produccion.lotes.lotes', $datos);
    }

    public function action_agregarLote(){
        echo Input::get('linea');
    }


    public function action_modificarLotePro(){
        $lote = Lote::find(Input::get('id'));
        if(is_object($lote)){
            $lote->fecha_produccion = Input::get('fProduc');
            $lote->fecha_caducidad = Input::get('fCad');
            $lote->save();
            $util = new UtilidadesProduccion();
            $datos = $util->modalModificarLote($lote->id_lote);
            unset($util);
            return Response::json($datos,200);
        }else{
            $util = new UtilidadesProduccion();
            $datos = $util->modalModificarLoteError();
            unset($util);
            return Response::json($datos,201);
        }
    }
    
    public function action_eliminarLotePro(){
        $util = new UtilidadesProduccion();
        $lote = Lote::find(Input::get('id'));       
        if(is_object($lote)){
            $lote->delete();            
            $datos = $util->modalEliminarLote($lote->id_lote);
            unset($util);
            return Response::json($datos,200);
        }else{
            $util = new UtilidadesProduccion();
            $datos = $util->modalEliminarLoteError();
            unset($util);
            return Response::json($datos,201);
        }
    }


    public function action_nuevoLote(){
        $util = new UtilidadesProduccion();
        $lote = new Lote($util->datosnuevoLote());

        //  --  MP Minima 
        $recetas  =  Recetario::where('galleta_id','=',Input::get('galleta'))->get();
        $numLotes =  ((int)Input::get('cantidad') / 1000); 

        for ($i=0; $i < count($recetas); $i++) { 
            $cantMateria  = ($recetas[$i]->cantidad * $numLotes);
            //  --  La Minima Cantidad Satisface ... ?
            $minMP = Materia::where('catalogo_mp_id','=', $recetas[$i]->catalogo_mp_id)
                              ->where('estado','=','Aprobado')
                              ->min('cantidad');

            if ($minMP >= $cantMateria ){
                //  Disminuimos la Materia Prima
                $minMateria = Materia::where('catalogo_mp_id','=', $recetas[$i]->catalogo_mp_id)
                                    ->where('estado','=','Aprobado')
                                    ->where('cantidad','=',$minMP)
                                    ->first();
                $minMateria->cantidad = $minMateria->cantidad - $cantMateria;
            }else{

                $materiasDispo = Materia::where('catalogo_mp_id','=',$recetas[$i]->catalogo_mp_id)
                                          ->where('estado','=','Aprobado')
                                          ->order_by('cantidad', 'asc')
                                          ->get();
                $cantidadCompletar = $cantMateria;                          
                $idMateriaUsar = array();
                $CantMateriaUsar = array();
                
                //  --  Buscamos completar el pedido
                for ($j=0; $j <= count($materiasDispo); $j++) {
                    if($cantidadCompletar  >= 0 ){
                        $idMateriaUsar[$j] = $materiasDispo[$j]->id;
                    }else{
                        break;
                    }
                    $cantidadCompletar = $cantidadCompletar - (int)$materiasDispo[$j]->cantidad;
                    //echo "A Completar".$cantidadCompletar.'de '.$cantMateria.'<br>';
                    if ( $cantidadCompletar < (int)$materiasDispo[$j]->cantidad){
                        $CantMateriaUsar[$j] = (int)$materiasDispo[$j]->cantidad - $cantidadCompletar;
                    }else{
                        $CantMateriaUsar[$j] = (int)$materiasDispo[$j]->cantidad;
                    }
                } 

                if(count($idMateriaUsar) == 0){
                    //  --  No es Posible Surtir el Pedido
                    $datos=$util->modalAgregarLoteError();
                    unset($util);
                    return Response::json($datos,200);
                }else{
                    //  --  Es Posible Surtir el pedido
                    for ($j=0; $j < count($idMateriaUsar); $j++) {
                        //  --  Descontando la Materia Prima
                        if ($CantMateriaUsar[$j] <= $cantMateria){
                            $materiasDispo[$j]->cantidad = $materiasDispo[$j]->cantidad - $CantMateriaUsar[$j]; 
                        }else{
                           $materiasDispo[$j]->cantidad = $CantMateriaUsar[$j]; 
                        }
                        //  --  Guardamos las Materias
                        $materiasDispo[$j]->save();
                    } 
                }
            }
            // //  --  Creamos un Contenido de Lote
            // $insertar = array(
            //     'materia_prima_id'  => $recetas[$i]->catalogo_mp_id,
            //     'lote_id'           => $lote->id_lote
            // );

            // //  --  Creamos un Objeto y los Guardamos
            // //$conteLote =  new Contenido($insertar);
            // //$conteLote->save();
        }
        //  --  Guardamos el Lote
        $lote->save();
        $datos=$util->modalAgregarLote($lote->id_lote);
        unset($util);
        return Response::json($datos,200); 
    }
    
    public function action_paginarLote(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesProduccion();
        $util->nuevaPaginaLotes(Input::get('pagina'));
        $datos = $util->paginarLotes(Input::get('pagina'));
        //  --  Creamos una Cookie con la Ultima Pag Visitada
         unset($util);
        return View::make('produccion.lotes.gestion_lotes',$datos);
    }
    
    public function action_buscarLote(){
        $util = new UtilidadesProduccion();
        $datos = $util->autocompletadoLote('%'.Input::get('query').'%');
        return Response::json($datos,200);
    }
    
    public function action_paginarResultados(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesProduccion();

        $util->tablaLotesFiltro(Input::get('item'));
        $datos = $util->paginarLotes(0);

        unset($util);   //  --  Destruimos util        

        return View::make('produccion.lotes.gestion_lotes', $datos,200);
    }// --  Fin








//  ================================================================================================ 
//      Acciones para Recetas
//  ================================================================================================

    //  --  Funciones para Recetas
    public function action_recetas() {
        $util = new UtilidadesProduccion();
        $util ->tablarecetas();
        //$util->combogalletas2();
        $datos = $util->construirRecetas(1);
        return View::make('produccion.recetas.recetas',$datos);
    }

     public function action_eliminarReceta(){
        $util = new UtilidadesProduccion();
        $galleta = Galleta::where('id','=',Input::get('id'))->first();  
        if(is_object($galleta)){
            //$galleta->delete();            
            $datos = $util->modalEliminarReceta(Input::get('id'));
            unset($util);
            return Response::json($datos,200);
        }
        else{
            $datos = $util->modalEliminarRecetaError();
            unset($util);
            return Response::json($datos,201);
        }
    }

     public function action_modificarReceta(){
        $recetario = Recetario::where('galleta_id','=',Input::get('galleta'))->get();
        $todo = Recetario::where('galleta_id','=',Input::get('galleta'))->count();
        $util = new UtilidadesProduccion();
        if($todo != 0)
        {
            for ($i=0; $i < $todo; $i++) 
            {
                $recetario[$i]->cantidad = Input::get('cantidad'.$recetario[$i]->id);
                $recetario[$i]->save();
            }
            $datos = $util->modalModificarReceta(Input::get('galleta'));
            unset($util);
            return Response::json($datos,200);
        }
        else
        {
            $datos = $util->modalModificarRecetaError();
            unset($util);
            return Response::json($datos,200);
        }
    }


    public function action_nuevaReceta(){
        $util = new UtilidadesProduccion();

        $galleta= new Galleta();
        $galleta->nombre = Input::get('nombre');
        $galleta->save();

        $tipo = '';
        $canti = '';
        for ($i=1; $i <= 10 ; $i++) {
            $tipo =  'tipo'.$i; 
            $canti =  'c'.$i; 
            if( Input::get($tipo) != '' ||  Input::get($canti) != ''){
                $recetario = new Recetario($util->datosnuevaReceta($galleta->id,$tipo,$canti));
                $recetario->save();
            } 
        }
        $datos=$util->modalAgregarReceta($recetario->galleta_id);
        unset($util);
        return Response::json($datos,200);
    }


    
    public function action_paginarReceta(){
        //  --  Clase con métodos auxiliares
        $util = new UtilidadesProduccion();
        $util->nuevaPaginaRecetas(Input::get('pagina'));
        $datos = $util->paginarRecetas(Input::get('pagina'));
        //  --  Creamos una Cookie con la Ultima Pag Visitada
         unset($util);
        return View::make('produccion.recetas.gestion_recetas',$datos);
    }


}

