<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Categoria;
use Model\RegistroPaquetes;

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
        if (!is_auth()) {
            header('Location: /login');
        }

        // Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION['id'];
        $registro = RegistroPaquetes::where('usuario_id', $usuario_id);

        if ($registro->paquete_id !== "1") {
            header('Location: /');
        }

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


        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $eventos_formateados
        ]);
    }
}
