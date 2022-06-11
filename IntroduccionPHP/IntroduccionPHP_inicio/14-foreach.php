<?php include 'includes/header.php';

$productos = [
    [
        'nombre' => 'Tablet',
        'precio' => 200,
        'disponible' => true
    ],
    [
        'nombre' => 'Pc',
        'precio' => 100,
        'disponible' => true
    ],
    [
        'nombre' => 'Monitor',
        'precio' => 50,
        'disponible' => false
    ]
];

foreach ($productos as $producto) { ?>

    <li>
        <p>Producto: <?php echo $producto['nombre']; ?></p>
        <p>Precio: <?php echo "$" . $producto['precio']; ?></p>
        <p><?php echo ($producto['disponible']) ? 'Disponible' : 'No Disponible'; ?></p>

    </li>
<?php
}

include 'includes/footer.php';
