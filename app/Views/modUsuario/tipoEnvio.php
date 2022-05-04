<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Tipo de Envio</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar tipo de envio</button>
        <br>
        <!--LISTADO DE TIPO DE ENVIO-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de tipo de envio</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $key): ?>
                    <tr>
                        <td><?php echo $key->tipoEnvioId ?></td>
                        <td><?php echo $key->tipoEnvio ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->tipoEnvioId ?>" data-nombre="<?php echo $key->tipoEnvio ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->tipoEnvioId ?>" data-nombre="<?php echo $key->tipoEnvio ?>"><i class="fa fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?> 

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO TIPO DE ENVIO-->

        <!-- Modal Agregar TIPO DE ENVIO-->
        <form action="<?php echo base_url() . '/crearTipoEnvio' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar tipo de envio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del tipo de envio</label>
                        <input type="text" id="tipoEnvio" name="tipoEnvio" required="required" autocomplete="off" class="form-control">
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
        <!-- End Modal Agregar TIPO DE ENVIO-->

        <!-- Modal Edit TIPO DE ENVIO-->
        <form action="<?php echo base_url() . '/actualizarTipoEnvio' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar tipo de envio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del tipo de envio</label>
                        <input type="text" id="tipoEnvio" name="tipoEnvio" autocomplete="off" required="required" class="form-control tipoEnvio">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tipoEnvioId" class="tipoEnvioId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit TIPO DE ENVIO-->

        <!-- Modal Delete TIPO DE ENVIO-->
        <form action="<?php echo base_url() . '/eliminarTipoEnvio' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar tipo Envio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4>¿Esta seguro que desea eliminar el tipo de envio: <b><i class="tipoEnvio"></i></b> ?</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tipoEnvioId" class="tipoEnvioId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">SI</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Delete TIPO DE ENVIO-->



    </div>
</div>

    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal(':D', 'Cargo agregado', 'success');
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

            // Set data to Form Edit
            $('.tipoEnvioId').val(id);
            $('.tipoEnvio').val(nombre);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.tipoEnvioId').val(id);
            $('.tipoEnvio').html(nombre);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>