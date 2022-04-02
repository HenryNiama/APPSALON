<?php

namespace Controllers;


use MVC\Router;
use Model\Usuario;
use Classes\Email;


class LoginController{

    public static function login(Router $router){
        $router->render('auth/login');
    }

    public static function logout(){
        echo "Desde LogOut";
    }

    public static function forget(Router $router){
        $router->render('auth/olvide-password', [

        ]);
    }

    public static function recuperar(){
        echo "Desde Recuperar";
    }


    public static function crear(Router $router){

        $usuario = new Usuario();

        // Alertas Vacias
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // Revisar que alertas este vacio
            if (empty($alertas)) {
                // echo "Pasaste la validación";

                // Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                //  Si ya existe un usuario registrado:
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas(); // Llamo a las alertas

                }else{// No esta registrado
                    
                    // hashear el Password
                    $usuario->hashPassword();

                    // Generar un token Unico
                    $usuario->crearToken();

                    // Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token); // Se crea el email

                    $email->enviarConfirmacion();
                                  
                    debuguear($usuario);
                    
                }
                
            }
        }


        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }


}


?>