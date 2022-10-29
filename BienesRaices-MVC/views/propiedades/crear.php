<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <!-- Llamar template de formulario -->
        <?php include __DIR__ . '/form_propiedades.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>