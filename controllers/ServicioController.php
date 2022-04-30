<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;

class ServicioController {

    public static function index(Router $router){

        // session_start();

        isAdmin();

        // Traemos todos los servicios de la base de datos.
        $servicios = Servicio::all(); // trae un arreglo de objetos


        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router){
        
        isAdmin();

        $servicio = new Servicio; // Instancia Vacia

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sincronizamos el objeto que tenemos en memoria con los datos del POST, es decir
            // los nuevos datos se asignan al objeto existente.
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }

        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router){

        isAdmin();

        // Validamos el Id que mandamos por la url sea numerico, debido que alguien puede mandar sentencias como
        // DELETE * FROM,  etc.
    
        if(!is_numeric($_GET['id'])) return; // En caso de que sea false, enviamos un return.

        $servicio = Servicio::find($_GET['id']); // Instancia Vacia

        $alertas = [];
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(){

        isAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $servicio = Servicio::find($id);
            $servicio->eliminar();

            header('Location: /servicios');
        }
    }

}
?>