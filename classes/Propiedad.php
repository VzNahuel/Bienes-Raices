<?php

namespace App;

class Propiedad{

    // Definir DB
    private static $db;
    private static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedores_id"];

    // Errores
    private static $errores = [];


    public $id;
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
        $this->vendedores_id = $args["vendedores_id"] ?? 1;
    }

    // Hacemos la composicion de un objeto "$database"
    public static function setDB($database){
        self::$db = $database;  // Asignamos el atributo con ese objeto
    }

    public function guardar(){
        if ( isset($this->id) ){
            $resultado = $this->actualizarDB();

            return $resultado;
        }else{
            $this->crearDB();
        }
    }

    public function crearDB(){
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

    public function actualizarDB(){
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];

        foreach( $atributos as $key => $value ){
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query = $query . join(', ', $valores);
        $query = $query . " WHERE id = '" . self::$db->escape_string( $this->getId() ) . "' ";
        $query = $query . " LIMIT 1 ";

        $resultado = self::$db->query( $query );

        return $resultado;
    }

    public function setImagen($imagen){
        // Codigo para actualizar imagenes
        if( $this->id ){
            // Comprobamos si hay una imagen agregada
            $existeArchivo = file_exists(DIRECTORIO_IMAGENES . $this->imagen);

            // Si la hay, borra la anterior
            if ( $existeArchivo ){
                unlink(DIRECTORIO_IMAGENES . $this->imagen);
            }
        }

        // Agregar el nombre al objeto cuando se crea
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

    // Mostrar una propiedad por ID
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = '$id'";

        $resultado = self::$db->query($query);

        // $registro es un Arreglo Asoc.
        $registro = $resultado->fetch_assoc();

        $objeto = self::convertirObjeto($registro);

        return $objeto;

    }

    // Listar todas las propiedades
    public static function all(){
        $query = "SELECT * FROM propiedades";

        $resultado = self::$db->query($query);

        $array = [];

        while( $registro = $resultado->fetch_assoc() ){
            $objeto = self::convertirObjeto($registro);

            $array[] = $objeto;
        }

        // Liberar memoria
        $resultado->free();

        return $array;
    }

    private static function convertirObjeto($registro){
        $objeto = new Propiedad();

        foreach( $registro as $key => $value ){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        
        return $objeto;
    }

    // Sincroniza los datos en POST con el objeto Propiedad
    public function sincronizarObjeto( $args = [] ){
        foreach( $args as $key => $value ){
            if( property_exists($this, $key) && !is_null($value) ){
                $this->$key = $value;
            }
        }
    }


    /** GETTERS **/
    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getHabitaciones(){
        return $this->habitaciones;
    }

    public function getWc(){
        return $this->wc;
    }

    public function getEstacionamiento(){
        return $this->estacionamiento;
    }

    public function getCreado(){
        return $this->creado;
    }

    public function getVendedores_id(){
        return $this->vendedores_id;
    }
}