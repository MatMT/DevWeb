<?php

declare(strict_types=1);

include 'includes/header.php';

// ENCAPSULACIÓN
class Producto
{
    // Public - Se puede acceder y modificar en cualquier lugar | Clase y Objeto
    // Protected - Se puede acceder / modificar unicamente en la clase
    // Private - solo miembros de la misma puede acceder a él

    public function __construct(protected string $nombre, public int $precio, public bool $disponible)
    {
    }

    public function mostrarProducto(): void
    {
        echo "El producto es: " . $this->nombre . " y su precio es de: " . $this->precio;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }
}

$producto = new Producto('Tablet', 200, true);

echo $producto->getNombre();
$producto->setNombre('Laptop');

// $producto->mostrarProducto();

echo "<pre>";
var_dump($producto);
echo "</pre>";

// ------

$producto2 = new Producto('Teclado', 300, false);

echo $producto2->getNombre();

// $producto2->mostrarProducto();

// echo "<pre>";
// var_dump($producto2);
// echo "</pre>";

include 'includes/footer.php';
