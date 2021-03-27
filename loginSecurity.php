<?php

//Comprueba que exista una sesion con los datos correctos, para asi acceder a la información

//Inicio la sesión
session_start();

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if ($_SESSION['valido'] != '1') {
    //si no existe, envio a la página de autentificacion
    header('Location: login.php');
    //además salgo de este script
    exit();
}
?>

