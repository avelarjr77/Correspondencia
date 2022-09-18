<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Instituciones</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Institución</button>
        <br>
        <!--LISTADO DE INSTITUCION-->
        <div class="card-box table-responsive"><br>
            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Institución</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $key) : ?>
                        <tr>
                            <td><?php echo $key->institucionId ?></td>
                            <td><?php echo $key->nombreInstitucion ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->institucionId ?>" data-nombre="<?php echo $key->nombreInstitucion ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->institucionId ?>" data-nombre="<?php echo $key->nombreInstitucion ?>"><i class="fa fa-trash"></i> Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO INSTITUCION-->

        <!-- Modal Agregar INSTITUCION-->
        <form action="<?php echo base_url() . '/crearInstitucion' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Institución</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre de la Institución</label>
                                <input type="text" id="nombreInstitucion" name="nombreInstitucion" required="required" autocomplete="off" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Agregar INSTITUCION-->

        <!-- Modal Edit Cargo-->
        <form action="<?php echo base_url() . '/actualizarInstitucion' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Institución</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre de la Institución</label>
                                <input type="text" id="nombreInstitucion" name="nombreInstitucion" autocomplete="off" required="required" class="form-control nombreInstitucion">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="institucionId" class="institucionId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit INSTITUCION-->

        <!-- Modal Delete INSTITUCION-->
        <form action="<?php echo base_url() . '/eliminarInstitucion' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Institución</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar la Institución: <b><i class="institucionN"></i></b> ?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="institucionId" class="institucionId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete INSTITUCION-->



    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal(':D', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal(':c', 'No se agrego', 'error');
    } else if (mensaje == '2') {
        swal(':D', 'Eliminado', 'success');
    } else if (mensaje == '3') {
        swal(':c', 'No se Elimino Registro', 'error');
    } else if (mensaje == '4') {
        swal(':D', 'Actualizado con exito', 'success');
    } else if (mensaje == '5') {
        swal(':c', 'No se actualizo', 'error');
    } else if (mensaje == '6') {
        swal({
            icon: "error",
            title: "¡Esta Institución no puede se eliminar!",
            text: "Lo sentimos, no se puede eliminar la Institución porque está siendo utilizado."
        });
    }
</script>

<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.institucionId').val(id);
            $('.nombreInstitucion').val(nombre);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.institucionId').val(id);
            $('.institucionN').html(nombre);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });

    });
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            language: {
                url: 'vendors/datatables.net/es.json'
            },
            "order": [[0, 0]],
            "ordering":true,
        });
    });
</script>

<?= $this->endSection() ?>