<?php

declare(strict_types=1);
include 'includes/header.php';



function usuarioAtenticado(bool $autenticado): ?string
{
    if ($autenticado) {
        return "El usuario esta autenticado";
    } else {
        return null;
    }
}

$usuario = usuarioAtenticado(true);

echo $usuario;

include 'includes/footer.php';
