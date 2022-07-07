<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>


<div class="row">
    <!-- LISTAR SUBMENÚ -->
    <div class="x_panel">
        <div class="x_title">
            <h2>Agregar Submenú</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="">
                <div class="col-md-12 col-sm-12 offset-md-12 right">
                    <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#agregarSubMenu"><i class="fa fa-plus"></i> Agregar Submenú</button>
                    <a type="button" href="<?= base_url() . route_to('menu_submenu') ?>" class="btn btn-outline-success"><i class="fa fa-mail-reply"></i> Regresar</a>
                    <div class="card-box table-responsive"><br>
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Menú</th>
                                    <th>Submenus</th>
                                    <th>Archivo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($submenu as $key) : ?>
                                    <tr>
                                        <td><?php echo $key->subMenuId ?></td>
                                        <td><?php echo $key->nombreMenu ?></td>
                                        <td><?php echo $key->nombreSubMenu ?></td>
                                        <td><?php echo $key->nombreArchivo ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->subMenuId ?>" data-nombre="<?php echo $key->nombreSubMenu ?>" data-idmenu="<?php echo $key->nombreMenu ?>" data-archivo="<?php echo $key->nombreArchivo ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                            <button type="submit" class="btn btn-danger btn-sm btn-delete" href="#" data-href="<?php echo base_url() . '/modAdministracion/SubMenuController/eliminarSubmenu/' . $key->subMenuId ?>" data-nombre="<?php echo $key->nombreSubMenu ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i> Eliminar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end form for validations -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LISTAR SUBMENÚ -->

<!--MODALS AGREGAR, EDITAR, ELIMINAR -->
<div>
    <!--MODAL AGREGAR-->
    <div class="modal" id="agregarSubMenu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Submenú</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORMULARIO PARA EDITAR MENU -->
                    <div class="x_content">
                        <form method="POST" action="<?php echo base_url() . '/agregarSubMenu' ?>">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del Submenú<span class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-6 ">
                                    <input type="text" id="nombreSubMenu" name="nombreSubMenu" required="required" minlength="3" maxlength="30" autocomplete="off" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Seleccionar el Menu<span class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-6 ">
                                    <select name="menuId" class="form-control">
                                        <option value="">-Selecciona un Menú-<span class="required"></span></option>
                                        <?php foreach ($menu as $key) : ?>
                                            <option value="<?php echo $key->menuId ?>"><?php echo $key->nombreMenu ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del archivo:<span class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-6 ">
                                    <input type="text" id="nombreArchivo" name="nombreArchivo" required="required" minlength="3" maxlength="30" autocomplete="off" class="form-control ">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="subMenuId" class="subMenuId">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                    <!-- end FORMULARIO PARA AGREGAR MENU -->
                </div>

            </div>
        </div>
    </div>
    <!--END MODAL -->

    <!--MODAL ELIMINAR -->
    <div class="modal" id="modalEliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Submenú</h4>
                </div>
                <div class="modal-body">
                    <div class="x_content">
                        <h4>¿Esta seguro que desea eliminar este Submenú: <b><i class="subMenuId"></i></b> ?</h4>
                    </div>
                    <!-- end form for validations -->
                </div>
                <div class="modal-footer">
                    <form id="eliminarForm" data-bs-action="/modAdministracion/MenuSubmenuController/eliminar/" method="POST">
                        <input type="hidden" name="menuId" class="menuId">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">SI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL -->

    <!-- MODAL EDITAR MENU-->
    <div class="modal" id="editSubmenu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Submenú</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORMULARIO PARA EDITAR SUBMENU -->
                    <form method="POST" action="<?php echo base_url() . '/actualizarSubmenu' ?>">
                        <div class="item form-group menuId">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Seleccionar el Menu<span class="required"></span>
                            </label>
                            <div class="col-md-7 col-sm-6 ">
                                <select name="menuId" class="form-control">
                                    <option value="">-Selecciona un Menú-</option>
                                    <?php foreach ($menu as $key) : ?>
                                        <option value="<?php echo $key->menuId ?>"><?php echo $key->nombreMenu ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                </div>

                <div class="item form-group nombreSubmenu">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del Submenú <span class="required"></span>
                    </label>
                    <div class="col-md-7 col-sm-6 ">
                        <input type="text" id="nombreSubMenu" name="nombreSubMenu" required="required" class="form-control nombreSubmenu">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del archivo:<span class="required"></span>
                    </label>
                    <div class="col-md-7 col-sm-6 ">
                        <input type="text" id="nombreArchivo" name="nombreArchivo" required="required" minlength="3" maxlength="30" autocomplete="off" class="form-control nombreArchivo">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="subMenuId" class="subMenuId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div><br>
                </form>
                <!-- end FORMULARIO PARA AGREGAR MENU -->
            </div>
            <br>
            </form>
        </div>
        <!-- end FORMULARIO PARA AGREGAR MENU -->
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '1') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '0') {
        swal('No se agrego', 'Campos vacios o datos incorrectos', 'error');
    } else if (mensaje == '2') {
        swal('', 'Actualizado', 'success');
    } else if (mensaje == '3') {
        swal('Falló actualización', 'Campos vacios o datos incorrectos', 'error');
    } else if (mensaje == '4') {
        swal('', 'Eliminado', 'success');
    } else if (mensaje == '5') {
        swal('', 'No', 'error');
    }
</script>


<script>
    $('#modalEliminar').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<script>
    $(document).ready(function() {



        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form EditnombreMenu
            $('.subMenuId').val(id);
            $('.nombreSubmenu').html(nombre);
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
            const idMenu = $(this).data('idmenu');
            const archivo = $(this).data('archivo');

            // Set data to Form Edit
            $('.subMenuId').val(id);
            $('.nombreSubmenu').val(nombre);
            $('.menuId').val(idMenu);
            $('.nombreArchivo').val(archivo);
            // Call Modal Edit
            $('#editSubmenu').modal('show');
        });
    });
</script>


<?= $this->endSection() ?>