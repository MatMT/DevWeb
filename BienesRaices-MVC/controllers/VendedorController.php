<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor;
        // Variable de errores
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //** Crear una nueva instancia */
            $vendedor = new Vendedor($_POST['vendedor']);

            // Validar
            $errores = $vendedor->validar();

            // Revisar que el arreglo de errores este vacio
            if (empty($errores)) {
                // Guardar en la base de datos
                $vendedor->guardar();
            }
        }

        // Renderizado de vista y variables
        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $errores = Vendedor::getErrores();
        $vendedor = Vendedor::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['vendedor'];

            // Sincronizar objeto en memoria con los nuevos datos
            $vendedor->sincro($args);

            // Validación
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
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
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
