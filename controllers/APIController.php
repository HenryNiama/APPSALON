<?php

namespace Controllers;

use Model\Servicio;


class APIController{
    
    public static function index(){
        $servicios = Servicio::all();

        // Transformamos nuestro objeto con todos los servicios de la base de datos a JSON:
        echo json_encode($servicios);

        // debuguear($servicios);
    }

}

?>