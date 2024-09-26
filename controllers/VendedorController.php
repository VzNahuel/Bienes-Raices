<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public static function crear( Router $router ){
        $errores = Vendedor::getErrores();

        $vendedor = New Vendedor();

        if ($_SERVER["REQUEST_METHOD"] === "POST"){

            // Instanciamos
            $vendedor = new Vendedor($_POST);
        
            // Validamos
            $errores = $vendedor->validar();
        
            if(empty($errores)){
                $resultado = $vendedor->crearDB();
        
                if($resultado){
                    // Redireccionar. NO debe haber HTML imprimido antes de redireccionar
                    header("Location: /admin?status=1");
                }
            }
        }

        $router->render("vendedores/crear", [
            "errores" => $errores,
            "vendedor" => $vendedor
        ]);
    }

    public static function actualizar(Router $router){
        $errores = Vendedor::getErrores();

        $id = validarId("/admin");

        $vendedor = Vendedor::find($id);

        // POST
        if ($_SERVER["REQUEST_METHOD"] === "POST"){

            // Agregamos los datos en un arreglo
            $args = [];
        
            $args["nombre"] = $_POST["nombre"] ?? null;
            $args["apellido"] = $_POST["apellido"] ?? null;
            $args["telefono"] = $_POST["telefono"] ?? null;
        
            // Añadimos los valores nuevos al objeto
            $vendedor->sincronizarObjeto($args);
        
            // Validamos
            $errores = $vendedor->validar();
        
            if(empty($errores)){
                $resultado = $vendedor->guardar();
        
                if($resultado){
                    header("Location: /admin?status=2");
                }
            }
        }

        $router->render("vendedores/actualizar", [
            "errores" => $errores,
            "vendedor" => $vendedor
        ]);
    }

    public static function eliminar(){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            // Valida el tipo de dato a eliminar
            $tipo = $_POST["tipo"];

            if(validarTipoContenido($tipo)){
                $vendedor = Vendedor::find($id);

                $resultado = $vendedor->eliminarDB();
                /*
                    Si el vendedor que se quiere eliminar forma parte de una
                    propiedad (es decir, si tenemos una propiedad que incluya
                    a este vendedor) entonces se producira un error.
                    Primero se debe eliminar dicha propiedad, luego el vendedor!
                */

                if($resultado){

                    header("Location: /admin?status=3");
                }
            }
        }
    }
}