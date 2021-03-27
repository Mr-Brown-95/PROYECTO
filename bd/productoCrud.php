<?php
include_once 'conexion.php';
$pdo = new Conexion();;

// Recepción de los datos enviados mediante POST desde el JS
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta
        $query2 = $pdo->prepare("INSERT INTO producto (nombre, descripcion, categoria)
 VALUES ('$nombre', '$descripcion', '$categoria') ");
        $query2->execute();

        $query2 = $pdo->prepare("SELECT * FROM producto");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación

        $query2 = $pdo->prepare("UPDATE producto SET nombre = '$nombre', descripcion = '$descripcion', 
                      categoria = '$categoria' WHERE id = '$id'");
        $query2->execute();

        $query2 = $pdo->prepare("SELECT * FROM producto");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $query2 = $pdo->prepare("DELETE FROM producto WHERE id='$id' ");
        $query2->execute();
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
