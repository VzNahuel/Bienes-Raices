<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <?php foreach($errores as $error){?>
        <div class="alerta error">
            <?php print($error); ?>
        </div>
    <?php }?> 

    <a href="/admin" class="boton boton-verde">Volver</a>

    <form action="" class="formulario" method="POST"
    action="/admin/propiedades/crear.php"
    enctype="multipart/form-data"
    >
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad"
            name="titulo"
            value="<?php print( sanitizar( $propiedad->getTitulo() ) );?>">

            <label for="precio">Precio: </label>
            <input type="number" id="precio" placeholder="Precio"
            name="precio"
            value="<?php print( sanitizar( $propiedad->getPrecio() ) );?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <?php if($propiedad->getImagen()) { ?>
            <img src="/imagenes/<?php print($propiedad->getImagen());?>" class="imagen-small">
            <?php } ?>

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
            name="estacionamiento" value="<?php print( sanitizar($propiedad->getEstacionamiento()) );?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <label for="vendedor">Vendedor</label>
            <select name="vendedores_id" id="vendedor">
                <option value="" selected disabled>-- Seleccione --</option>
                <?php foreach( $vendedores as $vendedor ){ ?>
                    <option
                        <?php print( ($propiedad->getVendedores_id() === $vendedor->getId())? "selected" : "" );?>
                        value="<?php print(sanitizar($vendedor->getId()));?>">
                        <?php print( sanitizar($vendedor->getNombre()) . " " . sanitizar($vendedor->getApellido()));?>
                    </option>
                <?php } ?>
            </select>
        </fieldset>

        <input type="submit" value="Actaulizar Propiedad" class="boton boton-verde">
    </form>

</main>