<div id="tab1">
    
    <!-- Componente de Gestión para (Usuarios) -->
    <div class="row-fluid span11">

        <!-- Tabla de Gestion de Usuarios -->
	@include('produccion.lotes.tabla_lotes')

    	<!-- Tabla de Gestion de Usuarios -->
    	@include('util.paginador')

    </div>

</div>
   @include('produccion.lotes.mod_lotes')
