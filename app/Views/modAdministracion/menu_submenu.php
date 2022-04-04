<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row">

    <!-- Formulario para agregar MENÚ -->
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
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarMenu"><i class="fa fa-plus"></i> Agregar menú</button>
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#agregarSubmenu"><i class="fa fa-plus"></i> Agregar Subenú</button>
                </div>
            </div>

            <!--MODAL -->
            <div class="modal" id="agregarMenu" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar menú</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- FORMULARIO PARA AGREGAR MENU -->
                            <div class="x_content">
                                <form method="POST" action="<?php echo base_url() . '/crear' ?>">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del Menú<span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="nombreMenu" name="nombreMenu" required="required" minlength="3" autocomplete="off" class="form-control ">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Seleccionar Icono<span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select class="form-control">
                                                <option>Icono 1</option>
                                                <option>Icono 2</option>
                                                <option>Icono 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Agregar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <br>
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
                            <h4 class="modal-title">Eliminar Menú</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="x_content">
                                <h5>¿Deseas eliminar este Menú?</h5>
                            </div>
                            <!-- end form for validations -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <form id="eliminarForm" data-bs-action="/modAdministracion/MenuSubmenuController/eliminar/" method="POST">
                                <a class="btn btn-danger btn-ok">Eliminar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MODAL -->

            <!--MODAL ACTUALIZAR -->
            <div class="modal" id="modalActualizar" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Menú</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="x_content">
                                <h5>¿Deseas eliminar este Menú?</h5>
                            </div>
                            <!-- end form for validations -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <form id="eliminarForm" data-bs-action="menu/eliminar/" method="POST">
                                <a class="btn btn-danger btn-ok">Eliminar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MODAL -->

            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Menus</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $key) : ?>
                            <tr>
                                <td><?php echo $key->nombreMenu ?></td>
                                <td>
                                    <button type="submit" class="btn btn-danger" href="#" data-href="<?php echo base_url() . '/modAdministracion/MenuSubmenuController/eliminar/' . $key->menuId ?>" data-bs-nombre="<?php echo $key->nombreMenu ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></button>
                                    <button type="submit" class="btn btn-primary" href="#" data-href="<?php echo base_url() . '/menu_submenu/actualizar/' . $key->menuId ?>" data-bs-nombre="<?php echo $key->nombreMenu ?>" data-toggle="modal" data-target="#modalActualizar"><i class="fa fa-pencil-square-o"></i></button>
                                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#tablaSubmenu" aria-label="Close"><i class="fa fa-external-link"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            </form>
        </div>
    </div>
    <!-- End Formulario para agregar MENÚ -->

    <!--MODAL DE SUBMENU -->
    <div class="modal" id="agregarSubmenu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Submenú</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORMULARIO PARA AGREGAR MENU -->
                    <div class="x_content">
                        <form method="POST" action="<?php echo base_url() . '/crearSubmenu' ?>">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del Submenú <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="nombreSubMenu" name="nombreSubMenu" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Seleccionar el Menu<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control">
                                        <?php foreach ($datos as $key) : ?>
                                            <option id="menuId" name="menuId"><?php echo $key->nombreMenu ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Agregar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <br>
                        </form>
                    </div>
                    <!-- end FORMULARIO PARA AGREGAR MENU -->
                </div>
                                                
            </div>
        </div>
    </div>
    <!--END MODAL -->


    <!--MODAL MOSTRAR DATOS DE SUB MENU -->
    <div class="modal" id="tablaSubmenu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submenus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Tabla para mostrar menus que posee el Usuario -->
                    <div class="x_content">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Submenus</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Plan de Estudios</td>
                                    <td><button type="button" class="btn btn-danger"><i class="fa fa-trash"></button></td>
                                </tr>
                                <tr>
                                    <td>Expedientes Graduados</td>
                                    <td><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <tr>
                                    <td>Calificación Institucional</td>
                                    <td><button type="button" class="btn btn-danger"><i class="fa fa-trash"></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end form for validations -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL -->
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '1') {
        swal(':D', 'Agregado', 'success');
    } else if (mensaje == '0') {
        swal(':c', 'No', 'error');
    }else if (mensaje == '4') {
        swal(':D', 'Eliminado', 'success');
    }else if (mensaje == '5') {
        swal(':c', 'No', 'error');
    }
</script>

<script>
    $('#modalEliminar').on('show.bs.modal', function(e){
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>


<?= $this->endSection() ?>