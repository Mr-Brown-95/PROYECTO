<?php require_once "vistas/parte_superior.php"?>
<?php
include_once 'bd/conexionBD.php';
$pdo = new Conexion();
$producto =$pdo->prepare("SELECT COUNT(existencia) from producto");
$producto->execute();
$productoExistencia=$producto->fetchAll(PDO::FETCH_ASSOC);
foreach ($productoExistencia as $cant);

$inventario =$pdo->prepare("SELECT SUM(existencia) FROM producto");
$inventario->execute();
$Stock=$inventario->fetchAll(PDO::FETCH_ASSOC);
foreach ($Stock as $stock);

$cantidadEntrada =$pdo->prepare("SELECT SUM(cantidadEntrada) FROM producto");
$cantidadEntrada->execute();
$Recibo=$cantidadEntrada->fetchAll(PDO::FETCH_ASSOC);
foreach ($Recibo as $recibo);

$cantidadSalida =$pdo->prepare("SELECT SUM(cantidadSalida) FROM producto");
$cantidadSalida->execute();
$Embarque=$cantidadSalida->fetchAll(PDO::FETCH_ASSOC);
foreach ($Embarque as $embarque);

$cantidadUsuarios =$pdo->prepare("SELECT COUNT(*) FROM usuario where activo=1");
$cantidadUsuarios->execute();
$Usuarios=$cantidadUsuarios->fetchAll(PDO::FETCH_ASSOC);
foreach ($Usuarios as $usuario);
    ?>

    <div class="container-fluid">
        <h1>Bienvenido</h1>
        <br>
        <div class="panel panel-container">
            <div class="row">
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-teal panel-widget border-right" >
                        <div class="row no-padding"><em class="fa fa-xl fa-pallet color-blue"></em>
                            <div class="large"><?php echo $stock['SUM(existencia)'] ?></div>
                            <div class="text-muted">Inventario</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-blue panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-pallet color-orange"></em>
                            <div class="large"><?php echo $cant['COUNT(existencia)'] ?></div>
                            <div class="text-muted">Productos</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-red panel-widget ">
                        <div class="row no-padding"><em class="fa fa-xl fa-pallet color-teal"></em>
                            <div class="large"><?php echo $recibo['SUM(cantidadEntrada)'] ?></div>
                            <div class="text-muted">Recibo</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-red panel-widget ">
                        <div class="row no-padding"><em class="fa fa-xl fa-pallet color-red"></em>
                            <div class="large"><?php echo $embarque['SUM(cantidadSalida)'] ?></div>
                            <div class="text-muted">Embarque</div>
                        </div>
                    </div>
                </div>

            </div><!--/.row-->
        </div>
        <br>
        <div class="row" >
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-orange panel-widget border-right" >
                    <div class="row no-padding"><em class="fa fa-xl fa-users color-gray" ></em>
                        <div class="large"><?php echo $usuario['COUNT(*)'] ?></div>
                        <div class="text-muted">Usuarios</div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

    </div>
    <!-- /.container-fluid -->

<?php require_once "vistas/parte_inferior.php"?>