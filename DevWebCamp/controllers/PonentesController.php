<?php

namespace Controllers;

use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{
    public static function index(Router $router)
    {
        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Presentadores'
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];
        $ponente = new Ponente;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}
