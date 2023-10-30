<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo; ?>
    </h2>
    <p class="auth_titulo">Coloca tu nuevo password</p>

    <?php
    require_once __DIR__ . '/../templates/alertas.php';

    if ($token_valido) {
    ?>
        <form method="POST" class="formulario">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Nuevo Password</label>
                <input type="password" class="formulario__input" placeholder="Tu nuevo password" id="password" name="password" />
            </div>

            <input type="submit" value="Guardar Password" class="formulario__submit">
        </form>
    <?php } ?>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia Sesión</a>

        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Obtener una</a>
    </div>
</main>