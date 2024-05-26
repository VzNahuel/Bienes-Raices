<?php
    // Conectar la BD
    require "includes/config/databases.php";
    $db = conectarDB();

    // Validar usuario
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        // $email = mysqli_real_escape_string()
    }

    // Incluir Header
    require "includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password">
            </fieldset>

            <input type="submit" value="Iniciar sesion" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>