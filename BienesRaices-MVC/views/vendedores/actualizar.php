<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <!-- Llamar template de formulario -->
        <?php include __DIR__ . '/form_vendedores.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>

</main>