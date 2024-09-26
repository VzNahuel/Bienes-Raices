<main class="contenedor seccion">
    <h1>
        <?php print($propiedad->getTitulo()); ?>
    </h1>

    <img src="imagenes/<?php print($propiedad->getImagen()); ?>"
    alt="imagen destacada"
    loading="lazy">
    

    <div class="resumen-propiedad">
        <p class="precio">
            <?php print($propiedad->getPrecio()); ?>
        </p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc"
                loading="lazy">

                <p>
                    <?php print($propiedad->getWc()); ?>
                </p>
            </li>

            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg"
                alt="icono estacionamiento" loading="lazy">

                <p>
                    <?php print($propiedad->getEstacionamiento()); ?>
                </p>
            </li>

            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg"
                alt="icono dormitorio" loading="lazy">

                <p>
                    <?php print($propiedad->getHabitaciones()); ?>
                </p>
            </li>
        </ul>

        <p>
            <?php print($propiedad->getDescripcion()); ?>
        </p>
    </div>
</main>