<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Regalo;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Categoria;
use Model\EventoRegistro;
use Model\RegistroPaquetes;

class RegistroController
{

    public static function index(Router $router)
    {
        if (!is_auth()) {
            header('Location: /');
            return;
        }

        // Verificar si el usuario ya esta registrado
        $registro = RegistroPaquetes::where('usuario_id', $_SESSION['id']);

        if (isset($registro) && ($registro->paquete_id === "3" || $registro->paquete_id === "2")) {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        if (isset($registro) && $registro->paquete_id === "1") {
            header('Location: /finalizar-registro/conferencias');
            return;
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function storeFree()
    {
        if (!is_auth()) {
            header('Location: /login');
            return;
        }

        $token = substr(md5(uniqid(rand(), true)), 0, 8);

        // Verificar si el usuario ya esta registrado
        $registro = RegistroPaquetes::where('usuario_id', $_SESSION['id']);
        if (isset($registro) && $registro->paquete_id === "3") {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
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
            return;
        }
    }

    public static function storePay()
    {
        if (!is_auth()) {
            header('Location: /login');
            return;
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
            return;
        }

        // Buscar en la DB
        $registro = RegistroPaquetes::where('token', $id);

        if (!$registro) {
            header('Location: /');
            return;
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
            return;
        }

        // Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION['id'];
        $registro = RegistroPaquetes::where('usuario_id', $usuario_id);

        // Aqui validas si el registro se ha completado o no
        $registroFinalizado = EventoRegistro::where('registro_id', $registro->id);

        if (isset($registro) && $registro->paquete_id === "2") {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        // Aqui validas si el registro se ha completado o no
        if (isset($registroFinalizado)) {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }


        if ($registro->paquete_id !== "1") {
            header('Location: /');
            return;
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

        $regalos = Regalo::all('ASC');

        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    }

    public static function storeConference()
    {
        // Revisar que el usuario  este autenticado
        if (!is_auth()) {
            header('Location: /login');
            return;
        }

        // Separar elementos del array
        $eventos = explode(',', $_POST['eventos']);

        // Validar que no este vacío
        if (empty($eventos)) {
            echo json_encode(['resultado' => false]);
            return;
        }

        // Obtener el registro del usuario y validar su paquete
        $registro = RegistroPaquetes::where('usuario_id', $_SESSION['id']);

        // Si no encontro el registro o si la selección es diferente
        if (!isset($registro) || $registro->paquete_id !== "1") {
            echo json_encode(['resultado' => false]);
            return;
        }

        $eventos_array = [];
        // Válidar la disponibilidad de los eventos seleccionados
        foreach ($eventos as $evento_id) {
            $evento = Evento::find($evento_id);

            // Comprobar que el evento exista o este disponible
            if (!isset($evento) || $evento->disponibles === "0") {
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array[] = $evento;
        }

        // Sustraer el registro tras la validación
        foreach ($eventos_array as $evento) {
            // Restar el cupo al evento
            $evento->disponibles -= 1;
            $evento->guardar();

            // Almacenar el registro
            $datos = [
                'evento_id' => (int) $evento->id,
                'registro_id' => (int)  $registro->id
            ];

            $registro_usuario = new EventoRegistro($datos);
            $registro_usuario->guardar();
        }

        // Almacenar el regalo
        $registro->sincronizar(['regalo_id' => $_POST['regalo_id']]);
        $resultado = $registro->guardar();

        if ($resultado) {
            echo json_encode([
                'resultado' => $resultado,
                'token' => $registro->token
            ]);
        } else {
            echo json_encode(['resultado' => false]);
        }
    }
}
