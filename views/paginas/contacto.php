<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php
        if($mensaje){ ?>
            <p class="alerta exito"><?php print($mensaje); ?></p>;
    <?php } ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">

        <img src="build/img/destacada3.jpg" alt="imagen contacto" loading="lazy">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form action="/contacto" method="POST" class="formulario">
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre"
            name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <label for="opciones">Vendedor o Comprador</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>

                <option value="Comprador">Comprador</option>
                <option value="Vendedor">Vendedor</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" name="contacto[presupuesto]" required id="presupuesto"
            placeholder="Tu Precio o Presupuesto">



        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input
                        name="contacto[contacto]"
                        value="telefono"
                        id="contactar-telefono"
                        type="radio"
                        required
                        >

                    <label for="contactar-email">E-mail</label>
                    <input
                        name="contacto[contacto]"
                        value="email"
                        id="contactar-email"
                        type="radio"
                        required
                        >
                </div>

            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>

</main>