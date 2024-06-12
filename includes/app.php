<?php

require "funciones.php";
require "config/databases.php";

require __DIR__ . "/../vendor/autoload.php";

// Conectarnos a la DB
$db = conectarDB();

use App\Propiedad;

Propiedad::setDB($db);