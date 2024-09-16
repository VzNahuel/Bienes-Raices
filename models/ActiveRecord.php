<?php

namespace Model;

class ActiveRecord{
    

    // Definir DB
    private static $db;
    protected static $columnasDB = [];

    private static $nombreTabla = "";


    // Errores
    protected static $errores = [];

    // Hacemos la composicion de un objeto "$database"
    public static function setDB($database){
        self::$db = $database;  // Asignamos el atributo con ese objeto
    }

    // Esta funcion se utiliza SI O SI en updates.
    // Para crear, se llama directamente a 'crearDB'.
    public function guardar(){
        if ( isset($this->id) ){ // Si tiene ID, actualiza
            $resultado = $this->actualizarDB();

            return $resultado;
        }else{                   // Caso contrario, crea
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
        $query = "INSERT INTO " . static::$nombreTabla . " ( ";
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

        $query = "UPDATE " . static::$nombreTabla . " SET ";
        $query = $query . join(', ', $valores);
        $query = $query . " WHERE id = '" . self::$db->escape_string( $this->getId() ) . "' ";
        $query = $query . " LIMIT 1 ";

        $resultado = self::$db->query( $query );

        return $resultado;
    }

    public function eliminarDB(){
        $query = "DELETE FROM " . static::$nombreTabla . " WHERE id = '" . self::$db->escape_string( $this->getId() ) . "' LIMIT 1";

        $resultado = self::$db->query( $query );

        return $resultado;
    }

    public function setImagen($imagen){
        // Codigo para actualizar imagenes
        if( $this->id ){
            $this->borrarImagen();
        }

        // Agregar el nombre al objeto cuando se crea
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen(){
        // Comprobamos si hay una imagen agregada
        $existeArchivo = file_exists(DIRECTORIO_IMAGENES . $this->imagen);

        // Si la hay, borra la anterior
        if ( $existeArchivo ){
            unlink(DIRECTORIO_IMAGENES . $this->imagen);
        }
    }

    public function definirAtributos(){
        $atributos = [];

        foreach(static::$columnasDB as $columna){
            
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
        return static::$errores;
    }

    public function validar(){
        
        // Limpiar el arreglo antes de validar
        static::$errores = [];
        
        return static::$errores;
    }

    // Mostrar una propiedad por ID
    public static function find($id){
        $query = "SELECT * FROM " . static::$nombreTabla . " WHERE id = '$id'";

        $resultado = self::$db->query($query);

        // $registro es un Arreglo Asoc.
        $registro = $resultado->fetch_assoc();

        $objeto = static::convertirObjeto($registro);

        return $objeto;

    }

    // Listar todas las propiedades
    public static function all(){
        $query = "SELECT * FROM " . static::$nombreTabla;

        $resultado = self::$db->query($query);

        $array = [];

        while( $registro = $resultado->fetch_assoc() ){
            $objeto = static::convertirObjeto($registro);

            $array[] = $objeto;
        }

        // Liberar memoria
        $resultado->free();

        return $array;
    }

    // Obtiene un determinado Nº de registros
    public static function getN($n){
        $query = "SELECT * FROM " . static::$nombreTabla . " LIMIT " . $n;

        $resultado = self::$db->query($query);

        $array = [];

        while( $registro = $resultado->fetch_assoc() ){
            $objeto = static::convertirObjeto($registro);

            $array[] = $objeto;
        }

        // Liberar memoria
        $resultado->free();

        return $array;
    }


    private static function convertirObjeto($registro){
        $objeto = new static;

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

}