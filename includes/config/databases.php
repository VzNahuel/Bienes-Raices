<?php

function conectarDB() : mysqli{
    $db = mysqli_connect("localhost", "root", "root", "bienesraices_crud");

    if(!$db){
        print("No se pudo conectar");
        exit;
    }

    return $db;
}