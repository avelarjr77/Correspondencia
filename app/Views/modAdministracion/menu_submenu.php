<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row">
    <!-- LISTAR MENÚ -->
    <div class="x_panel">
        <div class="x_title">
            <h2>Agregar menú</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="">
                <div class="col-md-12 col-sm-12 offset-md-12 right">
                    <button class="btn btn-outline-success" type="button" data-toggle="modal"
                        data-target="#agregarMenu"><i class="fa fa-plus"></i> Agregar menú</button>
                    <a type="button" href="<?= base_url() . route_to('submenus') ?>" class="btn btn-outline-success"><i
                            class="fa fa-angle-double-right"></i> Menu Detalle</a>
                </div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Menus</th>
                            <th>Icono</th>
                            <th>Identificador</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menu as $key) : ?>
                        <tr>
                            <td><?php echo $key->menuId ?></td>
                            <td><?php echo $key->nombreMenu ?></td>
                            <td><i class="<?php echo $key->nombreIcono ?>"></i> <?php echo $key->nombreIcono ?></td>
                            <td><?php echo $key->identificador ?></td>
                            <td>
                                <a href="#" class="btn btn-danger btn-delete"
                                    data-href="<?php echo base_url() . '/modAdministracion/MenuSubmenuController/eliminar/' . $key->menuId ?>"
                                    data-nombre="<?php echo $key->nombreMenu ?>" data-toggle="modal"
                                    data-target="#modalEliminar"><i class="fa fa-trash"></i></a>
                                <a href="#" class="btn btn-warning btn-xs btn-edit" data-id="<?php echo $key->menuId ?>"
                                    data-nombre="<?php echo $key->nombreMenu ?>"><i
                                        class="fa fa-pencil-square-o"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            </form>
        </div>
    </div>
    <!-- END LISTAR MENÚ -->

    <!--MODALS AGREGAR, EDITAR, ELIMINAR -->
    <div>
        <!--MODAL AGREGAR-->
        <form action="<?php echo base_url() . '/crear' ?>" method="POST">
            <div class="modal fade" id="agregarMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Menú</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Agregar Menú:</label>
                                <input type="text" id="nombreMenu" name="nombreMenu" required="required" minlength="3"
                                    maxlength="30" autocomplete="off" class="form-control ">
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
                                <label>Identificador</label>
                                <input type="text" id="identificador" name="identificador" autocomplete="off"
                                    required="required" minlength="2" maxlength="3" class="form-control identificador">
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
        <!--END MODAL -->

        <!--MODAL ELIMINAR -->
        <div class="modal" id="modalEliminar" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar Menú</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_content">
                            <h4>¿Esta seguro que desea eliminar el menú: <b><i class="nombreMenu"></i></b> ?</h4>
                        </div>
                        <!-- end form for validations -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <form id="eliminarForm" data-bs-action="/modAdministracion/MenuSubmenuController/eliminar/"
                            method="POST">
                            <a class="btn btn-danger btn-ok">Eliminar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL -->

        <!-- MODAL EDITAR MENU-->
        <form action="<?php echo base_url() . '/editMenu' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Menú</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre del Menu</label>
                                <input type="text" id="nombreMenu" name="nombreMenu" autocomplete="off"
                                    required="required" class="form-control nombreMenu">
                            </div>
                            <div class="form-group">
                                <label>Seleccionar Icono:</label>
                                <select name="iconoId" required="required" class="form-control ">
                                    <option value="">-Selecciona un Icono-</option>
                                    <?php foreach ($icono as $key) : ?>
                                    <option value="<?php echo $key->iconoId ?>"> <?php echo $key->nombreIcono ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Identificador</label>
                                <input type="text" id="identificador" name="identificador" autocomplete="off"
                                    required="required" minlength="2" maxlength="3" class="form-control identificador">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="menuId" class="menuId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End MODAL EDITAR MENU-->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '1') {
        swal({
            text: "¡Agregado!",
            icon: "success",
            button: "Ok",
        });

    } else if (mensaje == '0') {
        swal({
            text: "¡Lo sentimos, no se agrego!",
            icon: "error",
            button: "Ok",
        });
    } else if (mensaje == '2') {
        swal({
            text: "¡Actualizado!",
            icon: "success",
            button: "Ok",
        });
    } else if (mensaje == '3') {
        swal({
            text: "¡Lo sentimos, no se actualizo!",
            icon: "error",
            button: "Ok",
        });
    } else if (mensaje == '4') {
        swal({
            icon: 'error',
            text: '¡Se ha eliminado!',
            button: "Ok"
        });
    } else if (mensaje == '5') {
        swal({
            icon: 'error',
            title: 'Oops...',
            text: 's',
        });
    } else if (mensaje == '6') {
        swal({
            icon: 'error',
            title: 'Oops...',
            text: '<?= 'Este menu esta repetido' ?>',
        });
    }
</script>

<script>
$('#modalEliminar').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

<script>
$(document).ready(function() {

    // get Edit Product
    $('.btn-edit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');

        // Set data to Form Edit
        $('.menuId').val(id);
        $('.nombreMenu').val(nombre);
        $('.nombreIcono').val(nombre);
        // Call Modal Edit
        $('#editModal').modal('show');
    });

    // get Delete Product
    $('.btn-delete').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');
        // Set data to Form Edit
        $('.menuId').val(id);
        $('.nombreMenu').html(nombre);
        // Call Modal Edit
        $('#eliminarModal').modal('show');
    });
});
</script>

<script>
$(document).ready(function() {

    // get Edit Product
    $('.btn-edit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');

        // Set data to Form Edit
        $('.menuId').val(id);
        $('.nombreMenu').val(nombre);
        $('.nombreIcono').val(nombre);
        // Call Modal Edit
        $('#editModal').modal('show');
    });
});
</script>


<?= $this->endSection() ?>
