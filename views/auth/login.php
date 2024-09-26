<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php print($error); ?>
        </div>
    <?php } ?>

    <form
        class="formulario"
        method="POST"
        action="/login"><!-- El '/login' hace referencia a 'index.php'.
        Especificamente, a la linea '$router->post("/login")';
        -->
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