<main class="contenedor seccion">

    <h1>Administrador de Bienes Raices</h1>

    <!-- Alertas -->
    <?php
        if($status){
            $mensaje = mostrarAlertas( intval($status) );

            if($mensaje){ ?>
                <p class="alerta exito"> <?php print( sanitizar( $mensaje ) ); ?> </p>
            <?php } 
        }
    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

    <h2>Propiedades</h2>
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
                        <a href="/propiedades/actualizar?id=<?php print( $propiedad->getId() );?>"
                        class="boton-amarillo-block"
                        >
                            Actualizar
                        </a>

                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php print($propiedad->getId() ); ?>">
                            <input type="hidden" name="tipo" value="propiedad">

                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
</main>