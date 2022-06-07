<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- Formulario para agregar ROLES -->
<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Módulos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div classme="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Módulo</button>
        <br>
        <!--LISTADO DE ROLES-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Modulo</th>
                        <th>Icono</th>
                        <th>Descripción</th>
                        <th>Archivo</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $modulo) : ?>
                        <tr>
                            <td><?= $modulo->moduloId ?></td>
                            <td><?= $modulo->nombre ?></td>
                            <td><i class="<?= $modulo->nombreIcono ?>"></i> <?= $modulo->nombreIcono ?></td>
                            <td><?= $modulo->descripcion ?></td>
                            <td><?= $modulo->archivo ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $modulo->moduloId ?>" data-nombremod="<?= $modulo->nombre ?>" data-iconomod="<?= $modulo->nombreIcono ?>" data-descripcionmod="<?= $modulo->descripcion ?>" data-archivomod="<?= $modulo->archivo ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $modulo->moduloId ?>" data-nombremod="<?= $modulo->nombre ?>" data-iconomod="<?= $modulo->nombreIcono ?>" data-descripcionmod="<?= $modulo->descripcion ?>" data-archivomod="<?= $modulo->archivo ?>"><i class="fa fa-trash"></i></a>           
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
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
                                <input type="text" id="nombre" name="nombre" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Seleccionar Icono:</label>
                                <select name="iconoId" required="required" class="form-control iconoId">
                                    <option value="">-Selecciona un Icono-</option>
                                    <?php foreach ($icono as $key) : ?>
                                    <option value="<?php echo $key->iconoId ?>"><span><i
                                                class="<?php echo $key->nombreIcono ?>"></i></span>
                                        <?php echo $key->nombreIcono ?> </i></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" id="descripcion" name="descripcion" required="required" maxlength="40" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Archivo</label>
                                <input type="text" id="archivo" name="archivo" required="required" maxlength="40" autocomplete="off" class="form-control">
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
                                <input type="text" id="nombre" name="nombre" autocomplete="off" required="required" class="form-control nombre">
                            </div>

                            <div class="form-group">
                                <label>Seleccionar Icono:</label>
                                <select name="iconoId" id="iconoId" required="required" class="form-control iconoId">
                                    <option value="">-Selecciona un Icono-</option>
                                    <?php foreach ($icono as $key) : ?>
                                    <option value="<?php echo $key->iconoId ?>"><span><i
                                                class="<?php echo $key->nombreIcono ?>"></i></span>
                                        <?php echo $key->nombreIcono ?> </i></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" id="descripcion" name="descripcion" required="required" maxlength="40" autocomplete="off" class="form-control descripcion">
                            </div>

                            <div class="form-group">
                                <label>Archivo</label>
                                <input type="text" id="archivo" name="archivo" required="required" maxlength="40" autocomplete="off" class="form-control archivo">
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
</div>
<!-- End Formulario para agregar ROLES -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    }
</script>

<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombremod       = $(this).data('nombremod');
            const iconomod        = $(this).data('iconomod');
            const descripcionmod  = $(this).data('descripcionmod');
            const archivomod      = $(this).data('archivomod');

            // Set data to Form Edit
            $('.moduloId').val(id);
            $('.nombre').val(nombremod);
            $('.nombreIcono').val(iconomod);
            $('.descripcion').val(descripcionmod);
            $('.archivo').val(archivomod);

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

<?= $this->endSection() ?>