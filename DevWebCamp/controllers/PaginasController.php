<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;
use Model\Usuario;

class PaginasController
{
    public static function index(Router $router)
    {
        // Obtener según categoría
        $eventos = Evento::ordenar('hora_id', 'ASC');
        $eventos_formateados = [];

        foreach ($eventos as $evento) {
            // Relacionar Id's con modelos
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if ($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_d'][] = $evento;
            }

            if ($evento->dia_id === "1" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_d'][] = $evento;
            }
        }

        // Obtener el total de cada bloque
        $ponentes_total = Ponente::total();
        $conferencias_total = Evento::total('categoria_id', 1);
        $workshops_total = Evento::total('categoria_id', 2);
        $usuarios_total = Usuario::total();

        // Obtener todo los ponentes
        $ponentes = Ponente::all();


        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $eventos_formateados,
            'ponentes_total' => $ponentes_total,
            'ponentes' => $ponentes,
            'conferencias_total' => $conferencias_total,
            'workshops_total' => $workshops_total,
            'usuarios_total' => $usuarios_total
        ]);
    }

    public static function evento(Router $router)
    {
        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router)
    {

        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferencias(Router $router)
    {
        // Obtener según categoría
        $eventos = Evento::ordenar('hora_id', 'ASC');
        $eventos_formateados = [];

        foreach ($eventos as $evento) {
            // Relacionar Id's con modelos
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if ($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_d'][] = $evento;
            }

            if ($evento->dia_id === "1" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_d'][] = $evento;
            }
        }

        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & WorkShops',
            'eventos' => $eventos_formateados
        ]);
    }

    public static function Page404(Router $router)
    {

        $router->render('paginas/page404', [
            'titulo' => 'Página no encontrada'
        ]);
    }
}
