<?php

namespace Controllers;

use MVC\Router;
use Classes\Paginacion;
use Model\Paquete;
use Model\RegistroPaquetes;
use Model\Usuario;

class RegistradosController
{
    public static function index(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        // PAGINACIÓN =================================
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        // Validación de URL
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }

        $registros_por_pagina = 20;
        $total = RegistroPaquetes::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/registrados?page=1');
        }

        $registros = RegistroPaquetes::paginar($registros_por_pagina, $paginacion->offset());

        // Cruzar información
        foreach ($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        // PAGINACIÓN =================================

        $router->render('admin/registrados/index', [
            'titulo' => 'Usuariso registrados',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
}
