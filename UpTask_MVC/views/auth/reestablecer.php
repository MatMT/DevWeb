<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php';
        if ($mostrar) : ?>
            <p class="descripcion-pagina">Coloca tu nuevo password</p>
            <form class="formulario" method="POST">
                <div class="campo">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Tu Password" />
                </div>
                <div class="submit">
                    <input type="submit" value="Guardar Password" class="boton">
                </div>
            </form>
        <?php endif ?>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? Crea una</a>
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
        </div>
        <!--.contenedor-sm-->
    </div>

</div>