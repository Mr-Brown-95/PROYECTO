<?php
include_once 'conexionBD.php';
$pdo = new Conexion();;

// Recepción de los datos enviados mediante POST desde el JS

$IdEmpRecibo = (isset($_POST['IdEmpRecibo'])) ? $_POST['IdEmpRecibo'] : '';
$fechaEntrada = (isset($_POST['fechaEntrada'])) ? $_POST['fechaEntrada'] : '';
$cantidadEntrada= (isset($_POST['cantidadEntrada'])) ? $_POST['cantidadEntrada'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1: //consulta

        $query2 = $pdo->prepare("SELECT id FROM producto");
        $query2->execute();
        $data = '<option value=0> Elige una opción' ;
        $list=$query2->fetchAll(PDO::FETCH_ASSOC);
        foreach($list as $dat){
            $data .= "<option value='$dat[id]'>$dat[id] ";
        }
        break;
    case 2: //modificación
        $query2 = $pdo->prepare("SELECT nombre,descripcion,categoria FROM producto WHERE id = '$id'");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://
        //, IdEmpRecibo = '$IdEmpRecibo'
        $query2 = $pdo->prepare("UPDATE producto SET fechaEntrada = '$fechaEntrada', cantidadEntrada = '$cantidadEntrada'WHERE id = '$id'");
        $query2->execute();

        $existencia =$pdo->prepare("SELECT existencia FROM producto WHERE id='$id'");
        $existencia->execute();
        $Stock=$existencia->fetchAll(PDO::FETCH_ASSOC);

        foreach ($Stock as $stock);
        $oldStock=$stock['existencia'];
        $newStock= $oldStock + $cantidadEntrada;

        $newExistencia = $pdo->prepare("UPDATE producto SET existencia = '$newStock' WHERE id = '$id'");
        $newExistencia->execute();

        $query2 = $pdo->prepare("SELECT * FROM producto");
        $query2->execute();
        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;