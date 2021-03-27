<!DOCTYPE html>

<?php
 //include 'loginSecurity.php';
include_once 'conexion.php';
$pdo = new Conexion();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>CONSUVINO</title>
        <link rel="shortcut icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--bootstrap-->
        <link rel="stylesheet" href="css/bootstrap.css"><!-- Editado para el menu -->
        <!--jquery-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <!--bootstrap-js-->
        <script src="js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/1592869686.js" crossorigin="anonymous"></script>
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <!-- CUSTOM CSS -->
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <?php

        date_default_timezone_set("America/Mexico_City");

        if(isset($_POST['serieAlta']))//Valida si se envía el formulario
        {
            include_once 'serie.php';
            $serie = new serie();
            $serie->setNombreSerie($_POST['nombreSerie']);
            $serie->setSinopsis($_POST['sinopsis']);
            $serie->setActores($_POST['actores']);
            $serie->setFechaEstreno($_POST['fechaEstreno']);
            $serie->setUrl($_POST['url']);
            $serie->serieAlta();
        ?>
            <div class="container">
                <br>
                <center><a href="serieAlta.php" class="btn btn-default">Crear nuevo Registro</a>
                    <a href="index.php" class="btn btn-default">Salir</a></center>
            </div>
        <?php
        }
        elseif (isset($_POST['serieModificarGuardar']))//Valida si se envía el formulario
        {
        //print_r($_POST);
            include_once 'serie.php';
            $serie = new serie();
            $serie->setId($_POST['id']);
            $serie->setNombreSerie($_POST['nombreSerie']);
            $serie->setSinopsis($_POST['sinopsis']);
            $serie->setActores($_POST['actores']);
            $serie->setUrl($_POST['url']);
            $serie->setFechaEstreno($_POST['fechaEstreno']);
            $serie->serieModificarGuardar();

        ?>
            <div class="container">
                <br>
                <center><a href="serieConsulta.php?m=M" class="btn btn-default">Regresar</a>
                <a href="index.php" class="btn btn-default">Salir</a></center>
            </div>
        <?php
        } elseif (isset($_POST['usuarioAlta']))//Valida si se envía el formulario
        {
            $imagen='';
            if(isset($_FILES["foto"])){
                $file=$_FILES["foto"];
                $nombre=$file["name"];
                $tipo=$file["type"];
                $ruta_provisional=$file["tmp_name"];
                $size=$file["size"];
                $dimenciones=getimagesize($ruta_provisional);
                $carpeta="img/";

                if($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo !='image/jpeg' &&
                    $tipo != 'image/png' && $tipo != 'image/gif'){
                    //echo'Error, el archivo no es una imagen. Try again';
                    $_SESSION['message'] = 'Error, el archivo no es una imagen. Try again';
                    $_SESSION['message_type'] = 'danger';
                }elseif ($size > 3*1024*1024){
                    //echo'Error, el tamaño maximo es de  3MB. Try again';
                    $_SESSION['message'] = 'Error, el tamaño maximo es de  3MB. Try again';
                    $_SESSION['message_type'] = 'danger';
                }else{
                    $src=$carpeta.$nombre;
                    move_uploaded_file($ruta_provisional,$src);
                    $imagen="img/".$nombre;

                    include_once 'usuario.php';
                    $usuario = new usuario();
                    $usuario->setNombreUsuario($_POST['firstname']." ".$_POST['lastname']);
                    $usuario->setUsuario($_POST['usuario']);
                    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $usuario->setPassword($hashed_password);
                    $usuario->setFoto($imagen);
                    $usuario->setPrivilegios('General');
                    $usuario->usuarioAlta();
                }

            }
            ?>
            <script>location.href="login.php"</script>
            <?php
        }
        ?>
    </body>
</html>
