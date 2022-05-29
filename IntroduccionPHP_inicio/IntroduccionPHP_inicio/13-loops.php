<?php include 'includes/header.php';

// While
// Primero revisa la condición luego ejecuta el codigo

$i = 0; // Contador

while ($i < 10) { // Se ejecuta mientras no sea verdadera
    echo $i;
    echo "<br>";
    $i++; // Incremento
}

// Do While
// Primero ejecuta el codigo, luego revisa la condición

$i = 0;
echo "<br>";

do {
    echo $i . "<br>";
    $i++;
} while ($i < 10);

// For Loop
// Mientras una condición sea evaluada como verdadera o hasta que sea tomada como falsa


/**
 * 3 imprimir Fizz
 * 5 imprimir Buzz
 * 3 y 5 imrpimir Fizz Buzz
 */

for ($i = 0; $i < 10; $i++) {
    if ($i % 15 === 0) {
        echo $i . "- Fizz Buzz </br>";
    } elseif ($i % 3 === 0) {
        echo $i . "- Fizz </br>";
    } else if ($i % 5 === 0) {
        echo $i . "- Buzz </br>";
    }
}

echo "<br>";

// For Each
$clientes = array('Pedro', 'Juan', 'Karen');

foreach ($clientes as $cliente) :
    echo $cliente . '<br/>';
endforeach;

$cliente = [
    'Nombre' => 'Juan',
    'Saldo' => 200,
    'Tipo' => 'Premium'
];

foreach ($cliente as $key => $valor) :
    echo $key . " - " . $valor . '<br/>';
endforeach;


include 'includes/footer.php';
