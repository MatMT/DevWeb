<?php include 'includes/header.php';

$cliente = [
    'nombre' => 'Juan',
    'saldo' => 200,
    'informacion' => [
        'tipo' => 'Tipo premium',
        'disponible' => 100
    ]
];

echo "<pre>";
var_dump($cliente['informacion']);
echo "</pre>";

echo $cliente['informacion']['tipo'];

$cliente['codigo'] = 1241;

echo "<pre>";
var_dump($cliente);
echo "</pre>";

include 'includes/footer.php';
