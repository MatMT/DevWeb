<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\CitaController;
use MVC\Router;
use Controllers\LoginController;

$router = new Router();

// Iniciar Sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

// Cerrar Sesión
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// Citas de usuarios

// Area Privada
$router->get('/cita', [CitaController::class, 'index']);
$router->post('/cita', [CitaController::class, 'index']);

// API de Citas
$router->get('/api/servicios', [APIController::class, 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
