<?php include 'includes/header.php';

// Conectar a la BD con PDO - Soporta hasta 12 bases de datos
$db = new PDO('mysql:host=localhost; dbname=bienes_raices', 'root', '');

// Creamos el query
$query = "SELECT titulo, imagen FROM propiedades";

// Lo preparamos
$stmt = $db->prepare($query);

// Lo ejecutamos
$stmt->execute();

// Obtenemos los resultados
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Iteramos
foreach ($resultado as $propiedad) :
    var_dump($propiedad['titulo']);
    echo "<br>";
    var_dump($propiedad['imagen']);
    echo "<br>";
endforeach;

// echo "<pre>";
// var_dump($resultado);
// echo "</pre>";

include 'includes/footer.php';
