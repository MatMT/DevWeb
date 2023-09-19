<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];

        $auth = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                // Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    // Verificar password
                    if ($usuario->ComprobarPassAndVerificado($auth->password)) {
                        if (!isset($_SESSION)) {
                            session_start();
                        };

                        // Almacenando en la sesion global activa
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamiento
                        if ($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('/auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === "1") {
                    // Generar un token nuevo
                    $usuario->crearToken();
                    $usuario->guardar();

                    // Alerta de exito
                    Usuario::setAlerta('exito', 'Revisa tu Email');

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstruccion();
                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta verificado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('/auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        // Buscar usuario por su token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario) || $token === "") {
            Usuario::setAlerta('error', 'Token No Válido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Reescribir con el nuevo password
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if (empty($alertas)) {
                // Eliminamos antiguos campos
                $usuario->password = null;
                $usuario->token = null;

                // Asignamos nuevos datos
                $usuario->password = $password->password;
                $usuario->hashPassword();

                // Guardarmos en la BD
                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario($_POST);
        // Alertas vacias
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // Revisar que las alertas esten vacias
            if (empty($alertas)) {
                // Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Generar un token único
                    $usuario->crearToken();

                    // Enviar el email
                    $email = new Email(
                        $usuario->email,
                        $usuario->nombre,
                        $usuario->token
                    );
                    $email->enviarConfirmacion();

                    // Crear el usuario
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('/auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('/auth/mensaje', []);
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];

        $token = s($_GET['token']);
        $usuario =  Usuario::where('token', $token);

        if (empty($usuario) || $usuario->token === '') {
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no válido');
        } else {
            // Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = '';
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta confirmada exitosamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
