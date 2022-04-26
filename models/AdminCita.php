<?php
// Esta clase, no es nigun modelo que exista en la base de datos, es mas bien el resultado de una consulta SQL
// avanzada, en este caso, usamos JOINS por eso nace esta clase.


namespace Model;

class AdminCita extends ActiveRecord{

    protected static $tabla = 'citasservicios';
    // Estos valores de columnas no existen en si, son la union de la consulta con JOIN en mi Base de Datos.
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio'];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';

    }

}

?>