<?php require_once "vistas/parte_superior.php"?>

    <!--INICIO del cont principal-->
    <div class="container">
        <h1>Producto</h1>



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
                    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaProducto" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Acciones</th>
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

        <!--Modal para CRUD Editar-->
        <div class="modal fade" id="modalProductoCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formProducto">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="col-form-label">descripcion:</label>
                                <input type="text" class="form-control" id="descripcion">
                            </div>
                            <div class="form-group">
                                <label for="categoria" class="col-form-label">Categoria:</label>
                                <input type="text" class="form-control" id="categoria">
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

        <!--Modal para CRUD Recibo
        <div class="modal fade" id="modalReciboCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formRecibo">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Rdescripcion" class="col-form-label">Descripcion:</label>
                                <input type="text" class="form-control" id="Rdescripcion">
                            </div>
                            <div class="form-group">
                                <label for="Rmultiplo" class="col-form-label">Multiplo:</label>
                                <input type="text" class="form-control" id="Rmultiplo">
                            </div>
                            <div class="form-group">
                                <label for="Rsector" class="col-form-label">Sector:</label>
                                <input type="text" class="form-control" id="Rsector">
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

        -->

    </div>
    <!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>