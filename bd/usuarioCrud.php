<?php
include_once 'conexion.php';
$pdo = new Conexion();;

// Recepción de los datos enviados mediante POST desde el JS

$nombreUsuario = (isset($_POST['nombreUsuario'])) ? $_POST['nombreUsuario'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$privilegios = (isset($_POST['privilegios'])) ? $_POST['privilegios'] : '';
$activo = (isset($_POST['activo'])) ? $_POST['activo'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $foto = '';
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query2 = $pdo->prepare("INSERT INTO usuario (nombreUsuario, usuario, password, foto, privilegios,activo) 
        VALUES('$nombreUsuario', '$usuario', '$hashed_password','$foto', '$privilegios', '$activo') ");
        $query2->execute();

        $query2 = $pdo->prepare("SELECT * FROM usuario WHERE activo =1");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
       // $nombreUsuario =($_POST['firstname']." ".$_POST['lastname']);
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query2 = $pdo->prepare("UPDATE usuario SET nombreUsuario='$nombreUsuario', usuario='$usuario', password='$hashed_password', privilegios='$privilegios', activo='$activo' 
WHERE id='$id' ");
        $query2->execute();

        $query2 = $pdo->prepare("SELECT * FROM usuario WHERE activo =1");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $query2 = $pdo->prepare("UPDATE usuario SET activo = 0 WHERE id='$id' ");
        $query2->execute();
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
