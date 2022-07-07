<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- page content -->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Configuración de persona</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus"></i> Agregar Persona</button>
                <a href="<?= base_url() . route_to('cargo') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Cargo</a>
                <a href="<?= base_url() . route_to('departamento') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Departamento</a>

                <!-- Smart Wizard -->
                <!-- Tabs -->

                <div class="collapse" id="collapseExample">
                    <div class="mb-5 border-bottom">

                        <div class="float-end text-muted me-3 mt-2">
                        </div>

                        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">

                            <div class="offcanvas-body">

                                <fieldset class="mb-2" style="display: none;" id="color-list">
                                    <!-- <legend class="col-form-label col-sm-2 col-form-label">Colors</legend> -->

                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <!-- SmartWizard html -->
                    <div id="smartwizard">
                        <ul class="nav nav-progress">
                            <li class="nav-item">
                                <a class="nav-link" href="#step-1">
                                    <div class="num">1</div>
                                    Información Persona
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#step-2">
                                    <span class="num">2</span>
                                    Usuario
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#step-3">
                                    <span class="num">3</span>
                                    Contacto
                                </a>
                            </li>
                        </ul><br>
                        <form action="<?php echo base_url() . '/crearPersona' ?>" method="post">

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1"><br>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">DUI<span class="required ">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" minlength="10" maxlength="10" class="form-control" id="dui" name="dui" required autocomplete="off">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Nombres<span class="required ">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" minlength="3" maxlength="70" class="form-control" id="nombres" name="nombres" required autocomplete="off">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Primer Apellido<span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <input class="form-control" minlength="5" maxlength="40" name="primerApellido" id="primerApellido" type="text" required autocomplete="off">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Segundo Apellido<span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <input class="form-control" minlength="5" maxlength="45" name="segundoApellido" required autocomplete="off" type="text">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Fecha de Nacimiento<span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="date" name="fechaNacimiento" id="fechaNacimiento" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Género <span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <select name="genero" id="genero" class="form-control" required="required">
                                                <option>Género</option>
                                                <option>Masculino</option>
                                                <option>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Cargo <span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <select name="cargoId" id="cargoId" required="required" class="form-control">
                                                <option value="">-Selecciona un cargo-</option>
                                                <?php foreach ($cargo as $c) : ?>
                                                    <option value="<?php echo $c->cargoId ?>"><?php echo $c->cargo ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Departamento <span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <select name="departamentoId" id="departamentoId" required="required" class="form-control">
                                                <option value="">-Selecciona un departamento-</option>
                                                <?php foreach ($departamento as $d) : ?>
                                                    <option value="<?php echo $d->departamentoId ?>"><?php echo $d->departamento ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2"><br>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Nombre de Usuario:<span class="required ">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="usuario" name="usuario" minlength="6" maxlength="25" required="required" autocomplete="off" class="form-control">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Clave:<span class="required ">*</span></label>
                                        <div class="col-md-6">
                                            <input type="password" id="clave" name="clave" minlength="6" maxlength="45" required="required" autocomplete="off" class="form-control">
                                            <span class="form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Estado:<span class="required ">*</span></label>
                                        <div class="col-md-6">
                                            <select name="estado" class="form-control" required="required">
                                                <option value="" disable>-Selecciona un estado-</option>
                                                <option value="A">Activo</option>
                                                <option value="I">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Rol:<span class="required ">*</span></label>
                                        <div class="col-md-6">
                                            <select name="rolId" class="form-control" required="required">
                                                <option value="">-Selecciona un Rol-</option>
                                                <?php foreach ($rol as $r) : ?>
                                                    <option value="<?= $r->rolId ?>"><?= $r->nombreRol ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Correo electrónico:<span class="required ">*</span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="contacto" name="contacto" required="required" minlength="6" maxlength="20" autocomplete="off" class="form-control contacto">
                                            <span class="fa fa-development form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </form>
                    </div>
                    <br /> &nbsp;
                </div>
            </div>
            <!-- End SmartWizard Content -->
        </div>
    </div>
