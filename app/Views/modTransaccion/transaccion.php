<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- page content -->

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Configuración de Transacción</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Transacción</button>
                <a href="<?= base_url().route_to('proceso') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Proceso</a>
                <a href="<?= base_url().route_to('persona') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Persona</a>
                <a href="<?= base_url().route_to('institucion') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Institución</a>
                <br>

                <!--LISTADO DE TRANSACCION-->
                <div class="x_content">
                    <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proceso</th>
                                <th>Persona</th>
                                <th>Institución</th>
                                <th>Estado</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Finalización</th>
                                <th>Hora de Inicio</th>
                                <th>Hora de Finalización</th>
                                <th>Observaciones</th>
                                <th scope="col" colspan="2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos as $key): ?>
                            <tr>
                                <td><?= $key->id ?></td>
                                <td><?= $key->proceso ?></td>
                                <td><?= $key->persona ?></td>
                                <td><?= $key->institucion ?></td>
                                <td><?= $key->estadoT ?></td>
                                <td><?= $key->fechaInicio ?></td>
                                <td><?= $key->fechaFin ?></td>
                                <td><?= $key->horaInicio ?></td>
                                <td><?= $key->horaFin ?></td>
                                <td><?= $key->observaciones ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $key->id ?>" data-proceso="<?= $key->proceso ?>" data-persona="<?= $key->persona ?>" data-institucion="<?= $key->institucion ?>" data-estadoT="<?= $key->estadoT ?>" data-fechaInicio="<?= $key->fechaInicio ?>" data-fechaFin="<?= $key->fechaFin ?>" data-horaInicio="<?= $key->horaInicio ?>" data-horaFin="<?= $key->horaFin ?>" data-observaciones="<?= $key->observaciones ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" ><i class="fa fa-trash"></i> Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?> 

                        </tbody>
                    </table>
                </div>
                <!--FIN LISTADO TRANSACCION-->

                <!-- Modal Agregar TRANSACCION-->
                <form action="<?php echo base_url() . '/crearTransaccion' ?>" method="POST">
                    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Transacción</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Proceso: </label>
                                <select name="procesoId" class="form-control">
                                    <option value="">-Selecciona un proceso-</option>
                                    <?php foreach ($proceso as $pro): ?>
                                        <option value="<?= $pro->procesoId ?>"><?= $pro->nombreProceso ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Persona: </label>
                                <select name="personaId" class="form-control">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($persona as $pers): ?>
                                        <option value="<?= $pers->personaId ?>"><?= $pers->nombres ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Institución:</label>
                                <select name="institucionId" class="form-control">
                                    <option value="">-Selecciona una Institución-</option>
                                    <?php foreach ($institucion as $i): ?>
                                        <option value="<?= $i->institucionId ?>"><?= $i->nombreInstitucion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Estado de la Transacción:</label>
                                <select name="estadoTransaccion" class="form-control">
                                    <option value="" disable>-Selecciona un estado-</option>
                                    <option value="A">Activo</option>
                                    <option value="F">Finalizado</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Fecha de inicio:</label>
                                <input type="date" id="fechaInicio" name="fechaInicio" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Fecha de Finalización:</label>
                                <input type="date" id="fechaFin" name="fechaFin" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Hora de inicio:</label>
                                <input type="time" id="horaInicio" name="horaInicio" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Hora de Finalización:</label>
                                <input type="time" id="horaFin" name="horaFin" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Observaciones:</label>
                                <input type="text" id="observaciones" name="observaciones" required="required" autocomplete="off" class="form-control">
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
                <!-- End Modal Agregar TRANSACCION-->

                <!-- Modal Edit TRANSACCION-->
                <form action="<?php echo base_url() . '/actualizarTransaccion' ?>" method="POST">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Transacción</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                        <div class="form-group">
                                <label>Proceso: </label>
                                <select name="procesoId" class="form-control procesoId">
                                    <option value="">-Selecciona un proceso-</option>
                                    <?php foreach ($proceso as $pro): ?>
                                        <option value="<?php echo $pro->procesoId ?>"><?php echo $pro->nombreProceso ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Persona: </label>
                                <select name="personaId" class="form-control personaId">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($persona as $pers): ?>
                                        <option value="<?= $pers->personaId ?>"><?= $pers->nombres ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Institución:</label>
                                <select name="institucionId" class="form-control institucionId">
                                    <option value="">-Selecciona una Institución-</option>
                                    <?php foreach ($institucion as $i): ?>
                                        <option value="<?= $i->institucionId ?>"><?= $i->nombreInstitucion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Estado de la Transacción:</label>
                                <select name="estadoTransaccion" class="form-control estadoTransaccion">
                                    <option value="" disable>-Selecciona un estado-</option>
                                    <option value="A">Activo</option>
                                    <option value="F">Finalizado</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Fecha de inicio:</label>
                                <input type="date" id="fechaInicio" name="fechaInicio" required="required" autocomplete="off" class="form-control fechaInicio">
                            </div>

                            <div class="form-group">
                                <label>Fecha de Finalización:</label>
                                <input type="date" id="fechaFin" name="fechaFin" required="required" autocomplete="off" class="form-control fechaFin">
                            </div>

                            <div class="form-group">
                                <label>Hora de inicio:</label>
                                <input type="time" id="horaInicio" name="horaInicio" required="required" autocomplete="off" class="form-control horaInicio">
                            </div>

                            <div class="form-group">
                                <label>Hora de Finalización:</label>
                                <input type="time" id="horaFin" name="horaFin" required="required" autocomplete="off" class="form-control horaFin">
                            </div>

                            <div class="form-group">
                                <label>Observaciones:</label>
                                <input type="text" id="observaciones" name="observaciones" required="required" autocomplete="off" class="form-control observaciones">
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="transaccionId" class="transaccionId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Edit TRANSACCION-->

                <!-- Modal Delete TRANSACCION-->
                <form action="<?php echo base_url() . '/eliminarTransaccion' ?>" method="POST">
                    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Transacción</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                        <h4>¿Esta seguro que desea eliminar la Transacción: <b><i class="transaccionN"></i></b> ?</h4>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="transaccionId" class="transaccionId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Delete TRANSACCION-->

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
            const proceso = $(this).data('proceso');
            const persona = $(this).data('persona');
            const institucion= $(this).data('institucion');
            const estadoT = $(this).data('estadoT');
            const fechaInicio = $(this).data('fechaInicio');
            const fechaFin = $(this).data('fechaFin');
            const horaInicio = $(this).data('horaInicio');
            const horaFin = $(this).data('horaFin');
            const observaciones = $(this).data('observaciones');

            // Set data to Form Edit
            $('.transaccionId').val(id);
            $('.procesoId').val(proceso);
            $('.personaId').val(persona);
            $('.institucionId').val(institucion);
            $('.estadoTransaccion').val(estadoT);
            $('.fechaInicio').val(fechaInicio);
            $('.fechaFin').val(fechaFin);
            $('.horaInicio').val(horaInicio);
            $('.horaFin').val(horaFin);
            $('.observaciones').val(observaciones)

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete 
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            
            // Set data to Form Edit
            $('.transaccionId').val(id);
            $('.transaccionN').html(id);

            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<!-- /page content -->
<?= $this->endSection() ?>