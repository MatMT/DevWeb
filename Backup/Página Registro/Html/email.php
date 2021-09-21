<?php
    if (isset($_POST['enviar'])){
        $name = $_POST['NameType'];
        $email = $_POST['EmailType'];
        $age = $_POST['AgeType'];
        $gender = $_POST['GenderType'];
        $pass = $_POST['PassType'];
        $contenido = "";

        $contenido .= "¡Es un gusto que estes aquí " . $name . "!" . "\n\n" . "Para DreamStudios significas mucho más que un simple usuario extra" . "\n\n";
        $contenido .= "Nombre: " . $name . "\n" . "Edad: " . $age . "\n" . "Correo: " . $email . "\n" . "Contraseña: " . $pass . "\n\n";
        $contenido .= "";
        $contenido .= "
        <html>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <title></title>
            <style type='text/css'>
            * {
                padding: 0;
                margin: 0;
                font-family: 'Century Gothic', 'CenturyGothic', 'AppleGothic', sans-serif ;
                box-sizing: border-box;
            }
            header {
                padding: 10px;
                text-align: center;
                background: #202020;
                color: white;
                font-size: 30px;
                z-index: 50;
}
            body {
                width: 100%;
                height: 100vh;
                background: rgb(84, 28, 249);
                background: linear-gradient(
                    180deg,
                    rgba(84, 28, 249, 1) 10%,
                    rgba(255, 94, 60, 1) 95%);


            }
            div {
                color: #FFF;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            h1 {
                font-size: 3em;
                text-align: center;
            }
            p {
                font-size: 2.5em;
            }

            body::before {
                width: 100%;
                min-height: 100vh;
                position: absolute;
                top: 0;
                left: 0;
                background-image: url(https://drive.google.com/uc?export=view&id=16qCjQJL_7M43yRaQv5sWbMZKrBWgMEVF);
                background-color: rgba(0, 0, 0, 0.651);
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
                opacity: 0.5;
            }

            </style>

        </head>
        <body>
            <header><img src='https://drive.google.com/uc?export=view&id=1qptBF8ulCIwmjk0r-rFpCfBtJ7MBN66o' alt='logotipo'></header>
            <div id='email-wrap' >
            <h1> $name Bienvenido a dreams!</h1><br>
            <p>Disfruta de este nuevo espacio para nuevos artistas y tus canciones favoritas, mantente a la espera de futuras funciones...</p>

            </div>
        </body>
        </html>";

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        mail($email,"Te registraste en Dreams!",$contenido, "Bienvenid@ a Dreams 🎶");
        // header("Location:../../Inicio de sesión/Html/Inicio_Personal.php");

        }
?>
