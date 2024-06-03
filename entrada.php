<?php
    require "includes/app.php";

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Guía para la decoracion de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">

            <img src="build/img/destacada2.jpg" alt="imagen destacada" loading="lazy">
        </picture>

        <p class="informacion-meta">
            Escrito el <span>20/10/2022</span> por <span>Admin</span>
        </p>

        <div class="resumen-propiedad">
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius
                eveniet ipsa odio dignissimos. Nemo laboriosam eum, mollitia beatae
                dolorum similique quaerat dolorem vel eveniet quasi atque deleniti ad
                qui adipisci.

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus,
                consequatur id. Sunt omnis perferendis ut laborum vero quam debitis
                sint assumenda, excepturi explicabo eaque. Nam esse dolorum provident
                autem sunt!
            </p>
        </div>
    </main>

<?php
    incluirTemplate("footer");
?>