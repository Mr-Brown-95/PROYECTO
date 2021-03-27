<?php require_once "vistas/parte_superior.php"?>

    <!--INICIO del cont principal-->
    <div class="container">
        <h1>Inventario</h1>



        <?php
        include_once 'bd/conexion.php';
        $pdo = new Conexion();
        $query2 =$pdo->prepare("SELECT id, nombre, descripcion, categoria, existencia FROM producto");
        $query2->execute();
        $data=$query2->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaInventario" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Existencia</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($data as $dat) {
                                ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['nombre'] ?></td>
                                    <td><?php echo $dat['descripcion'] ?></td>
                                    <td><?php echo $dat['categoria'] ?></td>
                                    <td><?php echo $dat['existencia'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>