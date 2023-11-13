<?php

namespace Controllers;

use Model\Paquete;
use MVC\Router;
use Model\RegistroPaquetes;
use Model\Usuario;

class RegistroController
{

    public static function index(Router $router)
    {

        if (!is_auth()) {
            header('Location: /');
        }

        // Verificar si el usuario ya esta registrado
        $registro = RegistroPaquetes::where('usuario_id', $_SESSION['id']);
        if (isset($registro) && $registro->paquete_id === "3") {
            header('Location: /boleto?id=' . urlencode($registro->token));
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function storeFree()
    {
        if (!is_auth()) {
            header('Location: /login');
        }

        $token = substr(md5(uniqid(rand(), true)), 0, 8);

        // Verificar si el usuario ya esta registrado
        $registro = RegistroPaquetes::where('usuario_id', $_SESSION['id']);
        if (isset($registro) && $registro->paquete_id === "3") {
            header('Location: /boleto?id=' . urlencode($registro->token));
        }

        //Crear registro
        $datos = array(
            'paquete_id' => 3,
            'pago_id' => '',
            'token' => $token,
            'usuario_id' => $_SESSION['id']
        );

        $registro = new RegistroPaquetes($datos);
        $resultado = $registro->guardar();

        if ($resultado) {
            header('Location: /boleto?id=' . urlencode($registro->token));
        }
    }

    public static function storePay()
    {
        if (!is_auth()) {
            header('Location: /login');
        }

        // Validar que POST no venga vacío
        if (empty($_POST)) {
            echo json_encode([]);
            return;
        }

        // Registro Correcto Paypal
        $datos = $_POST;
        $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
        $datos['usuario_id'] = $_SESSION['id'];

        try {
            $registro = new RegistroPaquetes($datos);
            $resultado = $registro->guardar();
            echo json_encode($resultado);
        } catch (\Throwable $th) {
            echo json_encode([
                'resultado' => 'error'
            ]);
        }
    }

    public static function boleto(Router $router)
    {
        // Variable de la URL
        $id = $_GET['id'];


        if (!$id || !strlen($id) === 8) {
            header('Location: /');
        }

        // Buscar en la DB
        $registro = RegistroPaquetes::where('token', $id);

        if (!$registro) {
            header('Location: /');
        }

        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);

        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }

    public static function conferencias(Router $router)
    {
        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
        ]);
    }
}
