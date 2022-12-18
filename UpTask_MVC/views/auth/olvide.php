<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <p class="descripcion-pagina">Recupera tu acceso a UpTask</p>

        <form action="/olvide" class="formulario" method="POST" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email" />
            </div>
            <div class="submit">
                <input type="submit" value="Enviar Instrucciones" class="boton">
            </div>
        </form>
        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? Crea una</a>
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
        </div>
        <!--.contenedor-sm-->
    </div>

</div>