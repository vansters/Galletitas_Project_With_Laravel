<div id="tab1">
    
    <!-- Componente de Gestión para (Usuarios) -->
    <div class="row-fluid span11">

        <!-- Tabla de Gestion de Usuarios -->
		@include('ventas.clientes.tabla_clientes')

    	<!-- Tabla de Gestion de Usuarios -->
    	@include('util.paginador')

    </div>

</div>

@include('ventas.clientes.mod_clientes')

