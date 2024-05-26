<?php

    require "includes/funciones.php";

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Anuncios</h1>

        <section class="contenedor seccion">
            <h2>Casas y Departamentos en Venta</h2>

            <div class="contenedor-anuncios">
                <?php
                    $limite = 100;

                    include("includes/templates/anuncio.php");
                ?>
            </div><!-- Contenedor anuncios-->

        </section>
    </main>

<?php
    incluirTemplate("footer");
?>