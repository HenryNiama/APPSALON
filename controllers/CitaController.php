<?php

namespace Controllers;

use MVC\Router;


class CitaController {


    public static function index(Router $router){

        // session_start();  // Por si acaso

        isAuth(); // Revisa si esta autenticado el usuario o no.

        $router->render('cita/index', [
                'nombre' => $_SESSION['nombre'],
                'id' => $_SESSION['id']
        ]);
        
    }

}


?>