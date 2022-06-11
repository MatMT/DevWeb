<?php include 'includes/header.php';

$autenticado = true;
$admin = false;

if ($autenticado & $admin) {
    echo 'Usuario atenticado correctamente';
} else {
    echo 'Usuario no atenticado, inicia sesión';
}

echo "<br>";

// If anidados...

$cliente = [
    'nombre' => 'Juan',
    'saldo' => 0,
    'informacion' => [
        'tipo' => 'Regular'
    ]
];

if (!empty($cliente)) {
    echo ("El arreglo de cliente no esta vacio");

    echo "<br>";

    if ($cliente['saldo'] > 0) {
        echo "El saldo del cliente esta disponible";
    } else {
        echo "No hay saldo";
    }
}
echo "<br>";

// else if
if ($cliente['saldo'] > 0) {
    echo "El cliente tiene saldo";
} else if ($cliente['informacion']['tipo'] === 'Premium') {
    echo "El cliente es Premium";
} else {
    echo "No hay cliente definido o no tiene saldo o no es premium";
}

// Switch

echo "<br>";

$tecnologia = "PH";

switch ($tecnologia) {
    case 'PHP':
        echo "PHP es un excelente lenguaje";
        break;
    default:
        echo "Algún lenguaje que no se cual es";
        break;
}




include 'includes/footer.php';
