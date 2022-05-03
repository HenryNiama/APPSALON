<?php 

// Este es el archivo que arranca todo.

// los archivos relacionados a composer, etc, deben ir primero, antes del database.php
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); // carga automaticamente el archivo .env
$dotenv->safeLoad(); // Indica que si el archivo no existe (.env), no nos va a marcar un error.

require 'funciones.php';
require 'database.php';


// Conectarnos a la base de datos

use Model\ActiveRecord;
ActiveRecord::setDB($db);