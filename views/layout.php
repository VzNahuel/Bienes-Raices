<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../build/css/app.css">


</head>
<body>
    
    <header class="header <?php print $inicio? "inicio" : ""; ?> ">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="boton-dark-mode" src="/build/img/dark-mode.svg"
                    alt="Icono dark mode">

                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>

                        <?php if($auth){ ?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php } ?>
                    </nav>
                </div>

                
            </div> <!-- .barra-->

            <?php
            if ($inicio){
                ?>
                    <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
                <?php
            }
            ?>

            
            
        </div>
    </header>

    <?php print($contenido) ?>

    <footer class="footer seccion">
        <div class="contenedor contenido-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>

                <?php if($auth){ ?>
                    <a href="/logout">Cerrar Sesion</a>
                <?php } ?>
            </nav>
        </div>

        <?php
            $fecha = date("Y");
        ?>

        <p class="copyright">
            Todos los derechos reservados <?php print $fecha ?> &copy;
        </p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>
</html>