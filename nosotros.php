<?php
    require "includes/funciones.php";

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <section class="nosotros seccion">
            <div class="nosotros-imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">

                    <img src="build/img/nosotros.jpg" alt="imagen sobre nosotros" loading="lazy">
                </picture>
            </div>

            <div class="nosotros-texto">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Tenetur quos quidem dolor deserunt necessitatibus modi voluptates
                    a quaerat veritatis ea! Earum rerum, tempore expedita nihil tenetur
                    rem dolores aperiam libero.

                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente,
                    dolor iusto. Assumenda sapiente minus eveniet provident necessitatibus
                    minima, consequatur vero aliquam ratione aliquid mollitia temporibus
                    voluptates? Ducimus voluptas dolores eum.
                </p>
            </div>
        </section>

        <section>
            <h1>Más sobre nosotros</h1>

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
        </section>

    </main>

<?php
    incluirTemplate("footer");
?>