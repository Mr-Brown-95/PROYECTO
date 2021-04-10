<?php require_once "vistas/parte_superior.php"?>

    <!--INICIO del cont principal-->
    <div class="container">
        <h1>Ubicaciones</h1>



        <?php
        include_once 'bd/conexionBD.php';
        $pdo = new Conexion();
        $query2 =$pdo->prepare("SELECT * FROM ubicacion ");
        $query2->execute();
        $data=$query2->fetchAll(PDO::FETCH_ASSOC);
        ?>


        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevol" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaUbicacion" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Pasillo</th>
                                <th>Rack</th>
                                <th>Nivel</th>
                                <th>ID Empleado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($data as $dat) {
                                ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['pasillo'] ?></td>
                                    <td><?php echo $dat['rack'] ?></td>
                                    <td><?php echo $dat['nivel'] ?></td>
                                    <td><?php echo $dat['idEmpleado'] ?></td>
                                    <td></td>
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

        <!--Modal para CRUD-->
        <div class="modal fade" id="modalUbicacionCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formUbicacion">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="pasillo" class="col-form-label">Pasillo:</label>
                                <input type="text" class="form-control" id="pasillo">
                            </div>
                            <div class="form-group">
                                <label for="rack" class="col-form-label">Rack:</label>
                                <input type="text" class="form-control" id="rack">
                            </div>
                            <div class="form-group">
                                <label for="nivel" class="col-form-label">Nivel:</label>
                                <input type="text" class="form-control" id="nivel">
                            </div>
                            <div class="form-group">
                                <label for="idEmpleado" class="col-form-label">ID Empleado:</label>
                                <input type="number" class="form-control" id="idEmpleado">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
    <!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>