<?php

namespace Controllers;

use Model\Paquete;
use Model\RegistroPaquetes;
use Model\Usuario;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        // Obtener ultimos registros
        $registros = RegistroPaquetes::get(5);
        foreach ($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        // Calcular los ingresos
        $virtuales = RegistroPaquetes::total('paquete_id', 2);
        $presenciales = RegistroPaquetes::total('paquete_id', 1);
        // Multiplicacion y suma restando ya comisiones
        $ingresos = ($virtuales * 46.05) + ($presenciales * 187.95);

        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración',
            'registros' => $registros,
            'ingresos' => $ingresos
        ]);
    }
}
