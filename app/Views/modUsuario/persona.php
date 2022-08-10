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
                <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal"
                    data-target="#modalPersona"><i class="fa fa-plus"></i>
                    Agregar
                    Persona</button>
                <a href="<?= base_url() . route_to('cargo') ?>" class="btn btn-outline-secondary mb-2"><i
                        class="fa fa-cogs"></i> Configurar Cargo</a>
                <a href="<?= base_url() . route_to('departamento') ?>" class="btn btn-outline-secondary mb-2"><i
                        class="fa fa-cogs"></i> Configurar Departamento</a>

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
                                    <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->id ?>"
                                        data-dui="<?php echo $key->dui ?>  " data-nombre="<?php echo $key->nombre ?>"
                                        data-apellidos="<?php echo $key->apellidos ?>"
                                        data-fechaNacimiento="<?php echo $key->fechaNacimiento ?>"
                                        data-genero="<?php echo $key->genero ?>" data-cargo="<?php echo $key->cargo ?>"
                                        data-departamento="<?php echo $key->departamento ?>"
                                        data-cargoId="<?php echo $key->cargoId ?>"
                                        data-departamentoId="<?php echo $key->departamentoId ?>"><i
                                            class="fa fa-pencil-square-o"></i> Editar</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete"
                                        data-id="<?php echo $key->id ?>" data-dui="<?php echo $key->dui ?>"
                                        data-nombre="<?php echo $key->nombre ?>"
                                        data-apellidos="<?php echo $key->apellidos ?>"
                                        data-fechaNacimiento="<?php echo $key->fechaNacimiento ?>"
                                        data-genero="<?php echo $key->genero ?>" data-cargo="<?php echo $key->cargo ?>"
                                        data-departamento="<?php echo $key->departamento ?>"
                                        data-cargoId="<?php echo $key->cargoId ?>"
                                        data-departamentoId="<?php echo $key->departamentoId ?>"><i
                                            class="fa fa-trash"></i> Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!--FIN LISTADO PERSONA-->

            </div>
            <!-- End SmartWizard Content -->
        </div>
    </div>
</div>
<!--FIN LISTADO PERSONA-->

<!-- Modal Agregar Persona-->
<form action="<?php echo base_url() . '/crearPersona' ?>" method="POST">
    <div class="modal fade" id="modalPersona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Persona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">DUI<span
                                class="required ">*</span></label>
                        <div class="col-md-8">
                            <input type="text" minlength="9" maxlength="10" class="form-control dui" id="dui"
                                name="dui" required="required" autocomplete="off" data-inputmask="'mask': '99999999-9'">
                            <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Nombres<span
                                class="required ">*</span></label>
                        <div class="col-md-8">
                            <input type="text" minlength="3" maxlength="70" class="form-control nombres" id="nombres"
                                name="nombres" required autocomplete="off">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Primer Apellido<span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <input class="form-control primerApellido" minlength="5" maxlength="45"
                                name="primerApellido" id="primerApellido" type="text" required autocomplete="off">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Segundo Apellido<span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <input class="form-control segundoApellido" minlength="5" maxlength="45"
                                name="segundoApellido" required autocomplete="off" type="text">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Fecha de Nacimiento<span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <input class="form-control fechaNacimiento" type="date" name="fechaNacimiento"
                                id="fechaNacimiento" required>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Género <span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <select name="genero" id="genero" class="form-control genero">
                                <option>Género</option>
                                <option value="M">Masculino</option>
                                <option value="M">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Cargo <span
                                class="required">*</span></label>
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
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Departamento <span
                                class="required">*</span></label>
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
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Agregar tipocontacto-->

<!-- Modal Edit PERSONA-->
<form action="<?php echo base_url() . '/actualizarPersona' ?>" method="POST">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        <label class="col-form-label col-md-3 col-sm-3  label-align">DUI<span
                                class="required ">*</span></label>
                        <div class="col-md-8">
                            <input type="text" minlength="3" maxlength="10" class="form-control dui" id="dui"
                                name="dui" required="required" autocomplete="off" data-inputmask="'mask': '99999999-9'">
                            <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Nombres<span
                                class="required ">*</span></label>
                        <div class="col-md-8">
                            <input type="text" minlength="3" maxlength="70" class="form-control nombres" id="nombres"
                                name="nombres" required autocomplete="off">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Primer Apellido<span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <input class="form-control primerApellido" minlength="5" maxlength="45"
                                name="primerApellido" id="primerApellido" type="text" required autocomplete="off">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Segundo Apellido<span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <input class="form-control segundoApellido" minlength="5" maxlength="45"
                                name="segundoApellido" required autocomplete="off" type="text">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Fecha de Nacimiento<span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <input class="form-control fechaNacimiento" type="date" name="fechaNacimiento"
                                id="fechaNacimiento" required>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Género <span
                                class="required">*</span></label>
                        <div class="col-md-8">
                            <select name="genero" id="genero" class="form-control genero">
                                <option>Género</option>
                                <option value="M">Masculino</option>
                                <option value="M">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Cargo <span
                                class="required">*</span></label>
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
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Departamento <span
                                class="required">*</span></label>
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
    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
        const dui = $(this).data('dui');
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