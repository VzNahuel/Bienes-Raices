<?php


define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");

define("DIRECTORIO_IMAGENES", $_SERVER["DOCUMENT_ROOT"]);

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

// Sanitizar html
function sanitizar($html) : string{
    $s = htmlspecialchars($html);

    return $s;
}


// Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ["propiedad", "vendedor"];

    return in_array($tipo, $tipos); // Se encuentra 'tipo' en 'tipos'?
}

// Mostrar alertas
function mostrarAlertas($status = 0){
    $mensaje = "";

    switch($status){
        case 1:
            $mensaje = "Registrado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarId(string $url){
    // Validar el ID como INT; Enviamos a "admin" si no es INT
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: ${url}");
    }

    return $id;
}