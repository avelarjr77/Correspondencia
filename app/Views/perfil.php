<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<?php
    use App\Models\modUsuario\UsuarioModel;
    $session = session();
    $usuario  = new UsuarioModel();
    $foto =$usuario->asArray()->select('u.imagenPerfil')->from('wk_usuario u')->where('u.usuario', $session->usuario)->first();


?>

<!-- page content -->
<br>
<div class="x_panel">
    <div class="x_title">
        <h2>Informacion de Usuario:<small><?php echo strtoupper(session('usuario')); ?></small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="col-md-3 col-sm-3  profile_left">
            <div class="profile_img">
            <form  action="<?php echo base_url() . '/subirFoto' ?>" method="POST" enctype="multipart/form-data">
                <div class="kv-avatar">
                    <div class="">
                        <input id="imagenPerfil" name="imagenPerfil" type="file" data-browse-on-zone-click="true" required>
                    </div>
                </div>
                <?php foreach ($persona as $key) : ?>
                    <input type="hidden" name="usuarioId" class="usuarioId" id="moduloId" value="<?= $key->usuarioId ?> ">
                <?php endforeach; ?>
                <button type="submit" name="submit"  class="btn btn-primary btn-tDocumnto">Cambiar imagen</button>
            </form>
            </div>
            <?php foreach ($persona as $key) : ?>
                <h3> <?php echo $key->nombres, ' ', $key->primerApellido ?></h3>
            <?php endforeach; ?>

            <ul class="list-unstyled user_data">

                <?php foreach ($direccion as $key) : ?>
                    <li><i class="fa fa-user user-profile-icon"></i> <?php echo session('rol') ?>
                    </li>
                <?php endforeach; ?>

                <?php foreach ($direccion as $key) : ?>
                    <li><i class="fa fa-map-marker user-profile-icon"></i>
                        <?php echo $key->direccion, ', ', $key->municipio, ', ', $key->departamento ?>
                    </li>
                <?php endforeach; ?>

                <?php foreach ($departamento as $key) : ?>
                    <li>
                        <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $key->departamento ?>
                    </li>
                <?php endforeach; ?>

            </ul>

            <!--<?php foreach ($persona as $key) : ?>
            <a href="#" class="btn btn-success btn-edit" data-id="<?= $key->usuarioId ?>"
                data-nombre="<?= $key->usuario ?>">
                <i class="fa fa-edit m-right-xs"></i> Editar Prefil
            </a>-->
            <a href="#" class="btn btn-primary btn-pass btn-xs" data-id="<?= $key->usuarioId ?>" data-nombre="<?= $key->usuario ?>">
                <i class="fa fa-key m-right-xs"></i> Cambiar Contraseña
            </a>
        <?php endforeach; ?>
        <br />


        </div>
        <div class="col-md-9 col-sm-9 ">

            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel">
                    <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="panel-title">Actividad <span class="fa fa-chevron-down right"></span></h4>
                    </a>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <!-- start recent activity -->
                            <!--LISTADO DE BITACORA-->
                            <div class="card-box table-responsive"><br>
                                <table id="datatable" class="table table-striped no-margin">
                                    <thead>
                                        <tr>
                                            <th>Accion</th>
                                            <th>Descripción</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($actividad as $key) : ?>
                                            <tr>
                                                <td><?= $key->accion ?></td>
                                                <td><?= $key->descripcion ?></td>
                                                <td><?= $key->fecha ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                            <!--FIN LISTADO BITACORA-->
                            <!-- end recent activity -->
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h4 class="panel-title">Procesos <span class="fa fa-chevron-down right"></h4>
                    </a>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <!-- start user projects -->
                            <div class="card-box table-responsive"><br>
                                <table id="datatable" class="table table-striped no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Procesos</th>
                                            <th>Institución</th>
                                            <th class="hidden-phone">Encargado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($procesos as $key) : ?>
                                            <tr>
                                                <td><?= $key->id ?></td>
                                                <td><?= $key->proceso ?></td>
                                                <td><?= $key->institucion ?></td>
                                                <td class="hidden-phone"><?= $key->persona ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end user projects -->
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h4 class="panel-title">Más detalles <span class="fa fa-chevron-down right"></h4>
                    </a>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <div class="col-md-6 col-sm-6">
                                <ul class="list-unstyled user_data"><br>
                                    <li>
                                        <h6>Cargo:</h6>
                                        <?php foreach ($cargo as $key) : ?>
                                            <i class=""></i> </i> <?php echo $key->cargo ?>
                                        <?php endforeach; ?>
                                    </li>
                                    <li>
                                        <h6>Departamento:</h6>
                                        <?php foreach ($departamento as $key) : ?>
                                            <i class=""></i> <?php echo $key->departamento ?>
                                        <?php endforeach; ?>
                                    </li>

                                    <li>
                                        <h6>Celular:</h6>
                                        <?php foreach ($celular as $key) : ?>
                                            <i class=""></i> <?php echo $key->contacto ?>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-6"><br>
                                <ul class="list-unstyled user_data">
                                    <li>
                                        <h6>Correo:</h6>
                                        <?php foreach ($correo as $key) : ?>
                                            <i class=""></i> <?php echo $key->contacto ?> <br>
                                        <?php endforeach; ?>
                                    </li>
                                    <li>
                                        <h6>Dirección:</h6>
                                        <?php foreach ($direccion as $key) : ?>
                                            <i class=""></i><?php echo $key->direccion, ', ', $key->municipio, ', ', $key->departamento ?>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of accordion -->
        </div>
    </div>