</div>
<!--FIN LISTADO PERSONA-->


<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Configuración de Persona</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"><br>

                <!--LISTADO DE PERSONA-->
                <div class="card-box table-responsive"><br>
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DUI</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Género</th>
                                <th>Cargo</th>
                                <th>Departamento</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $key) : ?>
                                <tr>
                                    <td><?= $key->id ?></td>
                                    <td><?= $key->dui ?></td>
                                    <td><?= $key->nombre ?></td>
                                    <td><?= $key->apellidos ?></td>
                                    <td><?= $key->fechaNacimiento ?></td>
                                    <td><?= $key->genero ?></td>
                                    <td><?= $key->cargo ?></td>
                                    <td><?= $key->departamento ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->id ?>" data-dui="<?php echo $key->dui ?>  " data-nombre="<?php echo $key->nombre ?>" data-apellidos="<?php echo $key->apellidos ?>" data-fechaNacimiento="<?php echo $key->fechaNacimiento ?>" data-genero="<?php echo $key->genero ?>" data-cargo="<?php echo $key->cargo ?>" data-departamento="<?php echo $key->departamento ?>" data-cargoId="<?php echo $key->cargoId ?>" data-departamentoId="<?php echo $key->departamentoId ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->id ?>" data-dui="<?php echo $key->dui ?>" data-nombre="<?php echo $key->nombre ?>" data-apellidos="<?php echo $key->apellidos ?>" data-fechaNacimiento="<?php echo $key->fechaNacimiento ?>" data-genero="<?php echo $key->genero ?>" data-cargo="<?php echo $key->cargo ?>" data-departamento="<?php echo $key->departamento ?>" data-cargoId="<?php echo $key->cargoId ?>" data-departamentoId="<?php echo $key->departamentoId ?>"><i class="fa fa-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!--FIN LISTADO PERSONA-->

                <!-- Modal Edit PERSONA-->
                <form action="<?php echo base_url() . '/actualizarPersona' ?>" method="POST">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Persona</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Nombres<span class="required ">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" minlength="3" maxlength="70" class="form-control nombres" id="nombres" name="nombres" required autocomplete="off">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Primer Apellido<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input class="form-control primerApellido" minlength="5" maxlength="45" name="primerApellido" id="primerApellido" type="text" required autocomplete="off">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Segundo Apellido<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input class="form-control segundoApellido" minlength="5" maxlength="45" name="segundoApellido" required autocomplete="off" type="text">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Fecha de Nacimiento<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input class="form-control fechaNacimiento" type="date" name="fechaNacimiento" id="fechaNacimiento" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Género <span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <select name="genero" id="genero" class="form-control genero">
                                                <option>Género</option>
                                                <option>Masculino</option>
                                                <option>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Cargo <span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <select name="cargoId" id="cargoId" class="form-control cargoId">
                                                <option value="">-Selecciona un cargo-</option>
                                                <?php foreach ($cargo as $c) : ?>
                                                    <option value="<?php echo $c->cargoId ?>"><?php echo $c->cargo ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-2 label-align">Departamento <span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <select name="departamentoId" id="departamentoId" class="form-control departamentoId">
                                                <option value="">-Selecciona un departamento-</option>
                                                <?php foreach ($departamento as $d) : ?>
                                                    <option value="<?php echo $d->departamentoId ?>"><?php echo $d->departamento ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="personaId" class="personaId">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Edit PERSONA-->

                <!-- Modal Delete PERSONA-->
                <form action="<?php echo base_url() . '/eliminarPersona' ?>" method="POST">
                    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Persona</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <h4>¿Esta seguro que desea eliminar el registro de: <b><i class="personaN"></i></b> ?</h4>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="personaId" class="personaId">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary">SI</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Delete PERSONA-->

            </div>
        </div>
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>
<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal('No se agrego', 'Datos incorrectos', 'error');
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

        // get Edit Tipo Direccion
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const dui = $(this).data('dui');
            const nombre = $(this).data('nombre');
            var apellidos = $(this).data('apellidos');
            const fechaN = $(this).data('fechaNacimiento');
            const genero = $(this).data('genero');
            const cargo = $(this).data('cargoid');
            const departamento = $(this).data('departamentoid');

            var ape = apellidos.split(" ");

            var primerApe = ape[0];
            var segundoApe = ape[1];

            // Set data to Form Edit
            $('.personaId').val(id);
            $('.dui').val(dui);
            $('.nombres').val(nombre);
            $('.primerApellido').val(primerApe);
            $('.segundoApellido').val(segundoApe);
            $('.fechaNacimiento').val(fechaN);
            $('.genero').val(genero);
            $('.cargoId').val(cargo).trigger('change');
            $('.departamentoId').val(departamento).trigger('change');

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete 
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const apellidos = $(this).data('apellidos');
            const fechaNacimiento = $(this).data('fechaNacimiento');
            const genero = $(this).data('genero');
            const cargo = $(this).data('cargo');
            const departamento = $(this).data('departamento');

            // Set data to Form Edit
            $('.personaId').val(id);
            $('.personaN').html(nombre);

            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });

    });
