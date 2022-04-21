<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!---------C-O-N-T-A-C-T-O-S---------------------------------------------------------->
<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Contactos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#modalContacto"><i class="fa fa-plus"></i> Agregar Contacto</button>
        <br>
        <!--LISTADO DE Contactos-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Persona</th>
                        <th>Tipo Contacto</th>
                        <th>Contacto</th>
                        <th>Estado</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody><?php foreach($datos as $key): ?>
                    <tr>
                        <td><?php echo $key->contactoId ?></td>
                        <td><?php echo $key->nombre ?></td>
                        <td><?php echo $key->tipoContacto ?></td>
                        <td><?php echo $key->contacto ?></td>
                        <td><?php echo $key->estado ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit-contacto" data-id="<?php echo $key->contactoId ?>"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete-contacto" data-id="<?php echo $key->contactoId ?>" data-nombre=""><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!--FIN LISTADO TIPOCONTACTO-->

        <!-- Modal Agregar TIPOCONTACTO-->
        <form action="<?php echo base_url() . '/crearContacto' ?>" method="POST">
            <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar tipo de contacto.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Seleccionar Persona:</label>
                        <select name="personaId" class="form-control contactoN">
                            <option value="">-Selecciona una persona-</option>
                            <?php foreach ($persona as $pers): ?>
                                <option value="<?php echo $pers->personaId ?>"><?php echo $pers->nombres,' ', $pers->primerApellido ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Seleccionar Tipo Contacto:</label>
                        <select name="tipoContactoId" class="form-control contactoN">
                            <option value="">-Selecciona un tipo contacto-</option>
                            <?php foreach ($tipoContacto as $key): ?>
                                <option value="<?php echo $key->tipoContactoId ?>"><?php echo $key->tipoContacto?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contacto:</label>
                        <input type="text" id="contacto" name="contacto" required="required" minlength="3" maxlength="20" autocomplete="off" class="form-control contactoN">
                    </div>
                    <div class="form-group">
                        <label>Estado:</label>
                        <input type="text" id="estado" name="estado" required="required" minlength="3" maxlength="20" autocomplete="off" class="form-control contactoN">
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
        <!-- End Modal Agregar TIPOCONTACTO-->

        <!-- Modal Edit TIPOCONTACTO-->
        <form action="<?php echo base_url() . '/actualizarContacto' ?>" method="POST">
            <div class="modal fade" id="editContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Persona</label>
                        <input readonly type="text" id="personaId" name="personaId" autocomplete="off" required="required" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Seleccionar Tipo Contacto:</label>
                        <select name="tipoContactoId" class="form-control">
                            <option value="">-Selecciona un tipo contacto-</option>
                            <?php foreach ($tipoContacto as $key): ?>
                                <option value="<?php echo $key->tipoContactoId ?>"><?php echo $key->tipoContacto?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contacto:</label>
                        <input type="text" id="contacto" name="contacto" required="required" minlength="3" maxlength="20" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Estado:</label>
                        <input type="text" id="estado" name="estado" required="required" minlength="3" maxlength="20" autocomplete="off" class="form-control">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="contactoId" class="contactoId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit CONTACTO-->

        <!-- Modal Delete CONTACTO-->
        <form action="<?php echo base_url() . '/eliminarContacto' ?>" method="POST">
            <div class="modal fade" id="eliminarContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4>¿Esta seguro que desea eliminar este Contacto: <b><i class="contactoN"></i></b> ?</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="contactoId" class="contactoId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">SI</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Delete DEPARTAMENTO-->



    </div>
</div>
<!------------------------------------------------------------------->

    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal(':D', 'Tipo contacto agregado', 'success');
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

        // get Edit Product
        $('.btn-edit-contacto').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.contactoId').val(id);
            $('.contactoN').val(nombre);
            // Call Modal Edit
            $('#editContacto').modal('show');
        });

        // get Delete Product
        $('.btn-delete-contacto').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.contactoId').val(id);
            $('.contactoN').html(nombre);
            // Call Modal Edit
            $('#eliminarContacto').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>
<?= $this->extend('modUsuario/tipoContacto') ?>
<?= $this->section('content') ?>
<?= $this->endSection() ?>