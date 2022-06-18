<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- Formulario para agregar ROLES -->
<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Roles</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Rol</button>
        <a href="<?= base_url().route_to('adminModulo') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-th"></i> Módulos</a>
        <br>
        <!--LISTADO DE ROLES-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Rol</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $rol): ?>
                    <tr>
                        <td><?= $rol->rolId ?></td>
                        <td><?= $rol->nombreRol ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $rol->rolId ?>" data-nombre="<?= $rol->nombreRol ?>"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $rol->rolId ?>" data-nombre="<?= $rol->nombreRol ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>
        <!--FIN LISTADO ROLES-->

        <!-- Modal Agregar Rol-->
        <form action="<?php echo base_url() . '/crearRol' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del Rol</label>
                        <input type="text" id="nombreRol" name="nombreRol" required="required" autocomplete="off" class="form-control">
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
        <!-- End Modal Agregar Rol-->

        <!-- Modal Edit Rol-->
        <form action="<?php echo base_url() . '/actualizarRol' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Nombre del Rol</label>
                        <input type="text" id="nombreRol" name="nombreRol" autocomplete="off" required="required" class="form-control nombreRol">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rolId" class="rolId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit Rol-->

        <!-- Modal Delete Rol-->
        <form action="<?php echo base_url() . '/eliminarRol' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4>¿Esta seguro que desea eliminar el rol: <b><i class="rol"></i></b> ?</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rolId" class="rolId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">SI</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Delete Rol-->



    </div>
</div>
<!-- End Formulario para agregar ROLES -->
    
<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Rol Agregado con éxito', 'success');
    } else if (mensaje == '1') {
        swal('', 'Falló Agregar Rol', 'error');
    }else if (mensaje == '2') {
        swal('', 'Rol Eliminado con éxito', 'success');
    }else if (mensaje == '3') {
        swal('', 'Falló Eliminar Rol', 'error');
    }else if (mensaje == '4') {
        swal('', 'Rol Actualizado con éxito', 'success');
    }else if (mensaje == '5') {
        swal('', 'Falló Actualizar Rol', 'error');
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
            $('.rolId').val(id);
            $('.nombreRol').val(nombre);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.rolId').val(id);
            $('.rol').html(nombre);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>