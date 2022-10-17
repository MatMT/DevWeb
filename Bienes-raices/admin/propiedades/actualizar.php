<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
estaAutenticado();

// Validar la URL por ID válido
$id = $_GET['id'] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);

// Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

// VALIDACIÓN EXTRA
// if (!$id || !$resultado->num_rows) {
//     header('Location: /');
// }

// Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

// Ejecutar el código después de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* Crea una nueva instancia */
    $args = $_POST['propiedad'];

    $propiedad->sincro($args);

    // Validación
    $errores = $propiedad->validar();

    /* SUBIDA DE ARCHIVOS */

    // Generar un nombre único 
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Setear la imagen
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImage($nombreImagen);
    }

    // Revisar que el arreglo de errores este vacio
    if (empty($errores)) {
        // Almacenar la imagen
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        $propiedad->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <!-- Llamar template de formulario -->
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>