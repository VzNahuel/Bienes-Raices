<?php

    // Comprobamos que se permita el acceso
    require "../includes/app.php";
    estaAutenticado();


    use App\Propiedad;


    // Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();


    // Importar anuncio registrado
    $registrado = $_GET["registrado"] ?? null; // Si no existe, el default es null
    $eliminado = $_GET["eliminado"] ?? null;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            // Eliminar la imagen
            $query = "SELECT imagen FROM propiedades WHERE id = $id";

            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink("../imagenes/" . $propiedad["imagen"]);

            // Eliminar de la DB
            $query = "DELETE FROM propiedades WHERE id = $id";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header("Location: /admin?eliminado=1");
            }
        }
    }


    // Incluye el header
    incluirTemplate("header");
?>

<main class="contenedor seccion">

    <h1>Administrador de Bienes Raices</h1>

    <?php
        if($registrado == 1){
            ?>
                <p class="alerta exito">Anuncio Creado Correctamente</p>
            <?php
        }elseif($registrado == 2){
            ?>
                <p class="alerta exito">Anuncio Actualizado Correctamente</p>
            <?php
        }

        if($eliminado == 1){
            ?>
                <p class="alerta exito">Anuncio Eliminado Correctamente</p>
            <?php
        }
    ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <!-- tr: table row -->
        <!-- th: table header -->
        <!-- td: table data-->

        <thead>
            <tr> <!-- Table row -->
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->

            <?php foreach( $propiedades as $propiedad ){ ?>
                <tr>
                    <td> <?php print( $propiedad->getId() ); ?> </td>
                    <td> <?php print( $propiedad->getTitulo() ); ?> </td>
                    <td>
                        <img src="/imagenes/<?php print( $propiedad->getImagen() ); ?>"
                        alt="imagen playa"
                        class="imagen-tabla">
                    </td>
                    <td>$ <?php print( $propiedad->getPrecio() ); ?> </td>
                    <td>
                        <a href="/admin/propiedades/actualizar.php?id=<?php print( $propiedad->getId() );?>"
                        class="boton-amarillo-block"
                        >
                            Actualizar
                        </a>

                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php print($propiedad->getId() ); ?>">

                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

</main>

<?php
    // Cerrar la conexion

    mysqli_close($db);

    incluirTemplate("footer");
?>