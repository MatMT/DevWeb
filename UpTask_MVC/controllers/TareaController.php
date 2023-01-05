<?php

namespace Controllers;

class TareaController
{
    public static function index()
    {
    }

    public static function crear()
    {
        $array = [
            'respuesta' => true,
            'Nombre' => 'Matt'
        ];

        echo json_encode($_POST);
    }

    public static function update()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }

    public static function delete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
}
