<?php

namespace Model;

class Admin extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'pass'];

    // Atributos del modelo
    public $id;
    public $email;
    public $pass;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->pass = $args['pass'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'El Email es obligatorio';
        }
        if (!$this->pass) {
            self::$errores[] = 'El Password es obligatorio';
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        // Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'El Usuario no existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPass($resultado)
    {
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->pass, $usuario->pass);
        if (!$autenticado) {
            self::$errores[] = 'El Password es Incorrecto';
        }

        return $autenticado;
    }

    public function autenticar()
    {
        session_start();

        // Llenar el arreglo de sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}
