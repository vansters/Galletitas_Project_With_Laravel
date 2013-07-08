<?php

class UtilidadesCalidad {
	public $titulo = 'Panel de Calidad';
	public $numPaginas1;
	public $numPaginas2;	    
	public $numPaginas;	
    public $numPaginas3; 
   public $materias;
   public $fallos;
   public $quejas;
   public $lotes;
    public $items_menu = array('Inicio','Evaluar', 'Quejas','Fallos');
    public $tit_link = 'Calidad';
    public $offset = '3';
    public $span = '2';
      
    
   
    public function construirMainCalidad() {
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

    //  --  Obtener Arreglo de Interfaz (Quejas)
    public function contruirQuejas() {
        $datos = array(
            'titulo'            => $this->titulo,

            'alertas'           =>  false,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'act'               => 'Quejas',

            'offset'            => $this->offset,

            'span'              => $this->span
        );
        return $datos;
    }




    
    public function tablaMateria(){
        
        $this->numPaginas1 = ceil(Materia::where('estado','=','Comprado')->count()/5);
        $this->materias = Materia::where('estado','=','Comprado')->order_by('fecha_caducidad','asc')->take(5)->get();    
    } 

 public function tablaTerminado(){
        
        $this->numPaginas2 = ceil(Lote::where('estado','=','Pendiente')->count()/5);
        $this->lotes = Lote::where('estado','=','Pendiente')->order_by('fecha_caducidad','asc')->take(5)->get();    
    } 

public function tablaFallos(){
        
        $this->numPaginas = ceil(Fallo::count()/5);
        $this->fallos = Fallo::order_by('created_at','asc')->take(5)->get();    
    } 

public function tablaQuejas(){
        
        $this->numPaginas3 = ceil(Queja::count()/5);
        $this->quejas = Queja::order_by('created_at','asc')->take(5)->get();    
    } 
        
	public function construirFallo($pagina){
		$datos = array(
            'titulo'            => $this->titulo,           

            'alertas'           =>  false,

            'titulos'           => array('Id','Fecha', 'Departamento', 'Descripcion','Compra Id','Lote Id'),    

            'titulos1'           => array('Id Queja','Fecha', 'Modulo', 'Comentario','Lote Id'),                    

            'fallos'          => $this->fallos,         
            'quejas'          => $this->quejas,                        

            'num_paginas'       => $this->numPaginas,                        
            'num_paginas3'       => $this->numPaginas3,  

            'pagina'            => $pagina,

            'act'               => 'Fallos',

            'offset'            => $this->offset,

            'span'              => $this->span, 

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,
            
        );
        return $datos;
	}// -- Fin        
        
        

        
/////////////////***********************************************************************

        
	//	--	Obtener arreglo para construir la interfaz (Evaluar)
	public function construirEvaluar($pagina){
		$datos = array(
            'titulo'            => $this->titulo,           

            'alertas'           =>  false,

            'titulos'           => array('Id','Compra Id', 'Fecha Caducidad','Nombre', 'Cantidad','Estado','Opciones'),
            
             'titulos1'           => array('Id','Estado','Fecha producción', 'Fecha caducidad', 'Linea producción','Precio','Galleta Id','Opciones'),

            'materias'          => $this->materias,
            
            'lotes'             => $this->lotes,

            'num_paginas1'       => $this->numPaginas1,
            
            'num_paginas2'       => $this->numPaginas2,

            'pagina'            => $pagina,

            'act'               => 'Evaluar',

            'offset'            => $this->offset,

            'span'              => $this->span, 

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu,

            'materiasp'          => Catalogo::get()
            
        );
        return $datos;
	}// -- Fin
	
/////////////////////////////////////////////////////////////////////////////////////////////////////
	
public function datosRegistrarQueja(){
        $insertar = array (       

            'comentario'     =>  Input::get('comentarios'),
            'modulo'     =>  Input::get('modulo'),
            'lote_id_id'        =>  Input::get('iden_lote'),                     
        );
        return $insertar;
    }

public function datosRegistrarFallo(){
        $insertar = array (                                  
            'departamento'        =>  Input::get('depto'),
            'descripcion'     =>  Input::get('mensaje'),
            'materia_prima_id'         =>  Input::get('id'),            
                                             
        );
        return $insertar;
    }

public function datosRegistrarNotificacion(){
            $insertar = array (                                  
            'depto_origen'        =>  "Calidad",
            'depto_destino'     =>  Input::get('depto'),                
            'mensaje'     =>  Input::get('mensaje'),                
            'users_id'         => Auth::user()->id                    
                                             
        );
        return $insertar;
    }

public function datosRegistrarNotificacion_Lote(){
            $insertar = array (                                  
            'depto_origen'        =>  "Calidad",
            'depto_destino'     =>  Input::get('departo'),                
            'mensaje'     =>  Input::get('descripcion'),                
            'users_id'         => Auth::user()->id                    
                                             
        );
        return $insertar;
    }        

public function datosRegistrarNotificacion_Queja(){
            $insertar = array (                                  
            'depto_origen'        =>  "Calidad",
            'depto_destino'     =>  Input::get('modulo'),                
            'mensaje'     =>  Input::get('comentarios'),                
            'users_id'         => Auth::user()->id                    
                                             
        );
        return $insertar;
    }

public function datosRegistrarFallo_Lote(){
        $insertar1 = array (                                  
            'departamento'        =>  Input::get('departo'),
            'descripcion'     =>  Input::get('descripcion'),                
            'lote_id'         =>  Input::get('id'),                        
                                             
        );
        return $insertar1;
    }
    
    //  --  Modal registrar Queja
    public function modalRegistrar($id,$lote_id_id){
        $datos = array('status'   => 'ok',
                        'funcion' => 'Queja registrada',
                        'mensaje' => 'La Queja: '.$id.' referente al  lote: '.$lote_id_id.
                                         ' se agrego <strong> exitosamente </strong>.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;

    }// --  Fin modalRegistrar

    
    public function modalRegistrar_fallo($lote_id){
        $datos = array('status'   => 'ok',
                        'funcion' => 'Lote Evaluado',
                        'mensaje' => 'Lote Evaluado con Id: '.$lote_id.' sera desechado.',
                        'opciones'=>  '<button class="btn refresh" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;

    }// --  Fin modalRegistrar*/

///////////////////////////////////////////////////////////////////////////////
    
//  --  Modal Evaluar Materia Prima
    public function modalevaluarMateria($id){
        $datos = array('funcion' =>  'Materia Prima Evaluada',
                        'mensaje' => 'La Materia Prima con Id:'.$id.' sera desechada.',
                        'opciones' => '<button class="btn refresh" data-dismiss="modal">Cerrar</button>'                        
                    );
        return $datos;
    }// --  Fin 

//  --  Modal Evaluar Materia Prima
    public function modalaprobarMateria($id){
        $datos = array('funcion' =>  'Materia Prima Evaluada',
                        'mensaje' => 'La Materia Prima con Id:'.$id.' fue aprobada.',
                        'opciones'=>  '<button class="btn refresh" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 
    
    //  --  Modal Aprobar Lote
    public function modalaprobarLote($id_lote){
        $datos = array('funcion' =>  'Lote Evaluado',
                        'mensaje' => 'EL Lote con ID: '.$id_lote.' fue aprobado.',
                        'opciones'=>  '<button class=" refresh" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 
    
    //  --  Modal Evaluar Materia Prima
    public function modalevaluarMateriaError(){
        $datos = array('funcion' =>  'Error en la Evaluación',
                        'mensaje' => 'La Materia Prima solicitada no fue encontrada en el sistema.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 
    
    //  --  Modal Evaluar Lote Terminado    
    public function modalevaluarLote($id_lote){
        $datos = array('funcion' =>  'Lote Evaluado',
                        'mensaje' => 'Lote Evaluado con Id: '.$id_lote.' sera desechado.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 


    //  --  Modal Evaluar Lote Terminado    
    public function modalevaluarLoteError(){
        $datos = array('funcion' =>  'Error en la Evaluación',
                        'mensaje' => 'Lote solicitado no fue encontrado en el sistema.',
                        'opciones'=>  '<button class="btn" data-dismiss="modal">Cerrar</button>'
                    );
        return $datos;
    }// --  Fin 


    //  --  Nueva pagina  de Materias
    public function nuevaPaginaMateria($num){
      //  --  Contamos los materias y traemos la pagina
        $this->numPaginas1 = ceil(Materia::where('estado','=','Comprado')->count()/5);
        $this->materias = Materia::where('estado','=','Comprado')->order_by('fecha_caducidad','asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla 
    public function paginarMateria($pagina){
        $datos = array(
              'titulos'           => array('Id','Compra Id', 'Fecha Caducidad', 'Nombre','Cantidad','Estado','Opciones'),

            'materias'          => $this->materias,

            'num_paginas1'       => $this->numPaginas1,

            'pagina'            => $pagina,

            'materiasp'          => Catalogo::get()
        ); 
        return $datos;
    }
    
     //  --  Nueva pagina  de Lotes
    public function nuevaPaginarLote($num){
      //  --  Contamos los materias y traemos la pagina
        $this->numPaginas2 = ceil(Lote::where('estado','=','Pendiente')->count()/5);
        $this->lotes = Lote::where('estado','=','Pendiente')->order_by('fecha_caducidad','asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla 
    public function paginarLote($pagina){
        $datos = array(
            
            'titulos1'           => array('Id','Estado','Fecha produccion', 'Fecha caducidad', 'Linea produccion','Precio','Galleta Id','Opciones'),

            'lotes'          => $this->lotes,

            'num_paginas2'       => $this->numPaginas2,

            'pagina'            => $pagina
        ); 
        return $datos;
    }

     //  --  Nueva pagina  de Fallos
    public function nuevaPaginarFallo($num){
      //  --  Contamos los materias y traemos la pagina
        $this->numPaginas = ceil(Fallo::count()/5);
        $this->fallos = Fallo::order_by('created_at','asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla Fallos 
    public function paginarFallo($pagina){
        $datos = array(
            
             'titulos'           => array('Id','Fecha', 'Departamento', 'Descripcion','Compra Id','Lote Id'),                    

            'fallos'          => $this->fallos,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina
        ); 
        return $datos;
    }

     //  --  Nueva pagina  de Quejas
    public function nuevaPaginarQueja($num){
      //  --  Contamos los materias y traemos la pagina
        $this->numPaginas3 = ceil(Queja::count()/5);
        $this->quejas = Queja::order_by('created_at','asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

    //  --  Constuir la tabla Quejas 
    public function paginarQueja($pagina){
        $datos = array(
            
            'titulos1'           => array('Id Queja','Fecha', 'Modulo', 'Comentario','Lote Id'),                                 

            'quejas'          => $this->quejas,

            'num_paginas3'       => $this->numPaginas3,

            'pagina'            => $pagina
        ); 
        return $datos;
    }
    
     
/////////////////////////////////////////////////////////////////////////////////////////    
    //  =====================================   Buscar un Cliente
    //  --  Buscamos un Cliente
    public function autocompletadoLote($busqueda){
        $b = $busqueda;
        //  --  Consulta a la BD
        $lotes = Lote::group_by('estado')   
                                ->where('estado','!=','Pendiente')                            
                                ->where(function($query) use($busqueda){                                    
                                    $query->or_where('id_lote','like',$busqueda);                                
                                })
                                ->get(array('id_lote'));
        //  --  Creamos un arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array(''));
        foreach ($lotes as $value) {
            array_push($datos['datos'], $value->id_lote);                    
        }
        return $datos;
    }    

//////////////////////////////////////////////////////////////////////////////////////////////        

}

?>    