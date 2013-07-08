<div id="tab1">
    
    <!-- Componente de Gestión para (Usuarios) -->
    <div class="row-fluid span11">

        <!-- Tabla de Gestion de recetas -->
		@include('produccion.recetas.tabla_recetas')

    	<!-- Tabla paginador de recetas -->
    	@include('util.paginador')
    </div>

</div>
	
@include('produccion.recetas.mod_recetas')