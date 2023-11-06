<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{
    public static function index(Router $router)
    {
        // PAGINACIÓN =================================
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        // Validación de URL
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/ponentes?page=1');
        }

        $registros_por_pagina = 10;
        $total = Ponente::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/ponentes?page=1');
        }

        // PAGINACIÓN =================================

        if (!is_admin()) {
            header('Location: /login');
        }

        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Presentadores',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $ponente = new Ponente;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }

            // Leer imagen
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $dir_images = '../public/img/speakers';

                // Crear la carpeta si no existe
                if (!is_dir($dir_images)) {
                    mkdir($dir_images, 8755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])
                    ->fit(800, 800)
                    ->encode('png', 80);

                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])
                    ->fit(800, 800)
                    ->encode('webp', 80);

                // Retorna una cadena aleatoria
                $name_image = md5(uniqid(rand(), true));

                $_POST['imagen'] = $name_image;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            // Validar
            $alertas = $ponente->validar();

            // Guardar el registro
            if (empty($alertas)) {
                // Guardar las imagenes
                $imagen_png->save($dir_images . '/' . $name_image . ".png");
                $imagen_webp->save($dir_images . '/' . $name_image . ".webp");

                // Guardar en la base de datos
                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                } else {
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente
        ]);
    }

    public static function editar(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // Se redirecciona en caso de no ser válido
        if (!$id) {
            header('Location:/admin/ponentes');
        }

        // Obtener ponente a editar
        $ponente = Ponente::find($id);

        if ($ponente === null) {
            header('Location:/admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;
        $redes = json_decode($ponente->redes);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }

            if (!empty($_FILES['imagen']['tmp_name'])) {
                $dir_images = '../public/img/speakers';

                // Crear la carpeta si no existe
                if (!is_dir($dir_images)) {
                    mkdir($dir_images, 8755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])
                    ->fit(800, 800)
                    ->encode('png', 80);

                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])
                    ->fit(800, 800)
                    ->encode('webp', 80);

                // Retorna una cadena aleatoria
                $name_image = md5(uniqid(rand(), true));

                $_POST['imagen'] = $name_image;
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }


            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if (empty($alertas)) {
                if ($name_image) {
                    // Guardar las imagenes
                    $imagen_png->save($dir_images . '/' . $name_image . ".png");
                    $imagen_webp->save($dir_images . '/' . $name_image . ".webp");
                }

                // Guardar en la base de datos
                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes
        ]);
    }

    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }

            $id = $_POST['id'];
            $ponente = Ponente::find($id);

            if (!isset($ponente)) {
                header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if ($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}
