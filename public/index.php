<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;

use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\ServicioController;


$router = new Router();

// ---------------------Para el Login-------------------------------------------- 
// Iniciar Sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar Password
$router->get('/forget', [LoginController::class, 'forget']);
$router->post('/forget', [LoginController::class, 'forget']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);



// ---------------------Para las Citas-------------------------------------------- 
// AREA PRIVADA
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);



// --------------------- API DE CITAS --------------------------------------

//Primer endopoint: Lista todos los servicios que tenemos en la base de datos y la respuesta es en JSON
$router->get('/api/servicios', [APIController::class, 'index']);
// Registramos una URL que se encargue de leer los datos que enviamos mediante FormData
$router->post('/api/citas', [APIController::class, 'guardar']);
// Para eliminar una cita segun la fecha:
$router->post('/api/eliminar', [APIController::class, 'eliminar']);


// ---------------------------- CRUD DE SERVICIOS --------------------------------
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();