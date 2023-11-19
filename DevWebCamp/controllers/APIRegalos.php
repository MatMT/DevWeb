<?php

namespace Controllers;

use Model\Regalo;
use Model\RegistroPaquetes;

class APIRegalos
{
    public static function index()
    {
        if (!is_admin()) {
            echo json_encode([]);
            return;
        }

        $regalos = Regalo::all();

        foreach ($regalos as $regalo) {
            $regalo->total = RegistroPaquetes::totalArray(
                [
                    'regalo_id'  => $regalo->id,
                    'paquete_id' => '1'
                ]
            );
        }

        echo json_encode($regalos);
        return;
    }
}
