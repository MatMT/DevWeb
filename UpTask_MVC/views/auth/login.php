<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>
        <form action="/" class="formulario" method="POST">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email" />
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu Password" />
            </div>
            <div class="submit">
                <input type="submit" value="Iniciar Sesión" class="boton">
            </div>
        </form>
        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? Crea una</a>
            <a href="/olvide">¿Olvidaste tu Password?</a>
        </div>
        <!--.contenedor-sm-->
    </div>

</div>