<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Proceso</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Proceso</button>
        <a href="<?= base_url() . route_to('tipoProceso') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Tipo Proceso</a>
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Proceso</th>
                        <th>Tipo de Proceso</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $key) : ?>
                        <tr>
                            <td><?= $key->id ?></td>
                            <td><?= $key->nombre ?></td>
                            <td><?= $key->tipoProceso ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-tipoProceso="<?= $key->tipoProceso ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>"><i class="fa fa-trash"></i> Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO PROCESO-->

        <!-- Modal Agregar PROCESO-->
        <form action="<?php echo base_url() . '/crearProceso' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Proceso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Proceso</label>
                                <input type="text" id="nombreProceso" name="nombreProceso" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Tipo de Proceso: </label>
                                <select name="tipoProcesoId" class="form-control tipoProcesoId">
                                    <option value="">-Selecciona un tipo de proceso-</option>
                                    <?php foreach ($tipoProceso as $tp) : ?>
                                        <option value="<?= $tp->tipoProcesoId ?>"><?= $tp->tipoProceso ?></option>
                                    <?php endforeach; ?>
                                </select>
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
        <!-- End Modal Agregar PROCESO-->

        <!-- Modal Edit PROCESO-->
        <form action="<?php echo base_url() . '/actualizarProceso' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Proceso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Proceso</label>
                                <input type="text" id="nombreProceso" name="nombreProceso" autocomplete="off" required="required" class="form-control nombreProceso">
                            </div>

                            <div class="form-group">
                                <label>Tipo de Proceso: </label>
                                <select name="tipoProcesoId" class="form-control tipoProcesoId">
                                    <option value="">-Selecciona un tipo de proceso-</option>
                                    <?php foreach ($tipoProceso as $tp) : ?>
                                        <option value="<?= $tp->tipoProcesoId ?>"><?= $tp->tipoProceso ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="procesoId" class="procesoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit PROCESO-->

        <!-- Modal Delete PROCESO-->
        <form action="<?php echo base_url() . '/eliminarProceso' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Proceso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar el Proceso: <b><i class="procesoN"></i></b> ?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="procesoId" class="procesoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete PROCESO-->

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
    }
</script>

<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const tipoProceso = $(this).data('tipoProceso');

            // Set data to Form Edit
            $('.procesoId').val(id);
            $('.nombreProceso').val(nombre);
            $('.tipoProcesoId').val(tipoProceso);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.procesoId').val(id);
            $('.procesoN').html(nombre);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });

    });
</script>

<?= $this->endSection() ?>