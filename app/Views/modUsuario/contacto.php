<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<?= $this->extend('modUsuario/tipocontacto') ?>
<?= $this->section('content') ?>
<?= $this->endSection() ?>

<!---------C-O-N-T-A-C-T-O-S---------------------------------------------------------->
<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Contactos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <!--LISTADO DE Contactos -->
        <div class="row">
            <div class="col-md-12 col-sm-12 offset-md-12 right">
                <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#modalContacto"><i class="fa fa-plus"></i> Agregar Contacto</button>
                <br>
                <div class="card-box table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Persona</th>
                                <th>Tipo de Contacto</th>
                                <th>Contacto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $key) : ?>
                                <tr>
                                    <td><?php echo $key->contactoId ?></td>
                                    <td><?php echo $key->nombre ?></td>
                                    <td><?php echo $key->tipoContacto ?></td>
                                    <td><?php echo $key->contacto ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-edit-contacto" data-id="<?php echo $key->contactoId ?>" data-nombre="<?php echo $key->nombre ?>"> <i class="fa fa-pencil-square-o"></i> Editar</a>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete-contacto" data-id="<?php echo $key->contactoId ?>" data-nombre="<?php echo $key->nombre ?>" ><i class="fa fa-trash"></i> Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- end form for validations -->
            </div>
            <!-- FIN LISTADO tipocontacto -->
        </div>
        <!-- FIN LISTADO TIPOCONTACTO -->

        <!-- Modal Agregar CONTACTO-->
        <form action="<?php echo base_url() . '/crearContacto' ?>" method="POST">
            <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar contacto.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Seleccionar Persona:</label>
                                <select name="personaId" class="form-control personaId" required="required">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($persona as $pers) : ?>
                                        <option value="<?php echo $pers->personaId ?>"><?php echo $pers->nombres, ' ', $pers->primerApellido ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Seleccionar Tipo Contacto:</label>
                                <select name="tipoContactoId" class="form-control tipoContactoId" required="required">
                                    <option value="">-Selecciona un tipo contacto-</option>
                                    <?php foreach ($tipoContacto as $key) : ?>
                                        <option value="<?php echo $key->tipoContactoId ?>"><?php echo $key->tipoContacto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Contacto:</label>
                                <input type="text" id="contacto" name="contacto" required="required" minlength="6" maxlength="45" autocomplete="off" class="form-control contacto">
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                <form action="" class="formulario">
                                    <div class="radio">
                                        <input type="radio" name="estado" id="estado" value="Activo">
                                        <label for="Activo">Activo</label>

                                        <input type="radio" name="estado" id="estado" value="Inactivo">
                                        <label for="Inactivo">Inactivo</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Agregar tipocontacto-->

        <!-- Modal Edit CONTACTO-->
        <form action="<?php echo base_url() . '/actualizarContacto' ?>" method="POST">
            <div class="modal fade" id="editContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Contacto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Persona</label>
                                <input readonly type="text" id="personaId" name="personaId" autocomplete="off" required="required" class="form-control personaId">
                            </div>
                            <div class="form-group">
                                <label>Seleccionar Tipo Contacto:</label>
                                <select name="tipoContactoId" class="form-control tipoContactoId" required="required">
                                    <option value="">-Selecciona un tipo contacto-</option>
                                    <?php foreach ($tipoContacto as $key) : ?>
                                        <option value="<?php echo $key->tipoContactoId ?>"><?php echo $key->tipoContacto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Contacto:</label>
                                <input type="text" id="contacto" name="contacto" required="required" minlength="3" maxlength="30" autocomplete="off" class="form-control contacto">
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                <form action="" class="formulario" required="required">
                                    <div class="radio">
                                        <input type="radio" name="estado" id="estado" value="Activo">
                                        <label for="Activo">Activo</label>

                                        <input type="radio" name="estado" id="estado" value="Inactivo">
                                        <label for="Inactivo">Inactivo</label>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="contactoId" class="contactoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit CONTACTO-->

        <!-- Modal Delete CONTACTO-->
        <form action="<?php echo base_url() . '/eliminarContacto' ?>" method="POST">
            <div class="modal fade" id="eliminarContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Contacto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar este Contacto: <b><i class="contactoN"></i></b> ?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="contactoId" class="contactoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete CONTACTO-->


    </div>
</div>

<!------------------------------------------------------------------->


<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>


<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Registro agregado', 'success');
    } else if (mensaje == '1') {
        swal('', 'No se agrego', 'error');
    } else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    } else if (mensaje == '3') {
        swal('', 'No se Elimino Registro', 'error');
    } else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    } else if (mensaje == '5') {
        swal('No se actualizo', '', 'error');
    } else if (mensaje == '6') {
        swal('No se agrego', 'Seleccione en que estado se encuentra el contacto', 'error');
    } else if (mensaje == '7') {
        swal('No se actualizo', 'Seleccione en que estado se encuentra el contacto', 'error');
    }
</script>

<script>
    $(document).ready(function() {

        // get Edit Contacto
        $('.btn-edit-contacto').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const tipocontacto = $(this).data('tipocontacto');
            const contacto = $(this).data('contacto');
            const estado = $(this).data('estado');

            // Set data to Form Edit
            $('.contactoId').val(id);
            $('.personaId').val(nombre);
            $('.tipocontacto').val(tipocontacto);
            $('.contacto').val(contacto);
            $('.estado').val(estado);

            // Call Modal Edit
            $('#editContacto').modal('show');
        });

        // get Delete Contacto
        $('.btn-delete-contacto').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const tipocontacto = $(this).data('tipocontacto');
            const contacto = $(this).data('contacto');
            const estado = $(this).data('estado');

            // Set data to Form Edit
            $('.contactoId').val(id);
            $('.contactoN').html(contacto);
            // Call Modal Edit
            $('#eliminarContacto').modal('show');
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