<?php

    require "../../includes/app.php";

    use App\Propiedad;

    // Usar la version 2.7 de Intervention. Las modernas no compilan
    use Intervention\Image\ImageManagerStatic as ImageMan;

    estaAutenticado();

    // Validar el ID como INT; Enviamos a "admin" si no es INT
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /admin");
    }

    // Base de Datos
    $db = conectarDB();

    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // Consulta a la BD

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo de errores
    $errores = Propiedad::getErrores();

    // Codigo ejecutado al presionar "Enviar"
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        // Asginamos los datos en un arreglo
        $args = [];

        $args["titulo"] = $_POST["titulo"] ?? null ;
        $args["precio"] = $_POST["precio"] ?? null ;
        $args["descripcion"] = $_POST["descripcion"] ?? null ;
        $args["habitaciones"] = $_POST["habitaciones"] ?? null ;
        $args["wc"] = $_POST["wc"] ?? null ;
        $args["estacionamiento"] = $_POST["estacionamiento"] ?? null ;
        $args["vendedores_id"] = $_POST["vendedores_id"] ?? null ;

        // Comparamos el POST con el Objeto
        $propiedad->sincronizarObjeto($args);

        // Validacion
        // NOTA: No deberia validar despues de agregar la imagen???
        $errores = $propiedad->validar();


        /* Subida de archivos */

        // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        if($_FILES["imagen"]["tmp_name"]){ // Si la imagen se agrego al formulario...
            // Usamos fit en la imagen
            $imagen = ImageMan::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
            
            // Definimos el nombre en el objeto "Propiedad"
            $propiedad->setImagen($nombreImagen);
        }

        if(empty($errores)){
            $imagen->save(DIRECTORIO_IMAGENES . $nombreImagen);

            
            $resultado = $propiedad->guardar();
           
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
            name="titulo" value="<?php print( sanitizar( $propiedad->getTitulo() ) );?>">

            <label for="precio">Precio: </label>
            <input type="number" id="precio" placeholder="Precio"
            name="precio" value="<?php print( sanitizar( $propiedad->getPrecio() ) );?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <?php if($propiedad->getImagen()) { ?>
                <img src="/imagenes/<?php print( sanitizar( $propiedad->getImagen() ) ); ?>" alt="imagen propiedad" class="imagen-small">
            <?php }?>

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"><?php print( sanitizar( $propiedad->getDescripcion() ) );?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9"
            name="habitaciones" value="<?php print( sanitizar( $propiedad->getHabitaciones() ) );?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9"
            value="<?php print( sanitizar( $propiedad->getWc() ) );?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9"
            name="estacionamiento" value="<?php print( sanitizar( $propiedad->getEstacionamiento() ) );?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
    incluirTemplate("footer");
?>