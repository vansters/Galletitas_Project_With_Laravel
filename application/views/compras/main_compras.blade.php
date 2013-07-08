<!doctype html>
<html lang="en">
    <!-- Cabecera de la Pagina -->
    @include('util.head')
    <body>
        <!-- Barra Superior -->
        @include('util.topbar')


        <!-- Contenedor Primario -->
        <section class=" row-fluid">

            <!--  Barra de Menú para el Modulo -->
            @include('util.menu')


            <!-- Contenedor Secundario -->
            <div class="row-fluid contenedor_tabs span10 offset1">
            </div>

        </section>

        <!-- Ventanas Emergentes -->
        @include('util.mod_recpass')

        <!-- Pie de la pagina -->
        @include('util.footer')
        
    </body>
</html>