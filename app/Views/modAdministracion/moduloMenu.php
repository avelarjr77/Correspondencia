<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- Formulario para agregar modulo menu -->
<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Módulo Menu</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div classme="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Módulo/Menu</button>
        <br>
        <!--LISTADO DE MODULO MENU-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Modulo</th>
                        <th>Nombre de Menu</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ModuloM as $key) : ?>
                        <tr>
                            <td><?= $key->id ?></td>
                            <td><?= $key->modulo ?></td>
                            <td><?= $key->nomMenu?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $key->id ?>" data-nombremod="<?= $key->modulo ?>" data-nombremenu="<?= $key->nomMenu ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" data-nombremod="<?= $key->modulo ?>" data-nombremenu="<?= $key->nomMenu ?>"><i class="fa fa-trash"></i></a>           
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO ROLES-->
<!-- Modal Agregar Módulo-->
        <form action="<?php echo base_url() . '/crearMM' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Módulo/Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Módulo:</label>
                                <select name="moduloId" required="required" class="form-control">
                                    <option value="">-Selecciona un Modulo-</option>
                                    <?php foreach ($modulo as $mod): ?>
                                        <option value="<?php echo $mod->moduloId ?>"><?php echo $mod->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombre del Menu:</label>
                                <select name="menuId" required="required" class="form-control">
                                    <option value="">-Selecciona un Menu-</option>
                                    <?php foreach ($menu as $me): ?>
                                        <option value="<?php echo $me->menuId ?>"><?php echo $me->nombreMenu ?></option>
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
        <!-- End Modal Agregar Módulo-->

        
        <!-- Modal Edit Módulo-->
        <form action="<?php echo base_url() . '/actualizarMM' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Módulo/Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Módulo:</label>
                                <select name="moduloId" required="required" class="form-control moduloId">
                                    <option value="">-Selecciona un Modulo-</option>
                                    <?php foreach ($modulo as $mod): ?>
                                        <option value="<?php echo $mod->moduloId ?>"><?php echo $mod->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nombre del Menu:</label>
                                <select name="menuId" required="required" class="form-control menuId">
                                    <option value="">-Selecciona un Menu-</option>
                                    <?php foreach ($menu as $me): ?>
                                        <option value="<?php echo $me->menuId ?>"><?php echo $me->nombreMenu ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="moduloMenuId" class="moduloMenuId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit Módulo-->

        <!-- Modal Delete Módulo-->
        <form action="<?php echo base_url() . '/eliminarMM' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Módulo/Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar este registro ?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="moduloMenuId" class="moduloMenuId">
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
            const nombremod = $(this).data('nombremod');
            const nombremenu = $(this).data('nombremenu');

            // Set data to Form Edit
            $('.moduloMenuId').val(id);
            $('.moduloId').val(nombremod);
            $('.menuId').val(nombremenu);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombremod = $(this).data('nombremod');
            const nombremenu = $(this).data('nombremenu');

            // Set data to Form Edit
            $('.moduloMenuId').val(id);
            $('.moduloId').html(nombremod);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });

    });
</script>

<?= $this->endSection() ?>