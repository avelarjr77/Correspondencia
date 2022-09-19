<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Tipo de Contactos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Tipo Contacto</button>
        <br>
        <!--LISTADO DE TIPOCONTACTO-->
        <div class="card-box table-responsive">
            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo Contacto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tipoContacto as $key) : ?>
                        <tr>
                            <td><?php echo $key->tipoContactoId ?></td>
                            <td><?php echo $key->tipoContacto ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->tipoContactoId ?>" data-nombre="<?php echo $key->tipoContacto ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->tipoContactoId ?>" data-nombre="<?php echo $key->tipoContacto ?>"><i class="fa fa-trash"></i> Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO TIPOCONTACTO-->

        <!-- Modal Agregar TIPOCONTACTO-->
        <form action="<?php echo base_url() . '/crearTipoContacto' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar tipo de contacto.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Tipo de contacto:</label>
                                <input type="text" id="tipoContacto" name="tipoContacto" required="required" minlength="3" maxlength="20" autocomplete="off" class="form-control">
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
        <!-- End Modal Agregar TIPOCONTACTO-->

        <!-- Modal Edit TIPOCONTACTO-->
        <form action="<?php echo base_url() . '/actualizarTipoContacto' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Tipo Contacto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Tipo Contacto</label>
                                <input id="tipoContacto" name="tipoContacto" required="required" minlength="3" maxlength="20" autocomplete="off" class="form-control tipocontacto">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="tipoContactoId" class="tipoContactoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit TIPOCONTACTO-->

        <!-- Modal Delete TIPOCONTACTO-->
        <form action="<?php echo base_url() . '/eliminarTipoContacto' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Tipo Contacto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar el Tipo de contacto: <b><i class="contactoN"></i></b> ?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="tipoContactoId" class="tipoContactoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete TIPOCONTACTO-->



    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>


<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.tipoContactoId').val(id);
            $('.tipocontacto').val(nombre);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.tipoContactoId').val(id);
            $('.contactoN').html(nombre);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });

    });
</script>


<?= $this->endSection() ?>