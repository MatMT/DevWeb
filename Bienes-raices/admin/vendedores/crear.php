<?php
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Crear una nueva instancia
    $vendedor = new  Vendedor($_POST['vendedor']);

    // Validar que no haya campos vacíos

    $errores = $vendedor->validar();

    // No hay errores
    if (empty($errores)) {
        $vendedor->guardar();
    }
}




incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
        <!-- Llamar template de formulario -->
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>