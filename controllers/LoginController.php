<?php

namespace Controllers;


use MVC\Router;
use Model\Usuario;
use Classes\Email;


class LoginController{

    public static function login(Router $router){

        $alertas = [];
        $auth = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                // Comprobar que exista el usuario:
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    // Verificar el password
                    $usuario->comprobarPasswordAndVerificado($auth->password);
                }else{
                    Usuario::setAlerta('error', 'Usuario NO Encontrado.');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
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


    public static function crear(Router $router)
    {

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
                    
                    // Crear el usuario:
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                       header('Location: /mensaje');
                    }
                    
                }
                
            }
        }


        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', []);
    }

    public  static function confirmar(Router $router)
    {
        $alertas =[];

        $token = s($_GET['token']);
        
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token No Válido');

        }else{
            //Modificar a usuario confirmado
            $usuario->confirmado = "1";
             //Eliminamos el token
            $usuario->token = null;
           
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente.');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

}


?>