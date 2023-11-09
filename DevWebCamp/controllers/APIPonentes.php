<?php

namespace Controllers;

use Model\Ponente;

class APIPonentes
{
    public static function index()
    {
        $ponente = Ponente::all();
        echo json_encode($ponente);
    }

    public static function ponente()
    {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id || $id < 0) {
            echo json_encode([]);
            return;
        }

        $ponente = Ponente::find($id);
        echo json_encode($ponente, JSON_UNESCAPED_SLASHES);
    }
}
