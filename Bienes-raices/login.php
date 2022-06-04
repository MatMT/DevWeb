<?php
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

// Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $pass = mysqli_real_escape_string($db, ($_POST['pass']));

    if (!$email) {
        $errores[] = "El email es obligatorio";
    }
    if (!$pass) {
        $errores[] = "El Password es obligatorio";
    }

    if (empty($errores)) {
        // Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);
            // Verificar  si el password es correcto o no
            $auth = password_verify($pass, $usuario['pass']);

            if ($auth) {
                // El usuario esta autenticado
                session_start();

                // Llenar el arreglo de la sesión 
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location: /admin');
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}

// Incluye el header
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>

    <?php endforeach ?>
    <br>
    <form method="POST" class="formulario" novalidate>
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

<?php
incluirTemplate('footer');
?>