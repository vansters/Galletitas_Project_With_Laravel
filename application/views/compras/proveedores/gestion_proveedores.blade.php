<div id="tab1">
    
    <!-- Componente de Gestión para (Usuarios) -->
    <div class="row-fluid span11">

        <!-- Tabla de Gestion de Usuarios -->
		@include('compras.proveedores.tabla_proveedores')

    	<!-- Tabla de Gestion de Usuarios -->
    	@include('util.paginador')

    </div>

</div>

@include('compras.proveedores.mod_proveedores')

