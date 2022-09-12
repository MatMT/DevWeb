<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la BD
$db = conectarDB();

use App\Propiedad;

$propiedad = new Propiedad;

Propiedad::setDB($db);
