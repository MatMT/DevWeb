<?php include 'includes/header.php';
// SENTENCIAS PREPARADOS MEJORAN EL PERFORMANCE Y LA SEGURIDAD 

// Conectar la BD con Mysqli.
$db = new mysqli('localhost', 'root', '', 'bienes_raices');

// Creamos el Query
$query = "SELECT titulo, imagen FROM propiedades";

// Lo preparamos
$stmt = $db->prepare($query);

// Lo ejecutamos
$stmt->execute();

// Creamos la variable
$stmt->bind_result($titulo, $imagen);

// Asignamos el resultado 
$stmt->fetch();

// Imprimir el resultado
while ($stmt->fetch()) :
    var_dump($titulo);
    var_dump($imagen);
endwhile;

include 'includes/footer.php';
