<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Listado<b> de Rol_Modulo</b></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="<?php echo base_url() . '/editRol' ?>" method="POST">
                                            <input type="hidden" name="rolModuloMenuId" class="rolModuloMenuId">

                                            <div class="form-group">
                                                <!--<label>Rol: </label><= $rol->rol ?>-->
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="text" id="modulo" name="modulo" class="form-control moduloId" hidden>
                                            </div>

                                            <div class="form-group">
                                                <label>Listado de menús en </label><!--<= $modMenu->modulo ?>-->
                                                <?php foreach ($modMenu as $menu): ?>
                                                    <div class="form-check">
                                                        <input type="hidden" name="rolId" class="rolModuloMenuId" value="<?= $menu->rolId ?>">
                                                        <input class="form-check-input" type="checkbox" name="menu[]" value="<?= $menu->idM ?>">
                                                        <label class="form-check-label"><?= $menu->nomMenu ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>         

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Agregar</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>
                                    <div class="col-sm-12">
                                        <form action="" method="POST">
                                            <label>Menús que posee <i id="nRol"></i>:</label>
                                            <table id="datatable" class="display " style="width: 100%;" role="grid">
                                                <tbody>
                                                    <?php foreach ($rolMenu as $key): ?>
                                                        <tr role="row">
                                                            <td><?= $key->menu ?></td>
                                                            <td><a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" data-nombre="<?= $key->menu ?>"><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- Modal Delete Menu-->
                                    <form action="<?php echo base_url() . '/eliminarR' ?>" method="POST">
                                        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Menú</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            
                                            <h4>¿Esta seguro que desea eliminar el Menú: <b><i class="menuN"></i></b> ?</h4>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="rolModuloMenuId" class="rolModuloMenuId">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-primary">SI</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    <!-- End Modal Delete Menu-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>

<script>

    $(document).ready(function(){

        // get Edit Product
        /*$'.btn-edit').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            var modulo = $(this).data('modulo');
            var moduloId = $(this).data('mod');
            var menu = $(this).data('menu');
            var menuId = $(this).data('mn');
            var rol = $(this).data('rol');
            var rolId = $(this).data('rmm');
            //const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.rolId').val(rol);
            $('.rolModuloMenuId').val(id);


            $('#nomRol').html(rol);
            $('#nomRol').css("font-weight","bold");
            $('#nomRol').css("color","#010806");
            $('#nRol').html(rol);
            $('#nRol').css("color","#010806");
            $('#nRol').css("font-weight","bold");
            $('#nomModulo').html(modulo);
            $('#nomModulo').css("color","#010806");
            $('#nomMenu').html(menu);
            // Call Modal Edit
            //$('#editModal').modal('show');

        });*/

        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            var idR = $(this).data('id');
            var nombreM = $(this).data('nombre');
            // Set data to Form Edit
            $('.rolModuloMenuId').val(idR);
            $('.menuM').html(nombreM);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>


<?= $this->endSection() ?>
