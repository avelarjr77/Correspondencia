<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- page content -->

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
            <div class="x_content">
                <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Persona</button>
                <a href="<?= base_url().route_to('cargo') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Cargo</a>
                <a href="<?= base_url().route_to('departamento') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Departamento</a>
                <br>

                <!--LISTADO DE PERSONA-->
                <div class="x_content">
                    <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Género</th>
                                <th>Cargo</th>
                                <th>Departamento</th>
                                <th scope="col" colspan="2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos as $key): ?>
                            <tr>
                                <td><?php echo $key->id ?></td>
                                <td><?php echo $key->nombre ?></td>
                                <td><?php echo $key->apellidos ?></td>
                                <td><?php echo $key->fechaNacimiento ?></td>
                                <td><?php echo $key->genero ?></td>
                                <td><?php echo $key->cargo ?></td>
                                <td><?php echo $key->departamento ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>" data-apellidos="<?php echo $key->apellidos ?>" data-fechaNacimiento="<?php echo $key->fechaNacimiento ?>" data-genero="<?php echo $key->genero ?>" data-cargo="<?php echo $key->cargo ?>" data-departamento="<?php echo $key->departamento ?>" data-cargoid="<?php echo $key->cargoId ?>" data-departamentoid="<?php echo $key->departamentoId ?>" ><i class="fa fa-pencil-square-o"></i> Editar</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>" data-apellidos="<?php echo $key->apellidos ?>" data-fechaNacimiento="<?php echo $key->fechaNacimiento ?>" data-genero="<?php echo $key->genero ?>" data-cargo="<?php echo $key->cargo ?>" data-departamento="<?php echo $key->departamento ?>" data-cargoid="<?php echo $key->cargoId ?>" data-departamentoid="<?php echo $key->departamentoId ?>" ><i class="fa fa-trash"></i> Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?> 

                        </tbody>
                    </table>
                </div>
                <!--FIN LISTADO PERSONA-->

                <!-- Modal Agregar PERSONA-->
                <form action="<?php echo base_url() . '/crearPersona' ?>" method="POST">
                    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar una Persona</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Nombres<span class="required ">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nombres" name="nombres" required autocomplete="off">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            </div> 
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Primer Apellido<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" name="primerApellido" id="primerApellido" type="text" required autocomplete="off">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Segundo Apellido<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" name="segundoApellido" required autocomplete="off" type="text">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Fecha de Nacimiento<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="date" name="fechaNacimiento" id="fechaNacimiento" required>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Género <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="genero" id="genero" class="form-control">
                                        <option>Género</option>
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Cargo <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="cargoId" id="cargoId" class="form-control">
                                        <option value="">-Selecciona un cargo-</option>
                                        <?php foreach ($cargo as $c): ?>
                                            <option value="<?php echo $c->cargoId ?>"><?php echo $c->cargo ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Departamento <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="departamentoId" id="departamentoId" class="form-control">
                                        <option value="">-Selecciona un departamento-</option>
                                        <?php foreach ($departamento as $d): ?>
                                            <option value="<?php echo $d->departamentoId ?>"><?php echo $d->departamento ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <button type="reset" class="btn btn-outline-info btn-xs">Limpiar</button>
                                </div>
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
                <!-- End Modal Agregar PERSONA-->

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
                                <input type="text" class="form-control nombres" id="nombres" name="nombres" required autocomplete="off">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            </div> 
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Primer Apellido<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control primerApellido" name="primerApellido" id="primerApellido" type="text" required autocomplete="off">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Segundo Apellido<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control segundoApellido" name="segundoApellido" required autocomplete="off" type="text">
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
                                        <?php foreach ($cargo as $c): ?>
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
                                        <?php foreach ($departamento as $d): ?>
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
    }else if (mensaje == '2') {
        swal(':D', 'Eliminado', 'success');
    }else if (mensaje == '3') {
        swal(':c', 'No se Elimino Registro', 'error');
    }else if (mensaje == '4') {
        swal(':D', 'Actualizado con exito', 'success');
    }else if (mensaje == '5') {
        swal(':c', 'No se actualizo', 'error');
    }
</script>

<script>
    $(document).ready(function(){

        // get Edit Tipo Direccion
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
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
        $('.btn-delete').on('click',function(){
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

<!-- /page content -->
<?= $this->endSection() ?>