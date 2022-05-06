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
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 266px;">ROL/MÓDULO/MENÚ</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 80px;">ADMIN MENÚ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($datos as $key): ?>
                                                    <tr role="row" class="odd">
                                                        <td><?= $key->id ?></td>
                                                        <td><?= $key->rol ?>/<?= $key->modulo ?>/<?= $key->menu ?></td>
                                                        <td>
                                                            <button href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $key->id ?>" data-rmm="<?= $key->rolId ?>" data-modulo="<?= $key->modulo ?>" data-mod="<?= $key->moduloId ?>" data-menu="<?= $key->menu ?>" data-mn="<?= $key->menuId ?>" data-rol="<?= $key->rol ?>"><i class="fa fa-plus"></i>  Agregar Menú</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar menú</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?php echo base_url() . '/editRol' ?>" method="POST">
                        <input type="hidden" name="rolModuloMenuId" class="rolModuloMenuId">

                        <div class="form-group">
                            <label>Rol: <i id="nomRol"></i></label>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" id="modulo" name="modulo" class="form-control moduloId" hidden>
                        </div>

                        <div class="form-group">
                            <label>Listado de menús en <b><i id="nomModulo"></i></b></label>
                            <div id="menuId" name="menus[]" >
                                
                            </div>
                        </div> 
                        <br>        

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                    <br>

                    <label>Menús que posee <i id="nRol"></i>:</label>
                    <table id="datatable" class="display " style="width: 100%;" role="grid">
                        <tbody>
                            <tr id="rolMenu" role="row">

                            </tr>
                        </tbody>
                    </table>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            </div>
            <!--END MODAL -->

            <!-- Modal Delete Rol-->
        <form action="<?php echo base_url() . '/eliminarRolMM' ?>" method="POST">
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
                
                <h4>¿Esta seguro que desea eliminar el menú: <b><i class="rol"></i></b> ?</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="moduloMenuId" class="moduloMenuId">
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

            //console.log(rolId, moduloId, menuId); 
            var menus = $("#menuId");
            var roles = $("#rolMenu");

            $.ajax({
                type: "GET",
                url: "<?= base_url().route_to('editRolMM') ?>",
                data: {moduloId : moduloId},
                success:function(data){

                    var dataObj = JSON.parse(data);

                    $.each(dataObj, function(index, val) {
                        //console.log(val.idM);
                        //console.log(val.nomMenu);

                        menus.append("<div class='form-check'><input class='form-check-input' type='checkbox' name='menu[]' value='"+val.idM+"'>"+
                                "<label class='form-check-label'>"+ val.nomMenu+"</label></div>")
                    });
                }
            }); 

            $.ajax({
                type: "GET",
                url: "<?= base_url().route_to('menuList') ?>",
                data: {menuId: menuId},
                success:function(data){

                    var dataObj = JSON.parse(data);

                    $.each(dataObj, function(index, val) {
                        roles.append('<td>'+val.menu+'</td>'+
                        '<td><button id"borrar" class="btn btn-danger btn-sm btn-delete" data-idr="'+val.id+'" data-nombrer="'+val.menu+'"><i class="fa fa-trash"></i></button></td>')
                        
                    });
                }
            });
            
            $.ajax({
                type: "GET",
                url: "<?= base_url().route_to('editRol') ?>",
                data: {rolId: rolId},
                success:function(data){
                    
                    //var dataObj = JSON.parse(data);
                    alert(data);

                    /*$.each(dataObj, function(index, val) {
                        roles.append('<td>'+val.menu+'</td>'+
                        '<td><button id"borrar" class="btn btn-danger btn-sm btn-delete" data-idr="'+val.id+'" data-nombrer="'+val.menu+'"><i class="fa fa-trash"></i></button></td>')
                        
                    });*/
                }
            });

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
            $('#editModal').modal('show');

        });

        // get Delete Product
        $('#borrar').on('click',function(){
            alert("entró");
            // get data from button edit
            //var idR = $(this).data('idr');
            //var nombreM = $(this).data('nombrer');
            // Set data to Form Edit
            //$('.moduloMenuId').val(idR);
            //$('.rol').html(nombreM);
            // Call Modal Edit
            //$('#editModal').modal("hide");
            //$('#eliminarModal').modal('show');
        });
        
    });
</script>



<?= $this->endSection() ?>