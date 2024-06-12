<?php

function conectarDB() : mysqli{
    $db = new mysqli("localhost", "root", "root", "bienesraices_crud");

    if(!$db){
        print("No se pudo conectar");
        exit;
    }

    return $db;
}