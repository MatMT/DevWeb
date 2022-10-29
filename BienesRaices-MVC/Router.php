<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas...
        $rutas_protegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar',
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        // Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // La URL existe y hay una función asociada
        if ($fn) {
            // Llamar una función cuando desconocemos su nombre
            call_user_func($fn, $this);
        } else {
            echo "Página no encontrada - 404";
        }
    }

    // Muestra una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            // Variable de variable
            $$key = $value;
        }

        ob_start(); // Almecene en memoria durante un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer
        include __DIR__ . "/views/layout.php";
    }
}