</script>

<script type="text/javascript" src="./js/demo.js"></script>

<script type="text/javascript">
    function onCancel() {
        $('#smartwizard').smartWizard("reset");
    }

    $(function() {
        // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled').prop('disabled', true);
            } else if (stepPosition === 'last') {
                $("#next-btn").addClass('disabled').prop('disabled', true);
            } else {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
            }

            // Get step info from Smart Wizard
            let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
            $("#sw-current-step").text(stepInfo.currentStep + 1);
            $("#sw-total-step").text(stepInfo.totalSteps);
        });

        $("#smartwizard").on("initialized", function(e) {
            console.log("initialized");
        });

        $("#smartwizard").on("loaded", function(e) {
            console.log("loaded");
        });

        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            autoAdjustHeight: true,
            theme: 'arrows', // basic, arrows, square, round, dots
            transition: {
                animation: 'fade' // none|fade|slideHorizontal|slideVertical|slideSwing|css
            },
            toolbar: {
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                position: 'bottom', // none/ top/ both bottom
                extraHtml: `<button class="btn btn-primary" typr="submit">Agregar</button>`
            },
            anchor: {
                enableNavigation: true, // Enable/Disable anchor navigation 
                enableNavigationAlways: true, // Activates all anchors clickable always
                enableDoneState: false, // Add done state on visited steps
                markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                enableDoneStateNavigation: true // Enable/Disable the done state navigation
            },
            disabledSteps: [], // Array Steps disabled
            errorSteps: [], // Highlight step with errors
            hiddenSteps: [], // Hidden steps
            // getContent: (idx, stepDirection, selStep, callback) => {
            //   console.log('getContent',selStep, idx, stepDirection);
            //   callback('<h1>'+idx+'</h1>');
            // }
        });

        $.fn.smartWizard.transitions.myFade = (elmToShow, elmToHide, stepDirection, wizardObj, callback) => {
            if (!$.isFunction(elmToShow.fadeOut)) {
                callback(false);
                return;
            }

            if (elmToHide) {
                elmToHide.fadeOut(wizardObj.options.transition.speed, wizardObj.options.transition.easing, () => {
                    elmToShow.fadeIn(wizardObj.options.transition.speed, wizardObj.options.transition.easing, () => {
                        callback();
                    });
                });
            } else {
                elmToShow.fadeIn(wizardObj.options.transition.speed, wizardObj.options.transition.easing, () => {
                    callback();
                });
            }
        }


        $("#state_selector").on("change", function() {
            $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
            return true;
        });

        $("#style_selector").on("change", function() {
            $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
            return true;
        });

    });
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            language: {
                url: 'vendors/datatables.net/es.json'
            }
        });
    });
</script>

<!-- /page content -->
<?= $this->endSection() ?>