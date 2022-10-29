<h1>Login</h1>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>

    <?php endforeach ?>
    <br>
    <form method="POST" class="formulario" action="/login" novalidate>
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email" required></input>

            <label for="pass">Password</label>
            <input type="password" name="pass" placeholder="Tu Contraseña" id="password" required></input>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton-verde">
    </form>
</main>