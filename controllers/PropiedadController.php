<?php

namespace Controllers;
use MVC\Router;

use Model\Propiedad;
use Model\Vendedor;

/** IMPORTANTE **/
// Usar la version 2.7 de Intervention. Las modernas no compilan
use Intervention\Image\ImageManagerStatic as ImageMan;

class PropiedadController{
    public static function index(Router $router){

        $propiedades = Propiedad::all();

        $status = $_GET["status"] ?? NULL;

        $router->render("propiedades/admin",[
            "propiedades" => $propiedades,
            "status" => $status
        ]);
    }

    public static function crear(Router $router){
        
        // Creamos una propiedad vacia
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        // Arreglo de errores
        $errores = Propiedad::getErrores();

        // METODO POST
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            
            // Nueva instancia de la propiedad
            $propiedad = new Propiedad($_POST);

            // Generar un nombre unico
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // Resize a la imagen
            if($_FILES["imagen"]["tmp_name"]){ // Si la imagen se agrego al formulario...
                // Usamos fit en la imagen
                $imagen = ImageMan::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                
                // Definimos el nombre en el objeto "Propiedad"
                $propiedad->setImagen($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();

            if(empty($errores)){
                /*
                    Crea la carpeta de imagenes.
                    La ruta es la constante definida en "includes/funciones.php"
                */
                if(!is_dir(DIRECTORIO_IMAGENES)){ // Comprueba si la carpeta existe
                    mkdir(DIRECTORIO_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $imagen->save(DIRECTORIO_IMAGENES.$nombreImagen);

                // Guarda en DB
                $resultado = $propiedad->crearDB();
                
                if($resultado){
                    // Redireccionar. NO debe haber HTML imprimido antes de redireccionar
                    header("Location: /admin?status=1");
                }
                    
            }

        }

        $router->render("propiedades/crear",[
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);

    }

    public static function actualizar(Router $router){
        $id = validarId("/admin");

        $propiedad = Propiedad::find($id);

        $errores = Propiedad::getErrores();

        $router->render("/propiedades/actualizar", [
            "propiedad" => $propiedad,
            "errores" => $errores
        ]);
    }
}