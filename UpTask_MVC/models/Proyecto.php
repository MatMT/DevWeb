<?php

namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord
{
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'proyecto', 'url', 'propietarioId'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->proyecto = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
    }

    public function validarProyecto()
    {
        // Eliminar espacios en blanco
        $this->proyecto = trim($this->proyecto);

        if (!$this->proyecto) {
            self::$alertas['error'][] = 'El nombre del Proyecto es Obligatorio';
        }

        return self::$alertas;
    }
}
