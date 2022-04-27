<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Etapa</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Etapa</button>
        <a href="<?= base_url().route_to('proceso') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Proceso</a>
        <br>
        <!--LISTADO DE ETAPA-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Etapa</th>
                        <th>Orden</th>
                        <th>Nombre del Proceso</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $key): ?>
                    <tr>
                        <td><?php echo $key->id ?></td>
                        <td><?php echo $key->nombre ?></td>
                        <td><?php echo $key->orden ?></td>
                        <td><?php echo $key->proceso ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>" data-orden="<?php echo $key->orden ?>" data-proceso="<?php echo $key->proceso ?>" data-procesoI="<?php echo $key->procesoId ?>" ><i class="fa fa-pencil-square-o"></i> Editar</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>"><i class="fa fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?> 

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO ETAPA-->

        <!-- Modal Agregar ETAPA-->
        <form action="<?php echo base_url() . '/crearEtapa' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Etapa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del Etapa</label>
                        <input type="text" id="nombreEtapa" name="nombreEtapa" required="required" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Orden</label>
                        <input type="number" id="orden" name="orden" required="required" autocomplete="off" class="form-control orden">
                    </div>

                    <div class="form-group">
                        <label>Proceso </label>
                        <select name="procesoId" class="form-control procesoId">
                            <option value="">-Selecciona un proceso-</option>
                            <?php foreach ($proceso as $p): ?>
                                <option value="<?php echo $p->procesoId ?>"><?php echo $p->nombreProceso ?></option>
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
        <!-- End Modal Agregar ETAPA-->

        <!-- Modal Edit ETAPA-->
        <form action="<?php echo base_url() . '/actualizarEtapa' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Etapa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del Etapa</label>
                        <input type="text" id="nombreEtapa" name="nombreEtapa" autocomplete="off" required="required" class="form-control nombreEtapa">
                    </div>

                    <div class="form-group">
                        <label>Orden</label>
                        <input type="number" id="orden" name="orden" required="required" autocomplete="off" class="form-control orden">
                    </div>

                    <div class="form-group">
                        <label>Proceso </label>
                        <select name="proceso_Id" class="form-control proceso_Id">
                            <option value="">-Selecciona un proceso-</option>
                            <?php foreach ($proceso as $p): ?>
                                <option value="<?php echo $p->procesoId ?>"><?php echo $p->nombreProceso ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="etapaId" class="etapaId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit ETAPA-->

        <!-- Modal Delete ETAPA-->
        <form action="<?php echo base_url() . '/eliminarEtapa' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Etapa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4>¿Esta seguro que desea eliminar la Etapa: <b><i class="etapaN"></i></b> ?</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="etapaId" class="etapaId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">SI</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Delete ETAPA-->

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
            const orden = $(this).data('orden');
            const proceso = $(this).data('proceso');
            const procesoId = $(this).data('procesoI');

            // Set data to Form Edit
            $('.etapaId').val(id);
            $('.nombreEtapa').val(nombre);
            $('.orden').val(orden);
            $('.proceso_Id').val(procesoId);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.etapaId').val(id);
            $('.etapaN').html(nombre);

            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>
