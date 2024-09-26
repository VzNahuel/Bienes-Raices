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

        $vendedores = Vendedor::all();

        $status = $_GET["status"] ?? NULL;

        $auth = $_SESSION["login"];

        $router->render("propiedades/admin",[
            "propiedades" => $propiedades,
            "status" => $status,
            "vendedores" => $vendedores,
            "auth" => $auth
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

        $vendedores = Vendedor::all();

        // Codigo para metodo POST
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            // Asginamos los datos en un arreglo
            $args = [];

            $args["titulo"] = $_POST["titulo"] ?? null ;
            $args["precio"] = $_POST["precio"] ?? null ;
            $args["descripcion"] = $_POST["descripcion"] ?? null ;
            $args["habitaciones"] = $_POST["habitaciones"] ?? null ;
            $args["wc"] = $_POST["wc"] ?? null ;
            $args["estacionamiento"] = $_POST["estacionamiento"] ?? null ;
            $args["vendedores_id"] = $_POST["vendedores_id"] ?? null ;

            // Comparamos el POST con el Objeto
            $propiedad->sincronizarObjeto($args);

            // Validacion
            // NOTA: No deberia validar despues de agregar la imagen???
            $errores = $propiedad->validar();


            // Subida de archivos

            // Generar un nombre unico
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            if($_FILES["imagen"]["tmp_name"]){ // Si la imagen se agrego al formulario...
                // Usamos fit en la imagen
                $imagen = ImageMan::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                
                // Definimos el nombre en el objeto "Propiedad"
                $propiedad->setImagen($nombreImagen);
            }

            if(empty($errores)){
                if($_FILES["imagen"]["tmp_name"]){
                    $imagen->save(DIRECTORIO_IMAGENES . $nombreImagen);
                }
                
                $resultado = $propiedad->guardar();
            
                if($resultado){
                    // Redireccionar. NO debe haber HTML imprimido antes de redireccionar
                    header("Location: /admin?status=2");
                }
            }

        }

        $router->render("/propiedades/actualizar", [
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){

                $tipo = $_POST["tipo"];

                // Validamos
                if(validarTipoContenido($tipo)){
                    
                    // Compara lo que se borrara
                    if($tipo === "propiedad"){
                        $propiedad = Propiedad::find($id);
                        $resultado = $propiedad->eliminarDB();

                        if($resultado){
                            $propiedad->borrarImagen();

                            header("Location: /admin?status=3");
                        }

                    }
                }
            }
        }
    }
}