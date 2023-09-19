<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'eb3bd9a4dd28c7';
        $mail->Password = '8737a40601ad73';

        // Atributos de dominio
        $mail->setFrom('cuentas@pelucos.com');
        $mail->addAddress('cuentas@pelucos.com', 'pelucos.com');
        $mail->Subject = 'Confirma tu cuenta';

        // Contenido en HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . ".</strong> Has creado tu cuenta en Pelucos, solo debes confirmarla presionando el siguiente enlace.</p> ";
        // $contenido .= "<p>Presion aquí: <a href='http:localhost:3000/confirmar-cuenta?token=" . $this->token . "'> Confirmar Cuenta </a></p>";
        $contenido .= "<p>Presion aquí: <a href='http:localhost:3000'> Confirmar Cuenta </a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar este correo</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }

    public function enviarInstruccion()
    {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'eb3bd9a4dd28c7';
        $mail->Password = '8737a40601ad73';

        // Atributos de dominio
        $mail->setFrom('cuentas@pelucos.com');
        $mail->addAddress('cuentas@pelucos.com', 'pelucos.com');
        $mail->Subject = 'Reestablece tu password';

        // Contenido en HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . ".</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p> ";
        $contenido .= "<p>Presion aquí: <a href='http:localhost:3000/recuperar?token=" . $this->token . "'> Reestablecer Password </a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar este correo</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }
}
