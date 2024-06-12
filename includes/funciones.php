<?php


define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("DIRECTORIO_IMAGENES", __DIR__ . "/../imagenes/");

function incluirTemplate( string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool {
    session_start();
    
    if( !$_SESSION["login"] ){
        header("Location: /");
    }

    return false;
}

function iniciarDebug($var){
    print("<pre>");
    print(var_dump($var));
    print("</pre>");

    exit;
}