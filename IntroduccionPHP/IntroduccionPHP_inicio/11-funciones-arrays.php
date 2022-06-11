<?php include 'includes/header.php';

// in_array - buscar elementos en un atajo

$carrito = ['Tablet', 'Computadora', 'Television'];

var_dump(in_array('Tablet', $carrito));
var_dump(in_array('Audifono', $carrito));

// Ordenar lo elementos de un arreglo

$numeros = array(1, 3, 4, 5, 1, 2);
sort($numeros); // de menor a mayor
rsort($numeros); // DE mayor a menor

echo "<pre>";
var_dump($numeros);
echo "</pre>";

// Ordenar arreglo asociativo
$cliente = array(
    'saldo' => 200,
    'tipo' => 'Premium',
    'nombre' => 'Juan'
);

echo "<pre>";
var_dump($cliente);
echo "</pre>";

asort($cliente); // Ordenar por valores (order alfabetico)
arsort($cliente); // Orden al reves

ksort($cliente); // Ordena por llaves (order alfabetico)
krsort($cliente); // Orden al reves 

echo "<pre>";
var_dump($cliente);
echo "</pre>";

include 'includes/footer.php';
