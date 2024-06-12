<?php

namespace App;

class Propiedad{

    // Definir DB
    private static $db;
    private static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedores_id"];

    // Errores
    private static $errores = [];


    private $id;
    private $titulo;
    private $precio;
    private $imagen;
    private $descripcion;
    private $habitaciones;
    private $wc;
    private $estacionamiento;
    private $creado;
    private $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedores_id = $args["vendedores_id"] ?? "";
    }

    // Hacemos la composicion de un objeto "$database"
    public static function setDB($database){
        self::$db = $database;  // Asignamos el atributo con ese objeto
    }

    public function guardarDB(){
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        // Creamos el nuevo string con las columnas
        $stringColumnas = join(", ", array_keys($atributos));
        // Creamos el nuevo string con los valores
        $stringValues = join("', '", array_values($atributos));

        // Insert en propiedades
        $query = "INSERT INTO propiedades ( ";
        $query = $query . $stringColumnas;
        $query = $query . " ) VALUES ( '";
        $query = $query . $stringValues;
        $query = $query . "' )";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function setImagen($imagen){
        // Agregar el nombre al objeto
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function definirAtributos(){
        $atributos = [];

        foreach(self::$columnasDB as $columna){
            
            if ($columna === "id") continue; // Salteamos la agregacion de "id"

            //$atributos["titulo"]   = $this->"titulo"
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->definirAtributos();

        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "El titulo es obligatorio";
        }
        
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        if(!$this->descripcion){
            self::$errores[] = "La descripcion es obligatoria";
        }
        if(!$this->habitaciones){
            self::$errores[] = "La cantidad de habitaciones es obligatoria";
        }
        if(!$this->wc){
            self::$errores[] = "La cantidad de wc es obligatoria";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "La cantidad de lugares de estacionamiento es obligatoria";
        }
        if(!$this->vendedores_id){
            self::$errores[] = "Debe seleccionar un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }
        
        return self::$errores;
    }

}