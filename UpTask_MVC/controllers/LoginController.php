<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Inciar Sesión'
        ]);
    }

    public static function logout()
    {
        echo "Desde Login";
    }

    public static function crear(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        // Render a la vista
        $router->render('auth/registrar', [
            'titulo' => 'Crea tu cuenta'
        ]);
    }

    public static function olvide(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        // Render a la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi password'
        ]);
    }

    public static function reestablecer(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        // Render a la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password'
        ]);
    }

    public static function mensaje(Router $router)
    {
        // Render a la vista
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router)
    {
        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta UpTask'
        ]);
    }
}
