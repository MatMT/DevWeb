<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIEventos;
use Controllers\APIPonentes;
use Controllers\APIRegalos;
use Controllers\AuthController;
use Controllers\EventosController;
use Controllers\PaginasController;
use Controllers\RegalosController;
use Controllers\PonentesController;
use Controllers\RegistroController;
use Controllers\DashboardController;
use Controllers\RegistradosController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// Área de administración
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

// Enlaces de Ponentes
$router->get('/admin/ponentes', [PonentesController::class, 'index']);
$router->get('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->post('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->get('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/eliminar', [PonentesController::class, 'eliminar']);

// Enlaces de Eventos
$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);

// API ROUTES =====
$router->get('/api/eventos-horario', [APIEventos::class, 'index']);
$router->get('/api/ponentes', [APIPonentes::class, 'index']);
$router->get('/api/ponente', [APIPonentes::class, 'ponente']);

$router->get('/admin/registrados', [RegistradosController::class, 'index']);

$router->get('/admin/regalos', [RegalosController::class, 'index']);
$router->get('/api/regalos', [APIRegalos::class, 'index']);

// AREA Pública ===
$router->get('/', [PaginasController::class, 'index']);
$router->get('/devwebcamp', [PaginasController::class, 'evento']);
$router->get('/paquetes', [PaginasController::class, 'paquetes']);
$router->get('/workshops-conferencias', [PaginasController::class, 'conferencias']);

// Registro de Usuarios y Paquetes
$router->get('/finalizar-registro', [RegistroController::class, 'index']);
$router->post('/finalizar-registro/gratis', [RegistroController::class, 'storeFree']);
$router->post('/finalizar-registro/pagar', [RegistroController::class, 'storePay']);
$router->get('/finalizar-registro/conferencias', [RegistroController::class, 'conferencias']);
$router->post('/finalizar-registro/conferencias', [RegistroController::class, 'storeConference']);

// Boleto virtual
$router->get('/boleto', [RegistroController::class, 'boleto']);

// 404
$router->get('/404', [PaginasController::class, 'Page404']);


$router->comprobarRutas();
