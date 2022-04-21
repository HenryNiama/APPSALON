<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController{
    
    public static function index(){
        $servicios = Servicio::all();

        // Transformamos nuestro objeto con todos los servicios de la base de datos a JSON:
        echo json_encode($servicios);

        // debuguear($servicios);
    }

    public static function guardar(){
        
        // Almacena la Cita y devuevle el ID de la misma
        $cita = new Cita($_POST);
        // Escribimos en la Tabla de Cita de la Base de Datos
        $resultado = $cita->guardar(); // Retorna un array con el boolean y el Id de la Cita.

        // Almacena la Cita y el servicio(s)
        $idCita = $resultado['id'];

        // Voy a tomar un string, lo separo por comas, y lo convierto en un arreglo
        $idServicios = explode(",", $_POST['servicios']); // Devuelve un array

        // Almacena cada servicio con el id de la Cita.
        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $idCita,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        // Retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);


    }

}

?>