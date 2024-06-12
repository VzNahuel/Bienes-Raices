<?php

    require "../../includes/app.php";

    $auth = estaAutenticado();

    if( !$auth ){
        header("Location: /");
    }

    // Validar el ID como INT; Enviamos a "admin" si no es INT
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /admin");
    }

    // Base de Datos
    $db = conectarDB();

    // Obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades where id = $id";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);


    // Consulta a la BD

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo de errores
    $errores = [];

    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $wc = $propiedad["wc"];
    $estacionamiento = $propiedad["estacionamiento"];
    $vendedores_id = $propiedad["vendedores_id"];

    $imagenPropiedad = $propiedad["imagen"];

    // Codigo ejecutado al presionar "Enviar"
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $titulo = mysqli_real_escape_string( $db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string( $db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string( $db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string( $db, $_POST["habitaciones"]);
        $wc = mysqli_real_escape_string( $db, $_POST["wc"]);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST["estacionamiento"]);
        $vendedores_id = mysqli_real_escape_string( $db, $_POST["vendedores_id"]);
        $creado = date("Y/m/d");

        // Asignar FILES a una variable
        $imagen = $_FILES["imagen"];

        // Validacion de formulario
        if(!$titulo){
            $errores[] = "El titulo es obligatorio";
        }
        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }
        if(!$descripcion){
            $errores[] = "La descripcion es obligatoria";
        }
        if(!$habitaciones){
            $errores[] = "La cantidad de habitaciones es obligatoria";
        }
        if(!$wc){
            $errores[] = "La cantidad de wc es obligatoria";
        }
        if(!$estacionamiento){
            $errores[] = "La cantidad de lugares de estacionamiento es obligatoria";
        }
        if(!$vendedores_id){
            $errores[] = "Debe seleccionar un vendedor";
        }

        // NO es obligatorio en el update
        /*
            if(!$imagen["name"]){
                $errores[] = "La imagen es obligatoria";
            }
        */

        // Validar por tamaño max: 1000kb = 1Mb
        $limite = 1000 * 1000;
        if($imagen["size"] > $limite){
            $errores[] = "La imagen es muy grande";
        }


        if(empty($errores)){
            // Crear carpeta de imagenes
            $carpetaImagenes = "../../imagenes";

            if(!is_dir($carpetaImagenes)){ // Comprueba si la carpeta existe
                mkdir($carpetaImagenes);
            }


            $nombreImagen = "";

            // Comprobar si ya habia una imagen
            if($imagen["name"]){    // Si es cierto, se elimina la imagen previa
                unlink($carpetaImagenes . "/" . $propiedad["imagen"]);

                // Generar un nombre unico
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";


                // Mover imagen de TMP al Servidor
                move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . "/" . $nombreImagen);
            }else{
                $nombreImagen = $propiedad["imagen"];
            }


            // Update propiedades
            $query = "UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedores_id = '$vendedores_id' WHERE id = $id";

            $resultado = mysqli_query($db, $query);

            if($resultado){

                // Redireccionar. NO debe haber HTML imprimido antes de redireccionar
                header("Location: /admin?registrado=2");
            }
        }

    }

    incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>


    <?php foreach($errores as $error){?>
        <div class="alerta error">
            <?php print($error); ?>
        </div>
    <?php }?>    
    

    <a href="/admin" class="boton boton-verde">Volver</a>

    <!-- action dice que archivo procesa el formulario -->
    <form action="" class="formulario" method="POST"
    enctype="multipart/form-data"
    >
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad"
            name="titulo" value="<?php print($titulo) ?>">

            <label for="precio">Precio: </label>
            <input type="number" id="precio" placeholder="Precio"
            name="precio" value="<?php print($precio) ?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php print($imagenPropiedad); ?>" alt="imagen propiedad" class="imagen-small">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"> <?php print($descripcion) ?> </textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9"
            name="habitaciones" value="<?php print($habitaciones) ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9"
            value="<?php print($wc) ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9"
            name="estacionamiento" value="<?php print($estacionamiento) ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id" id="vendedores_id">
                <option value="">-- Seleccione --</option>

                <?php while($vendedor = mysqli_fetch_assoc($resultado)){ ?>
                    
                    <option
                        <?php print( $vendedor["id"] == $vendedores_id ? "selected" : "" ); ?>

                        value=" <?php print($vendedor["id"]); ?> ">
                        <?php print($vendedor["nombre"] . " " . $vendedor["apellido"]); ?>
                    </option>


                <?php } ?>
                
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
    incluirTemplate("footer");
?>