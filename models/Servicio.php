<?php

namespace Model;

class Servicio extends ActiveRecord{

    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    // Registro de atributos
    public $id;
    public $nombre;
    public $precio;

    // Constructor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Servicio es Obligatorio';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'El Precio del Servicio es Obligatorio';
        }
        if (!is_numeric($this->precio)) { // Si no es numerico
            self::$alertas['error'][] = 'El Precio no es válido';
        }

        return self::$alertas;
    }
}


?>