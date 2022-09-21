<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<!-- page content -->
<div class="x_panel">
    <div class="x_title">
        <h2>Agregar menú</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#agregarMenu"><i class="fa fa-plus"></i> Agregar menú</button>
                <a type="button" href="<?= base_url() . route_to('submenus') ?>" class="btn btn-outline-success"><i class="fa fa-angle-double-right"></i> Menu Detalle</a>
                <div class="card-box table-responsive"><br>
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Menus</th>
                                <th>Icono</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $key) : ?>
                                <tr>
                                    <td><?php echo $key->menuId ?></td>
                                    <td><?php echo $key->nombreMenu ?></td>
                                    <td><i class="<?php echo $key->nombreIcono ?>"></i> <?php echo $key->nombreIcono ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-edit" 
                                        data-id="<?= $key->menuId ?>" 
                                        data-nombre="<?php echo $key->nombreMenu ?>"
                                        data-nombre="<?php echo $key->nombreIcono ?>"
                                        data-iconoId="<?php echo $key->iconoId ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                        
                                        <a href="#" class="btn btn-danger btn-sm btn-delete" 
                                        data-id="<?= $key->menuId ?>" 
                                        data-nombre="<?php echo $key->nombreMenu ?>"><i class="fa fa-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--MODALS AGREGAR, EDITAR, ELIMINAR -->
<div>
    <!--MODAL AGREGAR-->
    <form action="<?php echo base_url() . '/crear' ?>" method="POST">
        <div class="modal fade" id="agregarMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" id="nombreMenu" name="nombreMenu" required="required" autocomplete="off" class="form-control ">
                        </div>
                        <div class="form-group">
                            <label>Seleccionar Icono:</label>
                            <select name="iconoId" required="required" class="form-control iconoId">
                                <option value="">-Selecciona un Icono-</option>
                                <?php foreach ($icono as $key) : ?>
                                    <option value="<?php echo $key->iconoId ?>"><span><i class="<?php echo $key->nombreIcono ?>"></i></span>
                                        <?php echo $key->nombreIcono ?> </i></option>
                                <?php endforeach; ?>
                            </select>
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
    <form action="<?php echo base_url() . '/eliminarMenu' ?>" method="POST">
        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="menuId" class="menuId">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">SI</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--END MODAL -->

    <!-- MODAL EDITAR MENU-->
    <form action="<?php echo base_url() . '/editMenu' ?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" id="nombreMenu" name="nombreMenu" autocomplete="off" required="required" class="form-control nombreMenu">
                        </div>
                        <div class="form-group">
                            <label>Seleccionar Icono:</label>
                            <select name="iconoId"  id="iconoId" required="required" class="form-control iconoId">
                                <option value="">-Selecciona un Icono-</option>
                                <?php foreach ($icono as $key) : ?>
                                    <option value="<?php echo $key->iconoId ?>"> <?php echo $key->nombreIcono ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '1') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '0') {
        swal('No se agrego', 'Datos incorrectos', 'error');
    } else if (mensaje == '2') {
        swal('', 'Actualizado', 'success');
    } else if (mensaje == '3') {
        swal('Falló actualización', 'Datos incorrectos', 'error');
    } else if (mensaje == '4') {
        swal('', 'Eliminado', 'success');
    } else if (mensaje == '5') {
        swal('', 'No', 'error');
    } else if (mensaje == '6') {
        swal('', '¡No se agregó, este Menú ya ha sido ingresado!', 'error');
    } else if (mensaje == '7') {
        swal({
            icon: "error",
            title: "¡Este Menú no puede ser eliminado!", 
            text: "Lo sentimos, no se puede eliminar el menú porque aún poseé submenus.",
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
            const iconoId = $(this).data('iconoid');

            // Set data to Form Edit
            $('.menuId').val(id);
            $('.nombreMenu').val(nombre);
            $('.nombreIcono').val(nombre);
            $('.iconoId').val(iconoId);
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
        $('#datatable').DataTable({
            language: {
                url: 'vendors/datatables.net/es.json'
            },
            "order": [[0, 'asc']],
        });
    });
</script>


<?= $this->endSection() ?>