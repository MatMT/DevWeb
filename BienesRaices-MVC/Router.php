<?php

namespace MVC;

class Router
{
    public function comprobarRutas()
    {
        $urlActual = $_SERVER['PATH_INFO'];

        debuggear($urlActual);
    }
}
