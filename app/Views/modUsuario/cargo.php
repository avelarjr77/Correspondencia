<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Cargos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Cargo</button>
        <br>
        <!--LISTADO DE CARGO-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Cargo</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $key): ?>
                    <tr>
                        <td><?php echo $key->cargoId ?></td>
                        <td><?php echo $key->cargo ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->cargoId ?>" data-nombre="<?php echo $key->cargo ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->cargoId ?>" data-nombre="<?php echo $key->cargo ?>"><i class="fa fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?> 

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO CARGO-->

        <!-- Modal Agregar CARGO-->
        <form action="<?php echo base_url() . '/crearCargo' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del Cargo</label>
                        <input type="text" id="cargo" name="cargo" required="required" autocomplete="off"  minlength="3" maxlength="45" class="form-control">
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
        <!-- End Modal Agregar CARGO-->

        <!-- Modal Edit Cargo-->
        <form action="<?php echo base_url() . '/actualizarCargo' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del Cargo</label>
                        <input type="text" id="cargo" name="cargo" autocomplete="off" required="required" class="form-control cargo">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="cargoId" class="cargoId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit CARGO-->

        <!-- Modal Delete CARGO-->
        <form action="<?php echo base_url() . '/eliminarCargo' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4>¿Esta seguro que desea eliminar el Cargo: <b><i class="cargoN"></i></b> ?</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="cargoId" class="cargoId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">SI</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Delete CARGO-->



    </div>
</div>

    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Cargo agregado', 'success');
    } else if (mensaje == '1') {
        swal('No se agrego', 'El cargo ya existe en la base de datos', 'error');
    }else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    }else if (mensaje == '3') {
        swal('', 'No se Elimino Registro', 'error');
    }else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    }else if (mensaje == '5') {
        swal('No se actualizo', 'Datos incorrectos', 'error');
    }else if (mensaje == '6') {
        swal('No se agrego', 'El nombre cargo no debe contener numeros o signos', 'error');
    }
</script>
<!--
<script type="text/javascript">
    let mensaje = '<?php //echo $mensaje ?>';
    if (mensaje == '0') {
        swal({
            text: "¡Cargo agregado!",
            icon: "success",
            button: "Ok",
        });

    } else if (mensaje == '1') {
        swal({
            text: "¡Lo sentimos, no se agrego!",
            icon: "error",
            button: "Ok",
        });
    } else if (mensaje == '2') {
        swal({
            text: "¡Se ha eliminado!",
            icon: "success",
            button: "Ok",
        });
    } else if (mensaje == '3') {
        swal({
            text: "¡Lo sentimos, no se eliminó!",
            icon: "error",
            button: "Ok",
        });
    } else if (mensaje == '4') {
        swal({
            icon: 'success',
            text: '¡Actualizado con exito!',
            button: "Ok"
        });
    } else if (mensaje == '5') {
        swal({
            icon: 'error',
            title: 'Oops...',
            text: 'No se actualizo', 'Datos incorrectos',  'error'
        });
    }  else if (mensaje == '6') {
        swal({
            icon: 'success',
            text: '¡Actualizado con exito!',
            button: "Ok"
        });
    }
    
</script>
-->

<script>
    $(document).ready(function(){

        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.cargoId').val(id);
            $('.cargo').val(nombre);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.cargoId').val(id);
            $('.cargoN').html(nombre);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>
