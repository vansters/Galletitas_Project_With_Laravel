<!doctype html>
<html lang="en">
    <!-- Header de la Aplicacion  =================================================================================== -->
    @include('util.head')
    <body>
        <!-- Barra Superior ===================================================================================-->
        @include('util.topbar')


        <!-- Contenedor Central ===================================================================================-->
        <section class=" row-fluid">

            <!-- Menu de la Vista  =================================================================================== -->
            @include('util.menu')


            <!-- Contenido -->
            <div class="row-fluid contenedor_tabs span10 offset1">
            </div>

        </section>

        <!-- Ventanas Emergentes  =================================================================================== -->
        @include('util.mod_recpass')

        <!-- Footer de la Aplicacion  =================================================================================== -->
        @include('util.footer')
    </body>
</html>
