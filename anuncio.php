<?php
    include "includes/config/databases.php";

    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /index.php");
    }

    $db = conectarDB();

    $query = "SELECT * FROM propiedades WHERE id = $id";
    $resultado = mysqli_query($db, $query);

    if($resultado->num_rows === 0){
        header("Location: /index.php");
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    require "includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>
            <?php print($propiedad["titulo"]); ?>
        </h1>

        <img src="imagenes/<?php print($propiedad["imagen"]); ?>"
        alt="imagen destacada"
        loading="lazy">
        

        <div class="resumen-propiedad">
            <p class="precio">
                <?php print($propiedad["precio"]); ?>
            </p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc"
                    loading="lazy">

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

            <p>
                <?php print($propiedad["descripcion"]); ?>
            </p>
        </div>
    </main>

<?php
    mysqli_close($db);

    incluirTemplate("footer");
?>