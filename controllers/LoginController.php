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
                    // Verificar el password y si esta verificado
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)){
                        // Autenticar el usuario:
                        session_start();
                        
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamiento:
                        if ($usuario->admin === '1') {
                            // Si es admin:
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            // Si es cliente:
                            header('Location: /cita');
                        }
                    }

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

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)){
                $usuario  = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === "1") {
                    // Generar un token
                    $usuario->crearToken();
                    $usuario->guardar(); // Hace un Update en este registro en la base de datos

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // Alerta de Exito
                    Usuario::setAlerta('exito', 'Revisa tu Email');

                }else{
                    Usuario::setAlerta('error', 'El usuario NO existe o NO esta confirmado.');
                }          
            }

        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router){
        
        $alertas = [];

        $error = false; // Esta variable, es si es que el token es invalido, o si lo cambia algun chistosito.

        $token = s($_GET['token']);

        // Buscar usuario por su token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // Si no existe ningun usuario con ese token, o sea me marca null.
            Usuario::setAlerta('error', 'Token No Valido');
            $error = true;
        }

        // Una ves el Usuario envia su formulario:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer el nuevo password y guardarlo.
        }


        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
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