<?php 
    session_start();
    
    require("../../conexion_mysql/conection-basedatos.php");

    if(!empty($_POST['EmailType']) && !empty($_POST['password'])){
        
        $records = $conexion->prepare("SELECT id_users, e_mail, pasware FROM usuarios_dreams WHERE  e_mail=:email");
        $records->bindParam(":email", $_POST["EmailType"]);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        $message = "";
        

        if(is_array($results)){
            if(count($results) > 0 && password_verify($_POST['password'], $results["pasware"])){
               
                $_SESSION["id_user"] = $results["id_users"];

                $message = "Iniciaste sesión en Dreams!";
                header('Location: ./../../Página Principal/index/HomePage2.php');
                
            }else{

                $message = "Lo sentimos, usuario o contraseñas incorrectos";
            }
        }else{
            $message = "El usuario es incorrecto";
        }
        
        
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log in Ds!</title>
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
                        <li><a href="../../Página Registro/Html/Forms_Personal.php">Registrarse</a></li>
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
            <h1>Inicia Sesión para soñar!</h1>
            <br>
            <p>¿Hay música en el espacio exterior?</p>
        </div>
        <?php if(!empty($message)): ?>

            <div class="respuesta">
                <p><?= $message ?></p>
            </div>

        <?php endif; ?>
        <form id="personal-data" action="Inicio_Personal.php" method="post">

            <div id="datos_form">
            </div>
            <div class="datos">
                <label for="NameType">Tu correo electrónico</label>
                <br>
                <input type="email" name="EmailType"  placeholder="Tu nombre correo" class="nombre" id="NameType" required>
            </div>
            <div class="datos">
                <label for="EmailType">Tu contraseña</label>
                <br>
                <input type="password" name="password" placeholder="Tu contraseña"  class="nombre" id="EmailType" required>
            </div>
            <div id="botones">
                <a href="../../Página Registro/Html/Forms_Personal.php" class="lost-pass">¿No tienes una cuenta?</a>
            <!--Falta la funcionalidad del boton-->
                <input type="submit" value="Iniciar Sesión" class="boton">
            </div>
            <br><br><br>
        </form>
    </div>
    <!-- Agregado del footer 0-->
    <footer>

        <div class="box-footer">
            <div class="dreamStudios" bord="yes">
                <h3>Desarrollada por</h3>
                <h4>DreamStudios</h4>
            </div>
            <div class="contactanos" bord="yes">
                <h3>Contáctanos</h3>
                <h4>Tel: 7614-4883</h4>
                <h4>dreamstudiosv.net@gmail.com</h4>
            </div>
            <div class="follow">
                <h3>Siguenos</h3>
                <br>
                <img src="../../Pagina General/Página-general-Oficial/imagenes/white-logo.svg" alt="img" id="white-mod">
            </div>

        </div>
    </footer>
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

