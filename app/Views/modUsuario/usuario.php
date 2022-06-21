<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- page content -->

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Configuración de Usuario</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Usuario</button>
                <a href="<?= base_url().route_to('persona') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Persona</a>
                <a href="<?= base_url().route_to('adminRol') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Rol</a>
                <br>

                <!--LISTADO DE USUARIO-->
                <div class="x_content">
                    <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Persona</th>
                                <th>Nombre de Usuario</th>
                                <th>Estado</th>
                                <th>Rol</th>
                                <th scope="col" colspan="2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos as $key): ?>
                            <tr>
                                <td><?= $key->id ?></td>
                                <td><?= $key->nombre ?></td>
                                <td><?= $key->usuario ?></td>
                                <td><?= $key->estado ?></td>
                                <td><?= $key->rol ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-usuario="<?= $key->usuario ?>" data-clave="<?= $key->clave ?>" data-estado="<?= $key->estado ?>" data-rol="<?= $key->rol ?>" data-rolid="<?= $key->rolId ?>" data-personaid="<?= $key->personaId ?>" ><i class="fa fa-pencil-square-o"></i> </a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-usuario="<?= $key->usuario ?>" data-clave="<?= $key->clave ?>" data-estado="<?= $key->estado ?>" data-rol="<?= $key->rol ?>" ><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            <?php endforeach; ?> 

                        </tbody>
                    </table>
                </div>
                <!--FIN LISTADO USUARIO-->

                <!-- Modal Agregar USUARIO-->
                <form action="<?php echo base_url() . '/crearUsuario' ?>" method="POST">
                    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar una Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Persona: </label>
                                <select name="personaId" class="form-control" required="required">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($persona as $pers): ?>
                                        <option value="<?= $pers->personaId ?>"><?= $pers->nombres ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label>Nombre de Usuario:</label>
                                <input type="text" id="usuario" name="usuario" minlength="6" maxlength="25" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Nombre de Clave:</label>
                                <input type="password" id="clave" name="clave" minlength="6" maxlength="45" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control" required="required">
                                    <option value="" disable>-Selecciona un estado-</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Rol:</label>
                                <select name="rolId" class="form-control" required="required">
                                    <option value="">-Selecciona un Rol-</option>
                                    <?php foreach ($rol as $r): ?>
                                        <option value="<?= $r->rolId ?>"><?= $r->nombreRol ?></option>
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
                <!-- End Modal Agregar USUARIO-->

                <!-- Modal Edit USUARIO-->
                <form action="<?php echo base_url() . '/actualizarUsuario' ?>" method="POST">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Persona: </label>
                                <select name="personaId" class="form-control personaId" id="personaId" required="required">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($persona as $pers): ?>
                                        <option value="<?= $pers->personaId ?>"><?= $pers->nombres ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label>Nombre de Usuario:</label>
                                <input type="text" id="usuario" name="usuario" minlength="6" maxlength="25" required="required" autocomplete="off" class="form-control usuario">
                            </div>

                            <div class="form-group">
                                <label>Nombre de Clave:</label>
                                <input type="password" id="clave" name="clave" minlength="6" maxlength="45" required="required" autocomplete="off" class="form-control clave">
                            </div>

                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control estado" id="estado" required="required">
                                    <option value="" disable>-Selecciona un estado-</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Rol:</label>
                                <select name="rolId" class="form-control rolId" id="rolId" required="required">
                                    <option value="">-Selecciona un Rol-</option>
                                    <?php foreach ($rol as $r): ?>
                                        <option value="<?= $r->rolId ?>"><?= $r->nombreRol ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="usuarioId" class="usuarioId" id="usuarioId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Edit USUARIO-->

                <!-- Modal Delete USUARIO-->
                <form action="<?php echo base_url() . '/eliminarUsuario' ?>" method="POST">
                    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                        <h4>¿Esta seguro que desea eliminar el registro de: <b><i class="usuarioN"></i></b> ?</h4>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="usuarioId" class="usuarioId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Delete USUARIO-->

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
        swal('', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal('No se agrego', 'Datos incorrectos', 'error');
    }else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    }else if (mensaje == '3') {
        swal('', 'No se Elimino Registro', 'error');
    }else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    }else if (mensaje == '5') {
        swal('No se actualizo', 'Datos incorrectos', 'error');
    }
</script>

<script>
    $(document).ready(function(){

        // get Edit usuario
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const usuario = $(this).data('usuario');
            const clave = $(this).data('clave');
            var estado = $(this).data('estado');
            const rol = $(this).data('rol');
            const rolId = $(this).data('rolid');
            const personaId = $(this).data('personaid');

            console.log(id, nombre, usuario, clave, estado, rol, rolId);
            
            // Set data to Form Edit
            $('.usuarioId').val(id);
            $('.personaId').val(personaId);
            $('.usuario').val(usuario);
            $('.clave').val(clave);
            $('.estado').val(estado);
            $('.rolId').val(rolId);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete 
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const usuario = $(this).data('usuario');
            const clave = $(this).data('clave');
            const estado = $(this).data('estado');
            const rol = $(this).data('rol');
            
            // Set data to Form Edit
            $('.usuarioId').val(id);
            $('.usuarioN').html(usuario);

            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<!-- /page content -->
<?= $this->endSection() ?>