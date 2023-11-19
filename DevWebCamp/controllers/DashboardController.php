<?php

namespace Controllers;

use Model\Evento;
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

        // Obtener eventos con más y menos lugares disponibles
        $minus_disp = Evento::ordenarLimite('disponibles', 'ASC', 5);
        $more_disp = Evento::ordenarLimite('disponibles', 'DESC', 5);

        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'minus_disp' => $minus_disp,
            'more_disp' => $more_disp
        ]);
    }
}
