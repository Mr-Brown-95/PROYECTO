<?php
include_once 'conexionBD.php';
$pdo = new Conexion();;

// Recepción de los datos enviados mediante POST desde el JS

$IdEmpSurte = (isset($_POST['IdEmpSurte'])) ? $_POST['IdEmpSurte'] : '';
$fechaSalida = (isset($_POST['fechaSalida'])) ? $_POST['fechaSalida'] : '';
$cantidadSalida= (isset($_POST['cantidadSalida'])) ? $_POST['cantidadSalida'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //consulta

        $query2 = $pdo->prepare("SELECT id FROM producto");
        $query2->execute();
        $data = '<option value=0> Elige una opción' ;// <option  value=0>Elige una opción</option>
        $list=$query2->fetchAll(PDO::FETCH_ASSOC);
        foreach($list as $dat){
            $data .= "<option value='$dat[id]'>$dat[id] ";
        }
        break;
    case 2: //consulta2
        $query2 = $pdo->prepare("SELECT nombre,descripcion,categoria FROM producto WHERE id = '$id'");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://
        //, IdEmpSurte = 'IdEmpSurte'
        $query2 = $pdo->prepare("UPDATE producto SET fechaSalida = '$fechaSalida', cantidadSalida = '$cantidadSalida'WHERE id = '$id'");
        $query2->execute();

        $query2 = $pdo->prepare("SELECT * FROM producto");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;