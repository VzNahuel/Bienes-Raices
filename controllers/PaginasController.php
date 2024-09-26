<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::getN(3);
        $inicio = true;

        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "inicio" => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render("paginas/nosotros");
    }
    
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }
    
    public static function propiedad(Router $router){
        $id = validarId("/propiedades");

        $propiedad = Propiedad::find($id);

        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }
    
    public static function blog(Router $router){
        $router->render("paginas/blog");
    }
    
    public static function entrada(Router $router){
        $router->render("paginas/entrada");
    }
    
    public static function contacto(Router $router){
        $mensaje = null;

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $respuestas = $_POST["contacto"];

            $mail = new PHPMailer();

            // Configurar SMTP (Mail Protocol)
            $mail->isSMTP();                            // Usamos SMTP

            $mail->Host = "sandbox.smtp.mailtrap.io";   // Definimos el Host
            $mail->Port = 2525;
            $mail->SMTPAuth = true;                     // Nos vamos a autenticar

            $mail->Username = "8155b149384568";
            $mail->Password = "5c2542ce29f4fa";

            $mail->SMTPSecure = "tls";                  // Evita ser interceptado

            // Configurar el contenido del mail
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress("admin@bienesraices.com", "BienesRaices.com");
            $mail->Subject = "Tienes un nuevo mensaje";

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            // Definir el contenido
            $contenido = "<html>";

            $contenido .= "<p>Tienes un nuevo mensaje</p>";
            $contenido .= "<p>Nombre: " . $respuestas["nombre"] . "</p>";
            

            if($respuestas["contacto"] === "telefono"){
                $contenido .= "<p>Eligió ser contactado por Telefono:</p>";
                $contenido .= "<p>Telefono: " . $respuestas["telefono"] . "</p>";
                $contenido .= "<p>Fecha Contacto: " . $respuestas["fecha"] . "</p>";
                $contenido .= "<p>Hora: " . $respuestas["hora"] . "</p>";
            }else{
                $contenido .= "<p>Eligió ser contactado por Email:</p>";
                $contenido .= "<p>Email: " . $respuestas["email"] . "</p>";
            }
            
            $contenido .= "<p>Mensaje: " . $respuestas["mensaje"] . "</p>";
            $contenido .= "<p>Vende o Compra: " . $respuestas["tipo"] . "</p>";
            $contenido .= "<p>Presupuesto: $" . $respuestas["presupuesto"] . "</p>";

            $contenido .= "<p>Prefiere ser contactado por: ";
            $contenido .= $respuestas["contacto"] . "</p>";



            $contenido .= "</html>";

            $mail->Body = $contenido;
            $mail->AltBody = "Texto alternativo";

            // Enviar el correo
            $resultado = $mail->send();

            if($resultado){
                $mensaje = "Mensaje Enviado Correctamente";
            }else{
                $mensaje = "El mensaje NO se puedo enviar";
            }
        }

        $router->render("paginas/contacto", [
            "mensaje" => $mensaje
        ]);
    }
    
}