</div>

<!-- Modal Edit Rol-->
<form action="<?php echo base_url() . '/editarPerfil' ?>" method="POST">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!--<div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4  label-align">Usuario<span
                                class="required ">*</span></label>
                        <div class="col-md-7">
                            <input type="text" minlength="6" maxlength="70" class="form-control " id="usuario"
                                name="usuario" required autocomplete="off">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div> -->
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4  label-align">Nombres<span class="required ">*</span></label>
                        <div class="col-md-7">
                            <input type="text" minlength="3" maxlength="70" class="form-control nombres" id="nombres" name="nombres" required autocomplete="off">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4  label-align">Primer Apellido<span class="required">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control primerApellido" minlength="5" maxlength="45" name="primerApellido" id="primerApellido" type="text" required autocomplete="off">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4  label-align">Segundo Apellido<span class="required">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control segundoApellido" minlength="5" maxlength="45" name="segundoApellido" required autocomplete="off" type="text">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4 label-align">Fecha de Nacimiento<span class="required">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control fechaNacimiento" type="date" name="fechaNacimiento" id="fechaNacimiento" required>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4 label-align">Contraseña <span class="required">*</span></label>
                        <div class="col-md-7">
                            <input type="password" id="clave" name="clave" minlength="6" maxlength="45" required="required" autocomplete="off" class="form-control clave">
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4 label-align">Confirmar Contraseña <span class="required">*</span></label>
                        <div class="col-md-7">
                            <input type="password" id="clave" name="clave" minlength="6" maxlength="45" required="required" autocomplete="off" class="form-control clave">
                        </div>
                    </div>
                </div>
                <?php foreach ($persona as $key) : ?>
                    <input type="hidden" name="usuarioId" class="usuarioId" id="moduloId" value="<?= $key->usuarioId ?> ">
                <?php endforeach; ?>
                <div class="modal-footer">
                    <input type="hidden" name="personaId" class="personaId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Rol-->

<!-- Modal para cambiar contraseña-->
<form action="<?php echo base_url() . '/nuevaContraseña' ?>" method="POST">
    <div class="modal fade" id="editPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4  label-align">Contraseña actual<span class="required ">*</span></label>
                        <div class="col-md-7">
                            <input type="password" minlength="6" maxlength="45" class="form-control nombres" id="clave" name="clave" required autocomplete="off">
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4  label-align">Nueva contraseña<span class="required">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" minlength="6" maxlength="45" name="nueva" id="nueva" type="password" required autocomplete="off">
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4  label-align">Repetir contraseña nueva<span class="required">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" minlength="6" maxlength="45" name="confirmar" id="confirmar" required autocomplete="off" type="password">
                        </div>
                    </div>
                </div>
                <?php foreach ($persona as $key) : ?>
                    <input type="hidden" name="usuarioId" class="usuarioId" id="moduloId" value="<?= $key->usuarioId ?> ">
                <?php endforeach; ?>
                <div class="modal-footer">
                    <input type="hidden" name="personaId" class="personaId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal -->

<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>
<script src="vendors/fileinput/js/fileinput.min.js"></script>
<script src="vendors/fileinput/themes/explorer-fa6/theme.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/locales/es.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            language: {
                url: 'vendors/datatables.net/es.json'
            },
            "order": [
                [2, 'desc']
            ],
            "ordering": true,
        });
    });
</script>
<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', '', 'success');
    } else if (mensaje == '1') {
        swal('', '', 'error');
    } else if (mensaje == '2') {
        swal('¡La contraseña se ha actualizado con éxito!', '', 'success');
    } else if (mensaje == '3') {
        swal('¡La contraseña ingresada es incorrecta!', 'Vuelva a intentarlo', 'error');
    }else if (mensaje == '4') {
        swal('¡Se cambio la foto de perfil!', '', 'success');
    }else if (mensaje == '5') {
        swal('Imagen excede el limite de capacidad', 'Vuelva a intentarlo', 'error');
    }else if (mensaje == '6') {
        swal('', 'Tipo de archivo no admitido en la base de datos', 'error');
    }
</script>

<script>
$("#imagenPerfil").fileinput({
    language: 'es',
    uploadUrl: "http://localhost/correspondencia-ucad/imagenPerfil.php",
    overwriteInitial: false,
    maxFileSize: 1500,
    showClose: false,
    removeZoom: true,
    showCaption: false,
    showUpload: null,
    showZoom: false,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<i class="bi bi-camera-fill"></i>',
    removeIcon: '<i class="bi-trash"></i>',
    defaultPreviewContent: '<img src="uploads/<?php echo $foto['imagenPerfil']; ?>" style="width: 100%;" alt="Your Avatar">',
    layoutTemplates: {main2: '{preview} {remove} {browse} '},
    allowedFileExtensions: ["jpg", "png", "gif"]
});
</script>


<script>
    $(document).ready(function() {

        // get Edit Perfil
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.usuarioId').val(id);
            $('.usuario').val(nombre);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Edit Pass
        $('.btn-pass').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.usuarioId').val(id);
            $('.usuario').val(nombre);
            // Call Modal Edit
            $('#editPass').modal('show');
        });

    });
</script>
<script>
    var password = document.getElementById("nueva");
    var confirm_password = document.getElementById("confirmar");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            //Colorear confirm en rojo o usar: 
            confirm_password.setCustomValidity("Las contraseñas no coinciden");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

<!-- /page content -->
<?= $this->endSection() ?>