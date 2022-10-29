<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        // Función estatica de ActiveRecord
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        // Muestra de mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        // Enviamos variable por medio de un arreglo asociativo
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //** Crear una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar un nombre único 
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realiza un rezise a la imagen con intervetion
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImage($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();

            // Revisar que el arreglo de errores este vacio
            if (empty($errores)) {

                // Crear la carpeta para subir imagenes 
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guardar en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();
        $propiedad = Propiedad::find($id);

        // Método POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /* Crea una nueva instancia */
            $args = $_POST['propiedad'];

            $propiedad->sincro($args);

            // Validación
            $errores = $propiedad->validar();

            /* SUBIDA DE ARCHIVOS */
            // Generar un nombre único 
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImage($nombreImagen);
            }

            // Revisar que el arreglo de errores este vacio
            if (empty($errores)) {
                // Almacenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
