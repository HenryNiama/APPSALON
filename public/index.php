<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;

use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\APIController;


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



// --------------------- API DE CITAS --------------------------------------

//Primer endopoint: Lista todos los servicios que tenemos en la base de datos y la respuesta es en JSON
$router->get('/api/servicios', [APIController::class, 'index']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();