<?php
    use App\Propiedad;

    // Elegimos cuantas propiedades mostrar en cada pagina

    if ($_SERVER["SCRIPT_NAME"] === "/anuncio.php"){
        // Traer todo
        $propiedades = Propiedad::all();
    }else{
        // Traer 3
        $propiedades = Propiedad::getN(3);
    }

?>

<?php foreach($propiedades as $propiedad){ ?>
    <div class="anuncio">

        <img src="/imagenes/<?php print($propiedad->getImagen()); ?>"
        alt="anuncio"
        loading="lazy">
        

        <div class="contenido-anuncio">
            <h3><?php print($propiedad->getTitulo()); ?></h3>
            <p>
                <?php print($propiedad->getDescripcion()); ?>
            </p>
            <p class="precio">
                <?php print($propiedad->getPrecio()); ?>
            </p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg"
                    alt="icono wc" loading="lazy">

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

            <a href="anuncio.php?id=<?php print($propiedad->getId()); ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div> <!-- Contenido -->
    </div> <!-- Anuncio -->
<?php } ?>