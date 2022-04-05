<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email{

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

        // Lo siguiente lo copio desde la pagina web de mailtrap.io
        $mail->isSMTP(); // Protocolo del envio de emails.       
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '3da1bb271badcb';
        $mail->Password = '837263d6fc53b0';

        $mail->setFrom('cuentas@appsalon.com'); // Aqui es quien envia el email. Es el dominio, el correo que nos dan.
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com'); // Esto es del dominio.
        $mail->Subject = 'Confirma tu Cuenta';

        $mail->isHTML(TRUE); // Le decimos que vamos a usar HTML
        $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong> Hola, " . $this->nombre . "</strong>. Has creado tu cuenta en App Salon, solo debes confirmarla
            presionando el siguiente enlace: </p>";
            $contenido .= "<p>Presiona aquí: <a href = 'http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirmar Cuenta!</a></p>";
            $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
            $contenido .= "</html>";

        $mail->Body = $contenido;


        //Enviamos el email:
        $mail->send();

    }

    public function enviarInstrucciones()
    {
         // Crear el objeto de email
         $mail = new PHPMailer();

         // Lo siguiente lo copio desde la pagina web de mailtrap.io
         $mail->isSMTP(); // Protocolo del envio de emails.       
         $mail->Host = 'smtp.mailtrap.io';
         $mail->SMTPAuth = true;
         $mail->Port = 2525;
         $mail->Username = '3da1bb271badcb';
         $mail->Password = '837263d6fc53b0';
 
         $mail->setFrom('cuentas@appsalon.com'); // Aqui es quien envia el email. Es el dominio, el correo que nos dan.
         $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com'); // Esto es del dominio.
         $mail->Subject = 'Reestablece tu Password';
 
         $mail->isHTML(TRUE); // Le decimos que vamos a usar HTML
         $mail->CharSet = 'UTF-8';
 
             $contenido = "<html>";
             $contenido .= "<p><strong> Hola, " . $this->nombre . "</strong>. Has solicitado reestablecer tu password. Sigue el siguiente enlace para hacerlo. </p>";
             $contenido .= "<p>Presiona aquí: <a href = 'http://localhost:3000/recuperar?token=".$this->token."'>Reestablecer Password!</a></p>";
             $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
             $contenido .= "</html>";
 
         $mail->Body = $contenido;
 
 
         //Enviamos el email:
         $mail->send();
    }
}


?>