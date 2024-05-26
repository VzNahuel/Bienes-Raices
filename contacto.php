<?php
    require "includes/funciones.php";

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">

            <img src="build/img/destacada3.jpg" alt="imagen contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form action="" class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu E-mail" id="email">

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Tu telefono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vendedor o Comprador</label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>

                    <option value="Comprador">Comprador</option>
                    <option value="Vendedor">Vendedor</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="presupuesto" id="presupuesto"
                placeholder="Tu Precio o Presupuesto">



            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" type="radio"
                    value="telefono"id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio"
                    value="email" id="contactar-email">
                </div>

                <p>Si eligio telefono, elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha:</label>
                <input type="date">

                <label for="hora">Hora</label>
                <input type="time" min="09:00" max="20:00">

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>


    </main>

<?php
    incluirTemplate("footer");
?>