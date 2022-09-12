<?php
// Incluye el header
require 'includes/app.php';
$db = conectarDB();

// Crear un email y password
$email = "correo@correo.com";
$pass = "123";

$passwordHash = password_hash($pass, PASSWORD_DEFAULT);

// Query para la base de datos
$query = "INSERT INTO usuarios (email, pass) VALUES ('${email}', '${passwordHash}');";

// Agregarlo a la base de datos
mysqli_query($db, $query);
