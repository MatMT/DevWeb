<?php include 'includes/header.php';

$carrito = ['Tablet', 'Televisión', 'PC'];

// Util para ver los contenidos de un array
echo "<pre>";
var_dump($carrito);
echo "</pre>";

// Acceder a un elemento del array
echo $carrito[1];

// Añade un elemento en el indice del arreglo
$carrito[3] = ".";

// Añadir un elemento al final...
array_push($carrito, "Audifonos");

// Añadir un elemento al inicio 
array_unshift($carrito, "MiBand");

echo "<pre>";
var_dump($carrito);
echo "</pre>";

$clientes = array('Oscar', 'Martín', 'Juan');

echo "<pre>";
var_dump($clientes);
echo "</pre>";


include 'includes/footer.php';
