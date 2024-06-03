<?php
    // Conectar la BD
    require "includes/app.php";
    $db = conectarDB();

    $errores = [];

    // Validar usuario
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        // Comprobamos que sea un email valido
        // Si no lo es devuelve "false"
        // Si lo es devuelve el correo como string
        $email = mysqli_real_escape_string($db, filter_var( $_POST["email"], FILTER_VALIDATE_EMAIL ) );

        $password = mysqli_real_escape_string( $db, $_POST["password"] );

        if(!$email){
            $errores[] = "El email es obligatorio o no es valido";
        }

        if(!$password){
            $errores[] = "El password es obligatorio";
        }

        // Una vez que no haya errores
        if(empty($errores)){
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query( $db, $query);

            if ( $resultado->num_rows ){ // Revisar si el usuario existe
                // Tomamos los datos del usuario desde DB
                $usuario = mysqli_fetch_assoc( $resultado );

                // Verificamos que el password coincida con el de DB
                $auth = password_verify($password, $usuario["password"]);

                if ( $auth ){
                    // El usuario esta autenticado
                    session_start();

                    // Llenar el arreglo de $_SESSION
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true;
                }else{
                    $errores[] = "El password es incorrecto";
                }

            }else{
                $errores[] = "El usuario no existe";
            }
        }

    }

    // Incluir Header
    incluirTemplate("header");
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error){ ?>
            <div class="alerta error">
                <?php print($error); ?>
            </div>
        <?php } ?>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email"
                required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password"
                id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar sesion" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>