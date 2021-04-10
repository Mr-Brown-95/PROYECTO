<?php
include_once 'conexionBD.php';
$pdo = new Conexion();;

// Recepción de los datos enviados mediante POST desde el JS

$pasillo = (isset($_POST['pasillo'])) ? $_POST['pasillo'] : '';
$rack = (isset($_POST['rack'])) ? $_POST['rack'] : '';
$nivel = (isset($_POST['nivel'])) ? $_POST['nivel'] : '';
$idEmpleado = (isset($_POST['idEmpleado'])) ? $_POST['idEmpleado'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //alta

        $query2 = $pdo->prepare("INSERT INTO ubicacion (pasillo, rack, nivel, idEmpleado) 
        VALUES('$pasillo', '$rack', '$nivel', '$idEmpleado') ");
        $query2->execute();

        $query2 = $pdo->prepare("SELECT * FROM ubicacion ");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación

        $query2 = $pdo->prepare("UPDATE ubicacion SET pasillo='$pasillo', rack='$rack', nivel='$nivel', idEmpleado='$idEmpleado' WHERE id='$id' ");
        $query2->execute();

        $query2 = $pdo->prepare("SELECT * FROM ubicacion");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $query2 = $pdo->prepare("DELETE FROM ubicacion WHERE id='$id' ");
        $query2->execute();
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
