<?php

namespace Controllers;

use MVC\Router;

class RegistradosController
{
    public static function index(Router $router)
    {
        $router->render('admin/registrados/index', [
            'titulo' => 'Usuariso registrados'
        ]);
    }
}
