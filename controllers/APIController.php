<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;

class APIController{
    
    public static function index(){
        $servicios = Servicio::all();

        // Transformamos nuestro objeto con todos los servicios de la base de datos a JSON:
        echo json_encode($servicios);

        // debuguear($servicios);
    }

    public static function guardar(){
        
        $cita = new Cita($_POST);

        $resultado = $cita->guardar();
     
        echo json_encode($resultado);
    }

}

?>