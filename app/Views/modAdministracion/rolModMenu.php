<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Listado<b> de Rol-Módulo</b></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
                                        <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5px;"></th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 266px;">ROL/MÓDULO</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 80px;">ADMIN MENÚ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($datos as $key): ?>
                                                    <tr role="row" class="odd">
                                                        <td><?= $key->id ?></td>
                                                        <td><?= $key->rol ?>/<?= $key->modulo ?></td>
                                                        <td>
                                                            <button href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $key->id ?>" data-modulo="<?= $key->modulo ?>" data-moduloId="<?= $key->moduloId ?>" data-menu="<?= $key->menu ?>" data-rol="<?= $key->rol ?>"><i class="fa fa-plus"></i>  Agregar Menú</button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL -->
            
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar menú a <i id="nomRol"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?php echo base_url() . '/editarRolMM' ?>" method="POST">
                        <input type="hidden" name="rolModuloMenuId" class="rolModuloMenuId">

                        <div class="form-group">
                            <label>Rol:</label>
                            <input type="text" id="rolId" name="rolId" class="form-control rolId" readonly>
                        </div><br>
                        
                        <div class="form-group">
                            <input type="text" id="modulo" name="modulo" class="form-control moduloId" hidden>
                        </div>

                        <div class="form-group">
                            <label>Listado de menús en <i id="nomModulo"></i></label>
                            <select name="menuId" class="form-control menuId">
                                <option value="">-Selecciona un menú-</option>
                                <!--<php foreach ($modMenu as $menu): ?>
                                    <option value="<= $menu->id ?>"><= $menu->nomMenu ?></option>
                                <php endforeach; ?>-->
                            </select>
                        </div>         

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                    <br>

                    <label>Menús que posee <i id="nRol"></i>:</label>
                    <table id="datatable" class="display " style="width: 100%;" role="grid">
                        <tbody>
                            <?php foreach ($datos as $key): ?>
                                <tr role="row">
                                    <td><?php echo $key->menu ?></td>
                                    <td><a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->menu ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            </div>
            <!--END MODAL -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>

    $(document).ready(function(){

        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            var rol = $(this).data('rol');
            var modulo = $(this).data('modulo');
            var moduloId = $(this).data('moduloId');
            var menu = $(this).data('menu');
            //const nombre = $(this).data('nombre');

            // Set data to Form Edit
            $('.rolId').val(rol);
            $('.menuId').val(menu).trigger('change');
            $('.moduloId').val(modulo);
            $('.rolModuloMenuId').val(id);
            //$('.nombreRol').val(nombre);*/

           //console.log(modulo);
            //var mod = $('#mod').val();
            //console.log(modulo);
            //let url="<php echo base_url('rolModMenu'); ?>";
            //let url="<= base_url().route_to('rolModMenu') ?>";

            /*var data = 
                'moduloId' : $(this).data('moduloId')
            }*/

            $.ajax({
                type: "POST",
                url: "<?= base_url().route_to('editRolMM') ?>",
                data: {'moduloId' : $(this).data('moduloId')},
                success:function(data){
                    alert(data);
                }
            }); 

            $('#nomRol').html(rol);
            $('#nRol').html(rol);
            $('#nomModulo').html(modulo);
            $('#nomMenu').html(menu);
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