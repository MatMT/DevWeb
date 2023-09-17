<?php include_once __DIR__  . '/header-dashboard.php'; ?>

<!-- Contenedor principal -->
<div class="contenedor-sm">
    <!-- Alertas importadas -->
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/cambiar-password" class="enlace">Cambiar Password</a>

    <form method="POST" class="formulario" action="/perfil">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $usuario->nombre ?>" placeholder="Tu nombre">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $usuario->email ?>" placeholder="Tu email">
        </div>
        <input type="submit" value="Guardar cambios">
    </form>
</div>

<?php include_once __DIR__  . '/footer-dashboard.php'; ?>