<?php
    require("../../conexion_mysql/conection-basedatos.php");

    // Código para registro
    $mensaje = '';

    
    if(!empty($_POST["NameType"]) && !empty($_POST["EmailType"]) && !empty($_POST["PassType"]) && !empty($_POST["AgeType"]) && !empty($_POST["GenderType"])){

        $repitname = $conexion->prepare("SELECT id_users, e_mail FROM usuarios_dreams WHERE  e_mail=:email");
        $repitname->bindParam(":email", $_POST["EmailType"]);
        $repitname->execute();
        $results1 = $repitname->fetch(PDO::FETCH_ASSOC);
        
        if(is_array($results1)){
            
            $mensaje = "Ya existe un usuario con ese correo electronico";

        }else{
            
            $sql = "INSERT INTO usuarios_dreams (name_user, e_mail, pasware, genero,age_users) VALUES (:nombre, :e_mail, :pasware, :sexo, :ege)";
            $stmt = $conexion->prepare($sql);

            $stmt ->bindParam(":nombre", $_POST["NameType"]);
            $stmt ->bindParam(":e_mail", $_POST["EmailType"]);
            $passware = password_hash($_POST["PassType"], PASSWORD_BCRYPT);

            $stmt -> bindParam(":pasware", $passware);
            $stmt ->bindParam(":sexo", $_POST["GenderType"]);
            $stmt -> bindParam(":ege", $_POST['AgeType']);


             if($_POST["PassType"] = $_POST['repitPasware']){
                
                 if($stmt->execute()){
                    
                     $mensaje = "En hora buena, se ha creado tu usuario Dreamer";

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
                        // $contenido = "
                        // <html>
                        // <head>
                        // <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                        //     <title></title>
                        //     <style type='text/css'>
                        //     * {
                        //         padding: 0;
                        //         margin: 0;
                        //         font-family: 'Century Gothic', 'CenturyGothic', 'AppleGothic', sans-serif ;
                        //         box-sizing: border-box;
                        //     }
                        //     header {
                        //         padding: 10px;
                        //         text-align: center;
                        //         background: #202020;
                        //         color: white;
                        //         font-size: 30px;
                        //         z-index: 50;
                        //     }
                        //     body {
                        //         width: 100%;
                        //         height: 100vh;
                        //         background: rgb(84, 28, 249);
                        //         background: linear-gradient(
                        //             180deg,
                        //             rgba(84, 28, 249, 1) 10%,
                        //             rgba(255, 94, 60, 1) 95%);
                
                
                        //     }
                        //     div {
                        //         color: #FFF;
                        //         position: absolute;
                        //         top: 50%;
                        //         left: 50%;
                        //         transform: translate(-50%, -50%);
                        //     }
                
                        //     h1 {
                        //         font-size: 3em;
                        //         text-align: center;
                        //     }
                        //     p {
                        //         font-size: 2.5em;
                        //     }
                
                        //     body::before {
                        //         width: 100%;
                        //         min-height: 100vh;
                        //         position: absolute;
                        //         top: 0;
                        //         left: 0;
                        //         background-image: url(https://drive.google.com/uc?export=view&id=16qCjQJL_7M43yRaQv5sWbMZKrBWgMEVF);
                        //         background-color: rgba(0, 0, 0, 0.651);
                        //         background-position: center;
                        //         background-size: contain;
                        //         background-repeat: no-repeat;
                        //         opacity: 0.5;
                        //     }
                
                        //     </style>
                
                        // </head>
                        // <body>
                        //     <header><img src='https://drive.google.com/uc?export=view&id=1qptBF8ulCIwmjk0r-rFpCfBtJ7MBN66o' alt='logotipo'></header>
                        //     <div id='email-wrap' >
                        //     <h1> $name Bienvenido a dreams!</h1><br>
                        //     <p>Disfruta de este nuevo espacio para nuevos artistas y tus canciones favoritas, mantente a la espera de futuras funciones...</p>
                
                        //     </div>
                        // </body>
                        // </html>";
                        // $headers = "";    
                        // $headers  = 'MIME-Version: 1.0' . "\r\n";
                        // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                        mail($email,"Te registraste en Dreams!",$contenido, "Bienvenid@ a Dreams 🎶");
                        header("Location:../../Inicio de sesión/Html/Inicio_Personal.php");
                
                        }

                    
                 }else{
                     $mensaje = "Parace que existe un error";
                 }
             }else{
                 $mensaje = "Las contraseñas deben de coincidir";
             }
    }

        // AVISO : Viejo las lineas que comente, fue por que en su momento me daban error y no me dejaban 
        // ejecutar el PHP, lo hice para corroborar que funcionara el envio de correos
        // https://www.youtube.com/watch?v=1uWV13gHwQc&t=29s <--- Link de la configuración de XAMPP

    }

    
 
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrate Ds!</title>
        <link rel="icon" href="../../Recursos/Iconos/Ds_logo.ico">
        <link rel="stylesheet" href="../Css/header.css">
        <link rel="stylesheet" href="../Css/forms.css">
        <link rel="stylesheet" href="../Css/botones.css">
        <link rel="stylesheet" href="../Css/footer.css">
    </head>
    <body>

         <!--header-------------------------->
         <header>
            <div class="back">
                <nav class="">
                    <a href="../../Pagina General/general_pagina/general.html">
                        <img src="../../Pagina General/Página-general-oficial/imagenes/white-logo.svg" alt="img" id="white-mod">
                        <img src="../../Pagina General/Página-general-oficial/imagenes/black-logo.svg" alt="img" id="black-mod">
                    </a>
                    
                    <ul class="navigation" data-animation="left-rigth">
                        <li>
                            <!--traduccion-------------------------->
                            <div id="google_translate_element_id" class="google"></div>
                               
                            <script type="text/javascript" src="../../Recursos/Otros/js/traductor.js"></script>
                       
                            <!------------------------------------->
                           </li>
                           <li><a href="../../Inicio de sesión/Html/Inicio_Personal.php">Iniciar Sesion</a></li>
                        <li><a href="../../About us/Html/Nosotros.html">Sobre Nosotros</a></li>
                    </ul>
                </nav>
            </div>
         </header>
         
         <!------------------------------------->

         <div class="mega-div-container">
            <img src="../../Recursos/Otros/Fondo-Registro.svg" id="background-imge-dreams">
    
        </div>
    
        <div class="mein-container">
            <div class="Logo">
                <image src="../Assets/images/Logo inicio de sesion.png" id="logo">
            </div>
            <div class="Introduction">
                <h1>Registrate para soñar!</h1>
                <br>
                <p>¿Hay música en el espacio exterior?</p>
            </div>
    
            <?php if(!empty($mensaje)): ?>
            <div class="respuesta">
                <p><?= $mensaje ?></p>
            </div>
            <?php endif; ?>
    
            <form id="personal-data" action="" method="post">
    
                <div id="datos_form">
                </div>
                <div class="datos">
                    <label for="NameType">¿Como te llamaremos?</label>
                    <br>
                    <input type="text" name="NameType" placeholder="Tu nombre de Usuario" class="nombre" id="NameType"
                        required>
                </div>
                <div class="datos">
                    <label for="EmailType">Tu correo eléctronico</label>
                    <br>
                    <input type="email" name="EmailType" placeholder="correo@example.com" class="nombre" id="EmailType" required>
                </div>
                
                <div class="datos">
                    <label for="PassType">Establece tu contraseña</label>
                    <br>
                    <input type="password" name="PassType" placeholder="Tu contraseña segura" class="nombre" id="PassType"
                        required>
                </div>
                <div class="datos">
                    <label for="PassType">Escribe de nuevo la contraseña</label>
                    <br>
                    <input type="password" name="repitPasware" placeholder="Tu contraseña segura" class="nombre" id="PassType"
                        required>
                </div>
                <div class="datos">
                    <label for="AgeType">¿Cuantos años tienes?</label>
                    <br>
                    <input type="number" name="AgeType" min="0" max="120" placeholder="0" id="AgeType" required>
                </div>
    
                <label for="GenderType">¿Cúal es tu género?</label>
                
                <div class="datos_button">
                    <input type="radio" name="GenderType" id="fem" value="Femenino">
                    <label for="fem" class="gender">Femenino</label>
                    <br>
                    <input type="radio" name="GenderType" id="masc" value="Masculino">
                    <label for="masc" class="gender">Masculino</label>
                    <br>
                </div>
                <hr>

            <div id="botones">                
                <a href="../../Inicio de sesión/Html/Inicio_Personal.php" class="lost-pass">¿Ya tienes una cuenta?</a>
                <br>
                <input type="submit" value="Registrarse" class="boton" name="enviar">
            </div>
    
            </form>
    
        </div>
    </body>
    <script>
        window.addEventListener("scroll", function(){
            const header = document.querySelector("nav");

            const logo_white = document.getElementById("white-mod");

            const logo_black = document.getElementById("black-mod")

            header.classList.toggle("sticky", window.scrollY > 0);

            logo_white.classList.add("remove", window.scrollY > 0);
            logo_black.classList.toggle("active", window.scrollY > 0);


        });
    </script>
</html>
