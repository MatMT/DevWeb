<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
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

    // Validar inicio de sesión
    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El Email del usuario es Obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        if (!$this->password) {
            self::$alertas['error'][] = "El Password no puede ir vacio";
        }

        return self::$alertas;
    }

    // Valida un email
    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }

        return self::$alertas;
    }

    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = "El Password no puede ir vacio";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "El Password debe contener al menos 6 caracteres";
        }
        return self::$alertas;
    }

    // Nuevos cambios de perfil
    public function validar_perfil()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = "El Nombre es Obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El Email es Obligatorio";
        }

        return self::$alertas;
    }

    // Cambio de contraseña
    public function nuevo_password(): array
    {
        if (!$this->password_actual) {
            self::$alertas['error'][] = "El Password Actual no puede ir vacio";
        }
        if (!$this->password_nuevo) {
            self::$alertas['error'][] = "El Password Nuevo tiene un error";
        }
        if (strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = "El Password no debe ser menor a 6 caracteres";
        }

        return self::$alertas;
    }

    // Comprobar funciones
    public function comprobar_password(): bool
    {
        return password_verify($this->password_actual, $this->password);
    }

    // Hashear el password
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token 
    public function crearToken(): void
    {
        $this->token = uniqid();
    }
}
