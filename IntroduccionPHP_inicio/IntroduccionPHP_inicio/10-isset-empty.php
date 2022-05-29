<?php include 'includes/header.php';

$clientes = [];
$clientes2 = array();
$clientes3 = array('Pedro', 'Juan', 'Karen');
$cliente = [
    'nombre' => 'Juan',
    'saldo' => 200
];

// Empty - Revisa si un arreglo esta vacio
var_dump(empty($clientes));
var_dump(empty($clientes3));
var_dump(empty($clientes2));

// Isset - Revusa si un arreglo esta cerrado o una propiedad esta definida
echo '<br>';
var_dump(isset($clientes4));
var_dump(isset($clientes));

// Isset - permite revisar si una propiedad de un arreglo asociativo existe
echo '<br>';
var_dump(isset($cliente['nombre']));
var_dump(isset($cliente['code']));

include 'includes/footer.php';
