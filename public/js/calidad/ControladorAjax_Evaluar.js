$(document).ready(function() {
	
	//	--	Importando Objetos (Prototipos)
	var Util_F =  new Utilidades_Formularios();
	var Util_A =  new Utilidades_Ajax();
  var Util_V =  new Utilidades_Varias();

	//	--	Creamos la validacion de los Forms
	Util_F.formMateriaRechazada();
	Util_F.formLoteRechazada();


	//	--	Evaluar Materia Prima
	$('.tab-content').on('click', '.btn_evaluar', function(event){		  
      var datos 		= '#controles'+this.id;
      var formulario 	= '#form_evaluarMateria-'+this.id;
      var modal 		= '#eval_materia'+this.id;
      Util_A.evaluarMateriaPrima(formulario,datos,modal,'evaluarMateriar/');
  	});
  	
  	//	--	Aprobar Materia
	$('.tab-content').on('click', '.btn_Aceptar', function(event){		  
      var datos 		= '#controles'+this.id;
      var formulario 	= '#form_evaluarMateriaAprovada-'+this.id;
      var modal 		= '#eval_materia_a'+this.id;
      Util_A.aprovarMateriaPrima(formulario,datos,modal,'aprobarMateriar/');      
  	});
  	
  	//	--	Aprobar Lote
	$('.tab-content').on('click', '.btn_Aceptar_lote', function(event){		  
      var datos 		= '#controles'+this.id;
      var formulario 	= '#form_evaluarLoteAprovado-'+this.id;
      var modal 		= '#eval_lote_a'+this.id;
      Util_A.aprobarLote(formulario,datos,modal,'aprobarLote/');      
  	});
  	
  	//	--	Evaluar Lotes Terminados
	$('.tab-content').on('click', '.btn_evaluar_lote', function(event){		  
      var datos 		= '#controles'+this.id;
      var formulario 	= '#form_evaluarLote-'+this.id;
      var modal 		= '#eval_lote'+this.id;
      Util_A.evaluarLote(formulario,datos,modal,'evaluarLote/');
      Util_A.enviarRegistrarFallo(formulario,
                                    '#alerta_registrarUsuario',
                                    'registrarfallo');                                     
  	});

  	//  --  Paginando Materias (Usando Paginador)
  	$('.tab-content').on('click', '.pagination ul li a', function(){
      	if (!($(this).parent('li').hasClass('active'))){ 
      		Util_A.paginandoMateria(this.id,'paginarMaterias/');
      	}
  	});

//  --  Paginando Lotes Terminados (Usando Paginador)
  	$('.tab-content').on('click', '.pagination ul li a', function(){
      	if (!($(this).parent('li').hasClass('active'))){ 
      		Util_A.paginandoLote(this.id,'paginarLote/');
      	}
  	});

      //  --  Paginando Fallos (Usando Paginador)
    $('.tab-content').on('click', '.pagination ul li a', function(){
        if (!($(this).parent('li').hasClass('active'))){ 
          Util_A.paginandoFallo(this.id,'paginarFallo/');
        }
    });

     //  --  Paginando Quejas (Usando Paginador)
    $('.tab-content').on('click', '.pagination ul li a', function(){
        if (!($(this).parent('li').hasClass('active'))){ 
          Util_A.paginandoQueja(this.id,'paginarQueja/');
        }
    });

    //  --  Buscar una Materia Prima
    $('#buscadorLote').typeahead({
      minlength: 1,
      items: 10,
      source: function(query,process){
        //  --  Petición Ajax autocompletado 
            $.post('buscarLote', { query: query }, function(data) {
                process(data['datos']);
            });
      }
      /*updater: function (item){
        //  --  Generamos la Cookie
            Util_V.crearCookie("busqueda", item, 1);            
      }*/
    });
      $('body').on('click', '.refresh', function(e){
        setTimeout("location.href='http://localhost/Galletitas/public/calidad/evaluar';",500);
  });

	
});