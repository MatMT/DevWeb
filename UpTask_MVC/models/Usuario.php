<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '';
    }

    // Validación para cuentas nuevas
    public function validarCuentaNueva()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = "El Nombre del usuario es Obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El Email del usuario es Obligatorio";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "El Password no puede ir vacio";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "El Password debe contener al menos 6 caracteres";
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = "Los Password son diferentes";
        }
        return self::$alertas;
    }
}
