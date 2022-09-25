<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- Formulario para agregar modulos -->
<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Módulos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Módulo</button>
    <br>
    <!--LISTADO DE modulos-->
    <div class="x_content">
        <div class="card-box table-responsive"><br>
            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Modulo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $modulo) : ?>
                        <tr>
                            <td><?= $modulo->moduloId ?></td>
                            <td><?= $modulo->nombre ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $modulo->moduloId ?>" data-nombremod="<?= $modulo->nombre ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $modulo->moduloId ?>" data-nombremod="<?= $modulo->nombre ?>"><i class="fa fa-trash"></i> Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <!--FIN LISTADO ROLES-->

    <!-- Modal Agregar Módulo-->
    <form action="<?php echo base_url() . '/crearModulo' ?>" method="POST">
        <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Módulo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nombre del Módulo</label>
                            <input type="text" id="nombre" name="nombre" required="required" minlength="3" maxlength="75" autocomplete="off" class="form-control">
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
    <!-- End Modal Agregar Módulo-->

    <!-- Modal Edit Módulo-->
    <form action="<?php echo base_url() . '/actualizarModulo' ?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Módulo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nombre del Módulo</label>
                            <input type="text" id="nombre" name="nombre" autocomplete="off" required="required" minlength="3" maxlength="75" class="form-control nombre">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="moduloId" class="moduloId">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Módulo-->

    <!-- Modal Delete Módulo-->
    <form action="<?php echo base_url() . '/eliminarModulo' ?>" method="POST">
        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Módulo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>¿Esta seguro que desea eliminar el módulo: <b><i class="modulo"></i></b> ?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="moduloId" class="moduloId">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">SI</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Módulo-->
</div>
<!-- End Formulario para agregar ROLES -->

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Módulo agregado', 'success');
    } else if (mensaje == '1') {
        swal('', 'Datos incorrectos', 'error');
    } else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    } else if (mensaje == '3') {
        swal('', 'No se Elimino Registro', 'error');
    } else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    } else if (mensaje == '5') {
        swal('No se actualizo', 'Datos incorrectos', 'error');
    } else if (mensaje == '6') {
        swal('', 'El campo nombre de modulo posee numeros', 'error');
    } else if (mensaje == '7') {
        swal({
            icon: "error",
            title: "¡Este Módulo no puede ser eliminado!", 
            text: "Lo sentimos, no se puede eliminar el Módulo porque está siendo utilizado por un Módulo/Menú."
        });
    }
</script>

<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombremod = $(this).data('nombremod');

            // Set data to Form Edit
            $('.moduloId').val(id);
            $('.nombre').val(nombremod);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombremod = $(this).data('nombremod');
            // Set data to Form Edit
            $('.moduloId').val(id);
            $('.modulo').html(nombremod);
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
            "order": [[0, 'asc']],
        });
    });
</script>

<?= $this->endSection() ?>