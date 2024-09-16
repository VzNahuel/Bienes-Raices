<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedores_id"];

    protected static $nombreTabla = "propiedades";

    
    protected $id;
    protected $titulo;
    protected $precio;
    protected $imagen;
    protected $descripcion;
    protected $habitaciones;
    protected $wc;
    protected $estacionamiento;
    protected $creado;
    protected $vendedores_id;

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

    public function validar(){
        if(!$this->getTitulo()){
            self::$errores[] = "El titulo es obligatorio";
        }
        
        if(!$this->getPrecio()){
            self::$errores[] = "El precio es obligatorio";
        }
        if(!$this->getDescripcion()){
            self::$errores[] = "La descripcion es obligatoria";
        }
        if(!$this->getDescripcion()){
            self::$errores[] = "La cantidad de habitaciones es obligatoria";
        }
        if(!$this->getWc()){
            self::$errores[] = "La cantidad de wc es obligatoria";
        }
        if(!$this->getEstacionamiento()){
            self::$errores[] = "La cantidad de lugares de estacionamiento es obligatoria";
        }
        if(!$this->getVendedores_id()){
            self::$errores[] = "Debe seleccionar un vendedor";
        }

        if(!$this->getImagen()){
            self::$errores[] = "La imagen de la propiedad es obligatoria";
        }
        
        return self::$errores;
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