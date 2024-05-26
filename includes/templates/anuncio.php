<?php
    // Realizar la conexion

    /* 
    Este archivo es llamado por "/index.php".
    Por ello, la ruta del include sera relativa a este.
    */
    include("includes/config/databases.php");
    $db = conectarDB();

    // Realizar la consulta
    $query = "SELECT * FROM propiedades LIMIT $limite";
    $resultado = mysqli_query($db, $query);


?>

<?php while($propiedad = mysqli_fetch_assoc($resultado)){ ?>
    <div class="anuncio">

        <img src="/imagenes/<?php print($propiedad["imagen"]); ?>"
        alt="anuncio"
        loading="lazy">
        

        <div class="contenido-anuncio">
            <h3><?php print($propiedad["titulo"]); ?></h3>
            <p>
                <?php print($propiedad["descripcion"]); ?>
            </p>
            <p class="precio">
                <?php print($propiedad["precio"]); ?>
            </p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg"
                    alt="icono wc" loading="lazy">

                    <p>
                        <?php print($propiedad["wc"]); ?>
                    </p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg"
                    alt="icono estacionamiento" loading="lazy">

                    <p>
                        <?php print($propiedad["estacionamiento"]); ?>
                    </p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg"
                    alt="icono dormitorio" loading="lazy">

                    <p>
                        <?php print($propiedad["habitaciones"]); ?>
                    </p>
                </li>
            </ul>

            <a href="anuncio.php?id=<?php print($propiedad["id"]); ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div> <!-- Contenido -->
    </div> <!-- Anuncio -->
<?php } ?>
    

<?php
    // Cerrar la conexion
    mysqli_close($db);
?>