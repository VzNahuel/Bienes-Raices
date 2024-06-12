<?php

    require "../../includes/app.php";

    use App\Propiedad;

    /** IMPORTANTE **/
    // Usar la version 2.7 de Intervention. Las modernas no compilan
    use Intervention\Image\ImageManagerStatic as ImageMan;


    // Comprobar autenticacion para Admin
    estaAutenticado();

    // Base de Datos
    $db = conectarDB();

    // Consulta a la BD

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo de errores
    $errores = Propiedad::getErrores();

    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedores_id = "";

    // Codigo ejecutado al presionar "Enviar"
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        // Nueva instancia de la propiedad
        $propiedad = new Propiedad($_POST);

        // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        // Resize a la imagen
        if($_FILES["imagen"]["tmp_name"]){ // Si la imagen se agrego al formulario...
            // Usamos fit en la imagen
            $imagen = ImageMan::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
            
            // Definimos el nombre en el objeto "Propiedad"
            $propiedad->setImagen($nombreImagen);
        }

        // Validar
        $errores = $propiedad->validar();

        if(empty($errores)){
            /*
                Crea la carpeta de imagenes.
                La ruta es la constante definida en "includes/funciones.php"
            */
            if(!is_dir(DIRECTORIO_IMAGENES)){ // Comprueba si la carpeta existe
                mkdir(DIRECTORIO_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $imagen->save(DIRECTORIO_IMAGENES.$nombreImagen);

            // Guarda en DB
            $resultado = $propiedad->guardarDB();

            if($resultado){
                // Redireccionar. NO debe haber HTML imprimido antes de redireccionar
                header("Location: /admin?registrado=1");
            }
        }

    }

    incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Crear</h1>


    <?php foreach($errores as $error){?>
        <div class="alerta error">
            <?php print($error); ?>
        </div>
    <?php }?>    
    

    <a href="/admin" class="boton boton-verde">Volver</a>

    <!-- action dice que archivo procesa el formulario -->
    <form action="" class="formulario" method="POST"
    action="/admin/propiedades/crear.php"
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

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"><?php print($descripcion) ?></textarea>
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

                        value="<?php print($vendedor["id"]); ?>">
                        <?php print($vendedor["nombre"] . " " . $vendedor["apellido"]); ?>
                    </option>


                <?php } ?>
                
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
    incluirTemplate("footer");
?>