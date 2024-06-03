<?php

require "includes/app.php";
$db = conectarDB();

// Crear un Email y Password
$email = "correo@correo.com";
$password = "123456";

// Hasheamos
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Creamos el query
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

// Agregamos a la BD
mysqli_query($db, $query);