<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Actividad</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Actividad</button>
        <a href="<?= base_url().route_to('etapa') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Etapa</a>
        <br>
        <!--LISTADO DE ACTIVIDAD-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Actividad</th>
                        <th>Descripción</th>
                        <th>Etapa</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $key): ?>
                    <tr>
                        <td><?= $key->id ?></td>
                        <td><?= $key->nombre ?></td>
                        <td><?= $key->descripcion ?></td>
                        <td><?= $key->etapa ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-descripcion="<?= $key->descripcion ?>" data-etapa="<?= $key->etapa ?>" ><i class="fa fa-pencil-square-o"></i> Editar</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>"><i class="fa fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?> 

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO ACTIVIDAD-->

        <!-- Modal Agregar ACTIVIDAD-->
        <form action="<?php echo base_url() . '/crearActividad' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Actividad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre de la Actividad</label>
                        <input type="text" id="nombreActividad" name="nombreActividad" required="required" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" required="required" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Etapa </label>
                        <select name="etapaId" class="form-control">
                            <option value="">-Selecciona una etapa-</option>
                            <?php foreach ($etapa as $e): ?>
                                <option value="<?= $e->etapaId ?>"><?= $e->nombreEtapa ?></option>
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
        <!-- End Modal Agregar ACTIVIDAD-->

        <!-- Modal Edit ACTIVIDAD-->
        <form action="<?php echo base_url() . '/actualizarActividad' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Actividad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre de la Actividad</label>
                        <input type="text" id="nombreActividad" name="nombreActividad" autocomplete="off" required="required" class="form-control nombreActividad">
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" required="required" autocomplete="off" class="form-control descripcion">
                    </div>

                    <div class="form-group">
                        <label>Etapa </label>
                        <select name="etapaId" class="form-control etapaId">
                            <option value="">-Selecciona una etapa-</option>
                            <?php foreach ($etapa as $e): ?>
                                <option value="<?= $e->etapaId ?>"><?= $e->nombreEtapa ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="actividadId" class="actividadId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit ACTIVIDAD-->

        <!-- Modal Delete ACTIVIDAD-->
        <form action="<?php echo base_url() . '/eliminarActividad' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Actividad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4>¿Esta seguro que desea eliminar la Actividad: <b><i class="actividadN"></i></b> ?</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="actividadId" class="actividadId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">SI</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Delete ACTIVIDAD-->

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

        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const descripcion = $(this).data('descripcion');
            const etapa = $(this).data('etapa');

            // Set data to Form Edit
            $('.actividadId').val(id);
            $('.nombreActividad').val(nombre);
            $('.descripcion').val(descripcion);
            $('.etapaId').val(etapa);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.actividadId').val(id);
            $('.actividadN').html(nombre);

            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>
