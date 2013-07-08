<?php

class UtilidadesProduccion {

    //  --  Constantes Genéricas para todo el Modul
    public $titulo = 'Panel de Producción';
    public $numPaginas;
    public $lotes;
    public $tit_link = 'Produccion';
    public $items_menu = array('Inicio', 'Lotes', 'Recetas');
    public $offset = '3';
    public $span = '3';
    public $galletas;
    public $receta;

    //  --  Obtener arreglo para construir la interfaz (mainProduccion)
    public function contuirMainProduccion() {
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


    public function datosnuevoLote(){
        $insertar=array(
            'id_lote'       => Input::get('idLote').Input::get('linea').Input::get('galleta'),
            'estado'        => 'Pendiente',
            'fecha_produccion'  => Input::get('fProduc'),
            'fecha_caducidad'   => Input::get('fCad'),
            'linea_produccion'  => Input::get('linea'),
            'galleta_id'        => Input::get('galleta'),
            'cantidad'      => Input::get('cantidad'),
            'precio'        => ((int)Input::get('cantidad')*3.5)
        );
        return $insertar;
    }


//  =====================================   Construir Gestión Lotes

    //  --  Obtener arreglo para construir la interfaz (Lotes)
    public function constuirLotes($pagina){
        $datos = array(
            'titulo'            => $this->titulo,

            'text_btn'          => 'Nuevo Lote',

            'alertas'           =>  false,

            'titulos'           => array('ID de Lote','Producto (Galleta)','Fecha de Caducidad', 'Fecha de Producción', 'Estado','Linea','Opciones'),

            'lotes'             => $this->lotes,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,
            
            'galletas'      => $this->galletas,

            'act'               => 'Lotes',

            'offset'            => $this->offset,

            'span'              => $this->span,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu
        );
        return $datos;
    }// -- Fin

    //  --  Generar datos para tabla de lotes
    public function tablalotes(){
        //  --  Contamos los lotes y traemos los 5 primeros
        $this->numPaginas = ceil(Lote::count()/5);
        $this->lotes = Lote::order_by('id', 'asc')->take(5)->get();    
    }
    public function combogalletas(){
        $this->galletas = Galleta::all();
    }
    
    public function modalModificarLote($id_lotee){
    $datos = array(
            'function' => 'Lote Modificado',
            'mensaje' => 'El lote con ID: '.$id_lotee.' fue modificado',
            'opciones' => '<button class="btn refresh" data-dismiss="modal">Cerrar</button>'
    );
    return $datos;
}
public function modalModificarLoteError(){
    $datos = array(
            'function' => 'Error en la Modificación del Lote',
            'mensaje' => 'El lote no fue encontrado en el sistema',
            'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
    );
    return $datos;
}

public function modalEliminarLote($id_lotee){
    $datos = array(
            'function' => 'Lote Eliminado',
            'mensaje' => 'El lote con ID: '.$id_lotee.' fue eliminado',
            'opciones' => '<button class="btn refresh" data-dismiss="modal">Cerrar</button>'
    );
    return $datos;
}
public function modalEliminarLoteError(){
    $datos = array(
            'function' => 'Error en la Eliminación del Lote',
            'mensaje' => 'El lote no fue encontrado en el sistema',
            'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
    );
    return $datos;
}

public function modalAgregarLote($id_lotee){
    $datos = array(
            'function' => 'Lote Nuevo',
            'mensaje' => 'El lote con ID: '.$id_lotee.' se esta produciendo',
            'opciones' => '<button class="btn refresh" data-dismiss="modal">Cerrar</button>'
    );
    return $datos;
}
public function modalAgregarLoteError(){
    $datos = array(
            'function' => 'Error al crear Lote',
            'mensaje' =>  'Error al crear el nuevo lote, materia prima insuficiente',
            'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
    );
    return $datos;
}

public function modalAgregarLoteErrorCantidad(){
    $datos = array(
            'function' => 'Error al crear nuevo Lote',
            'mensaje' => 'La cantidad de materia prima no es suficiente',
            'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
    );
    return $datos;
}

public function nuevaPaginaLotes($num){
      //  --  Contamos los usuarios y traemos la pagina
        $this->numPaginas = ceil(Lote::count()/5);
        $this->lotes = Lote::order_by('id', 'asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin

//  --  Constuir la tabla 
    public function paginarLotes($pagina){
       $datos = array(
            'titulos'           => array('ID de Lote','Producto (Galleta)','Fecha de Caducidad', 'Fecha de Producción', 'Estado','Linea','Opciones'),

            'lotes'          => $this->lotes,

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,
        ); 
        return $datos;
    }// --  Fin
    
    public function autocompletadoLote($busqueda){
        //  --  Consulta a la BD
        $lotes = Lote::join('galleta', 'lote.galleta_id','=','galleta.id')->where('galleta.nombre','like', $busqueda)
                    ->or_where('id_lote','like',$busqueda)                  
                                ->or_where('estado','like',$busqueda)
                                ->get();
        //  --  Creamos un arreglo para pasarlo a JavaScrip via JSON
        $datos = array('datos' => array(''));
        foreach ($lotes as $value) {
            array_push($datos['datos'], $value->id_lote);
            array_push($datos['datos'], $value->estado);
            array_push($datos['datos'], $value->nombre);
        }
        return $datos;
    }
    
    public function tablaLotesFiltro($busqueda){
        $this->lotes = Lote::join('galleta', 'lote.galleta_id','=','galleta.id')->where('galleta.nombre','like', $busqueda)
                        ->or_where('id_lote','like',$busqueda)//where('correo','like',$busqueda)
                                    ->or_where('estado','like',$busqueda)                                    
                                    ->get();
        $this->numPaginas = 0;
    }
    public function comprobaMateria(){
        $cantidad = Input::get('cantidad');
        $galleta_id=Input::get('galleta');
        $numero_lot = ( $cantidad / 1000.00);
        $this->receta = Recetario::where('galleta_id', '=', $galleta_id)->get();
        foreach($this->receta as $rec){
            $matp = Materia::where('catalogo_mp_id','=', $rec->catalogo_mp_id)->max('cantidad');
            if(($rec->cantidad * $numero_lot) > $matp){
                return 1;
            }
        }   
        return 0;
    }
    
    public function regresaRecta(){
        $galleta_id=Input::get('galleta');
        $roc = Recetario::where('galleta_id', '=', $galleta_id)->get();
        return $roc;
    } 



//  ================================================================================================ 
//      Auxiliares Recetas
//  ================================================================================================

    public function datosnuevaReceta($id,$tipo,$cantidad){
        $insertar=array(
            'galleta_id'        => $id,
            'catalogo_mp_id'    => Input::get($tipo),
            'cantidad'          => Input::get($cantidad),
         
        );
        return $insertar;
    }


    //  --  Obtener arreglo para construir la interfaz (Lotes)
    public function construirRecetas($pagina){
        $datos = array(
            'titulo'            => $this->titulo,

            'text_btn'          => 'Nueva Receta',

            'alertas'           =>  false,

            'titulos'           => array('ID de Receta','Nombre de la Receta','Opciones'),

            'recetarios'        => $this->recetarios,

            'galletas'          => $this->galletas,

            'galletasN'         => Galleta::get(),

            'catalogos'         => Catalogo::get(),
            
            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,

            'act'               => 'Recetas',

            'offset'            => $this->offset,

            'span'              => $this->span,

            'tit_link'          => $this->tit_link,

            'items_menu'        => $this->items_menu
        );
        return $datos;
    }// -- Fin


    //  --  Generar datos para tabla de recetas
    public function tablarecetas(){
        //  --  Contamos las recetas y traemos los 5 primeros
        $this->numPaginas = ceil(Galleta::count()/5);
        $this->galletas = Galleta::order_by('id', 'asc')->take(5)->get();    
        $this->recetarios = Recetario::order_by('id', 'asc')->get();    
    }

    
    public function modalModificarReceta($galleta_id){
        $datos = array(
                'function' => 'Receta Modificada',
                'mensaje' =>  'La Receta con ID: '.$galleta_id.' fue modificada',
                'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
        );
        return $datos;
    }


    public function modalModificarRecetaError(){
        $datos = array(
                'function' => 'Error en la Modificación de la Receta',
                'mensaje' => 'La receta no fue encontrada en el sistema',
                'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
        );
        return $datos;
    }


    public function modalEliminarReceta($galleta_id){
        $datos = array(
                'function' => 'Receta Eliminada',
                'mensaje' => 'La receta con ID: '.$galleta_id.' fue eliminada',
                'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
        );
        return $datos;
    }


    public function modalEliminarRecetaError(){
        $datos = array(
                'function' => 'Error en la Eliminación de la receta',
                'mensaje' => 'La receta no fue encontrada en el sistema',
                'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
        );
        return $datos;
    }

    public function modalAgregarReceta($galleta_id){
        $datos = array(
                'function' => 'Receta Nueva',
                'mensaje' => 'La receta con ID: '.$galleta_id.' se agrego correctamente',
                'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
        );
        return $datos;
    }


    public function modalAgregarRecetaError(){
        $datos = array(
                'function' => 'Error al crear nueva receta',
                'mensaje' => 'Error en el sistema al crear nueva receta',
                'opciones' => '<button class="btn" data-dismiss="modal">Cerrar</button>'
        );
        return $datos;
    }


    public function nuevaPaginaRecetas($num){
        $this->numPaginas = ceil(Galleta::count()/5);
        $this->galletas = Galleta::order_by('id', 'asc')->skip(5*($num-1))->take(5)->get();  
    }// --  Fin


    //  --  Constuir la tabla 
    public function paginarRecetas($pagina){
       $datos = array(
            'titulos'           => array('ID de Galleta','Nombre','Opciones'),

            'galletas'          => $this->galletas,

            'galletasN'         => Galleta::get(),

            'recetarios'        => Recetario::order_by('id', 'asc')->get(),

            'catalogos'          => Catalogo::get(),

            'num_paginas'       => $this->numPaginas,

            'pagina'            => $pagina,
        ); 
        return $datos;
    }// --  Fin

}
