<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $columnasDB = ["id", "nombre", "apellido", "telefono"];

    protected static $nombreTabla = "vendedores";

    protected $id;
    protected $nombre;
    protected $apellido;
    protected $telefono;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
    }

    public function validar(){
        if(!$this->getNombre()){
            self::$errores[] = "El nombre es obligatorio";
        }

        if(!$this->getApellido()){
            self::$errores[] = "El apellido es obligatorio";
        }

        if(!$this->getTelefono()){
            self::$errores[] = "El telefono es obligatorio";
        }
        
        if(!preg_match('/[0-9]{10}/', $this->getTelefono())){
            self::$errores[] = "Formato no valido";
        }
        
        return self::$errores;
    }

    /** GETTERS **/
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getTelefono(){
        return $this->telefono;
    }
    
}