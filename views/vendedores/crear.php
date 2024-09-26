<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>


    <?php foreach($errores as $error){?>
        <div class="alerta error">
            <?php print($error); ?>
        </div>
    <?php }?>    
    

    <a href="/admin" class="boton boton-verde">Volver</a>

    <!-- action dice que archivo procesa el formulario -->
    <form action="" class="formulario" method="POST"
    action="/vendedores/crear"
    >
        <fieldset>
            <legend>Informacion General</legend>

            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" placeholder="Nombre Vendedor"
            name="nombre"
            value="<?php print( sanitizar( $vendedor->getNombre() ) );?>">

            <label for="apellido">Apellido: </label>
            <input type="text" id="apellido" placeholder="Apellido Vendedor"
            name="apellido"
            value="<?php print( sanitizar( $vendedor->getApellido() ) );?>">
        </fieldset>

        <fieldset>
            <legend>Informacion Extra</legend>

            <label for="telefono">Telefono</label>
            <input type="number" name="telefono" id="telefono">
        </fieldset>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>
</main>