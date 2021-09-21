<?php
    $conexion = mysqli_connect("ruta/servidor", "usuario/root", "clave", "base de datos");

    //Se reciben los campos//
    $nombre = $_POST["NameType"];
    $email = $_POST["EmailType"];
    $password = $_POST["PassType"];

    //Se recibe el archivo subido por el user//
    if ($_FILES("espacio_archivo"))   {
        //Se obtiene su nombre//
        $nombre_base = basename($_FILES["espacio_archivo"]["name"])
        //Se le agrega la fecha y hora//        
        $nombre_final = date("d-m-y")."-". date("H-i-s"). "-" $nombre_base;
        //Se especifica la ruta//
        $ruta = "archivos/" . $nombre_final;
        //Movemos el archivo a la ruta y nombre anterio//
        $subirarchivo = move_uploaded_file($_FILES["espacio_archivo"]["tmp_name"], $ruta);
            if($subirarchivo){
                //Si el archivo se movio del formulario a la carpeta insertamos los campos y la ruta//
                $insertarSQL = "INSERT INTO informes(nombre, apellidos, fecha, archivo) VALUES ('$NameType', '$EmailType', '$PassType', '$ruta')";
                //Insertamos la consulta//
                $resultado = mysqli_query($conexion, $insertarSQL);
                //Enviamos un mensaje de confimarcion//
                if($resultado){
                    echo "<script>alert('Usted se ha registrado con exito'); window.location='..//..//Inicio de sesión/Html/Inicio_Personal.html'</script>";
                } else {
                    print("Errormessage: %s\n", mysqli_error($conexion));
                }
            }
    } else {
        echo "Error al subir archivo";
    } 
        //Guardamos el archivo en una carpeta aparte, y en la base de datos guardamos su ruta, de modo que no se debe cargar todo de golpe y a la hora de mostrar el archivo tan solo imprimos la ruta//

        //https://youtu.be/5g0uqXIARFs//

    ?>
    
