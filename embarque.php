<?php require_once "vistas/parte_superior.php"?>

    <!--INICIO del cont principal-->
    <div class="container">
        <h1>Embarque</h1>



        <?php
        include_once 'bd/conexionBD.php';
        $pdo = new Conexion();
        $query2 =$pdo->prepare("SELECT * FROM producto");
        $query2->execute();
        $data=$query2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevoE" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaEmbarque" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Cantidad de surtido</th>
                                <th>Fecha de surtido</th>
                                <th>Id de empleado de surtido</th>
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
                                    <td><?php echo $dat['cantidadSalida'] ?></td>
                                    <td><?php echo $dat['fechaSalida'] ?></td>
                                    <td><?php echo $dat['IdEmpSurte'] ?></td>
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

        <!--Modal para CRUD Recibo-->
        <div class="modal fade" id="modalEmbarqueCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEmbarque">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="idE" class="col-form-label">ID producto:</label>
                                <select id="idE" name="idE" class="form-control"> </select>
                            </div>
                            <div class="form-group">
                                <label for="nombreE" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombreE" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="descripcionE" class="col-form-label">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcionE" readonly="readonly" >
                            </div>
                            <div class="form-group">
                                <label for="categoriaE" class="col-form-label">Categoria:</label>
                                <input type="text" class="form-control" id="categoriaE" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="cantidadSalida" class="col-form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidadSalida">
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