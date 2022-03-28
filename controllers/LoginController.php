<?php


namespace Controllers;

use MVC\Router;


class LoginController{

    public static function login(Router $router){
        $router->render('auth/login');
    }

    public static function logout(){
        echo "Desde LogOut";
    }

    public static function forget(){
        echo "Desde Forget";
    }

    public static function recuperar(){
        echo "Desde Recuperar";
    }

    public static function crear(){
        echo "Crear Cuenta";
    }
}


?>