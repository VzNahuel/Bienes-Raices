<?php
    require "includes/app.php";

    incluirTemplate("header", $inicio = true);
?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build//img/icono1.svg" alt="Icono seguridad" loading="lazy">

                <h3>Seguridad</h3>
                <p>
                    Praesentium impedit incidunt, tempore tenetur architecto quia.
                    Corrupti neque nostrum suscipit consectetur nulla, laudantium hic
                    obcaecati ut deleniti aliquam earum aliquid ipsum!
                </p>
            </div> <!-- Icono -->

            <div class="icono">
                <img src="build//img/icono2.svg" alt="Icono precio" loading="lazy">

                <h3>Precio</h3>
                <p>
                    Praesentium impedit incidunt, tempore tenetur architecto quia.
                    Corrupti neque nostrum suscipit consectetur nulla, laudantium hic
                    obcaecati ut deleniti aliquam earum aliquid ipsum!
                </p>
            </div> <!-- Icono -->

            <div class="icono">
                <img src="build//img/icono3.svg" alt="Icono tiempo" loading="lazy">

                <h3>A tiempo</h3>
                <p>
                    Praesentium impedit incidunt, tempore tenetur architecto quia.
                    Corrupti neque nostrum suscipit consectetur nulla, laudantium hic
                    obcaecati ut deleniti aliquam earum aliquid ipsum!
                </p>
            </div> <!-- Icono -->
        </div>

        <section class="contenedor seccion">
            <h2>Casas y Departamentos en Venta</h2>

            <div class="contenedor-anuncios">
                <?php
                    $limite = 3;

                    include("includes/templates/anuncio.php");
                ?>
            </div><!-- Contenedor anuncios-->

            <div class="alinear-derecha">
                <a class="boton-verde" href="anuncios.html">Ver Todas</a>
            </div>
        </section>
        
        <section class="imagen-contacto">
            <h2>Encuentra la casa de tus sueños</h2>

            <p>
                LLena el formulario de contacto y un asesor de nuestro equipo se pondra
                en contacto a la brevedad
            </p>

            <a href="contacto.php" class="boton-amarillo">Contactanos</a>
        </section>

        <div class="contenedor seccion seccion-inferior">
            <section class="blog">
                <h3>Nuestro Blog</h3>

                <article class="entrada-blog">
                    <div class="imagen-blog">
                        <picture>
                            <source srcset="build/img/blog1.webp" type="image/webp">
                            <source srcset="build/img/blog1.jpg" type="image/jpeg">

                            <img src="build/img/blog1.jpg" alt="texto entrada blog" loading="lazy">
                        </picture>
                    </div>

                    <div class="texto-entrada">
                        <a href="entrada.php">
                            <h4>Terraza en el techo de tu casa</h4>
                            <p class="informacion-meta">
                                Escrito el: <span>20/10/2022</span> por:
                                <span>Admin</span>
                            </p>

                            <p>
                                Consejos para construir una terraza en el techo de tu
                                casa con los mejores materiales y ahorrando dinero
                            </p>
                        </a>
                    </div>
                </article> <!-- Entrada -->

                <article class="entrada-blog">
                    <div class="imagen-blog">
                        <picture>
                            <source srcset="build/img/blog2.webp" type="image/webp">
                            <source srcset="build/img/blog2.jpg" type="image/jpeg">

                            <img src="build/img/blog2.jpg" alt="texto entrada blog" loading="lazy">
                        </picture>
                    </div>

                    <div class="texto-entrada">
                        <a href="entrada.php">
                            <h4>Guía para la decoracion de tu hogar</h4>
                            <p class="informacion-meta">
                                Escrito el: <span>20/10/2022</span> por:
                                <span>Admin</span>
                            </p>

                            <p>
                                Maximiza el espacio en tu hogar con esta guía. Aprende
                                a combinar muebles y colores para darle vida a tu hogar
                            </p>
                        </a>
                    </div>
                </article> <!-- Entrada -->

            </section>

            <section class="testimoniales">
                <h3>Testimoniales</h3>

                <div class="testimonial">
                    <blockquote>
                        El personal se comporto de una excelente forma, muy buena
                        atención. La casa que me ofrecieron cumple todas mis expectativas
                    </blockquote>

                    <p>- Nahuel Valdez</p>
                </div>
            </section>
        </div>

    </main>

<?php
    incluirTemplate("footer");
?>