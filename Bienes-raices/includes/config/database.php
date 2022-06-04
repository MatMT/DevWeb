<?php

function conectarDB(): mysqli
{
    $db = mysqli_connect('localhost', 'root', '', 'bienes_raices');
    if (!$db) {
        echo "Error no se pudo conectar a la base de datos";
        exit;
    }

    return $db;
}
