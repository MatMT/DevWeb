<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function crearObj()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'eb3bd9a4dd28c7';
        $phpmailer->Password = '8737a40601ad73';

        return $phpmailer;
    }

    public function enviarConfirm()
    {
        $phpmailer = $this->crearObj();

        // Nuestra config
        $phpmailer->setFrom('cuentas@uptask.com');
        $phpmailer->addAddress('cuentas@uptask.com', 'uptask.com');
        $phpmailer->Subject = 'Confirma tu Cuenta';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF8-8';

        $content = '<html>';
        $content .= "<p><strong>Hola " . $this->nombre . "</strong>. Has creado tu cuenta en UpTask, solo debes confirmarla en el siguiente enlace<p>";
        $content .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $content .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje.</p>";
        $content .= '</html>';

        $phpmailer->Body = $content;

        // Enviar el correo
        $phpmailer->send();
    }

    public function enviarInstruc()
    {
        $phpmailer = $this->crearObj();

        // Nuestra config
        $phpmailer->setFrom('cuentas@uptask.com');
        $phpmailer->addAddress('cuentas@uptask.com', 'uptask.com');
        $phpmailer->Subject = 'Reestablece tu Password';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF8-8';

        $content = '<html>';
        $content .= "<p><strong>Hola " . $this->nombre . "</strong>. Parece que has olvidado tu password, sigue el siguiente enlace para recuperarlo.<p>";
        $content .= "<p>Presiona aquí: <a href='http://localhost:3000/reestablecer?token=" . $this->token . "'>Reestablecer Password</a></p>";
        $content .= "<p>Si tu solicitaste reestablecer el password, puedes ignorar este mensaje.</p>";
        $content .= '</html>';

        $phpmailer->Body = $content;

        // Enviar el correo
        $phpmailer->send();
    }
}
