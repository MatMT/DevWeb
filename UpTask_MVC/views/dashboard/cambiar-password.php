<?php include_once __DIR__  . '/header-dashboard.php'; ?>

<!-- Contenedor principal -->
<div class="contenedor-sm">
    <!-- Alertas importadas -->
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver al perfil</a>

    <form method="POST" class="formulario" action="/cambiar-password">
        <div class="campo">
            <label for="password_actual">Password Actual</label>
            <input type="password" name="password_actual" placeholder="Tu Password Actual">
        </div>
        <div class="campo">
            <label for="password_nuevo">Password Nueva</label>
            <input type="password" name="password_nuevo" placeholder="Tu Password Nueva">
        </div>
        <input type="submit" value="Guardar cambios">
    </form>
</div>

<?php include_once __DIR__  . '/footer-dashboard.php'; ?>