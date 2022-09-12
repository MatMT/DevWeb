<?php

namespace App;

class Propiedad
{
    // Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    // Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $imagen;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    // Definir la conexión a la BD
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar()
    {
        // Sanitizar 
        $atributos = $this->sanitizarAtributos();

        // Crear un nuevo string através de un arreglo
        // $string = join(', ', array_keys($atributos));

        // Insertar en la base de datos
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    // Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            // Iteración a ignorar
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    // Sanitizar los datos
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Subida de archivos
    public function setImage($imagen)
    {
        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Validaciones 
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = 'El titulo es obligatorio';
        }
        if (!$this->precio) {
            self::$errores[] = 'El precio es obligatorio';
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'La descripción debe tener al menos 50 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'El n° de las habitaciones es obligatorio';
        }
        if (!$this->wc) {
            self::$errores[] = 'El n° de los WC es obligatorio';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'El n° de los estacionamientos es obligatorio';
        }
        if (!$this->vendedorId) {
            self::$errores[] = 'Elige un vendedor';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;
    }
}
