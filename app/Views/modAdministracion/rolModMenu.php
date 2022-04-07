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
                                    <div class="col-sm-6">
                                        <div class="dataTables_length" id="datatable_length"><label>Show <select name="datatable_length" aria-controls="datatable" class="form-control input-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable"></label></div>
                                    </div>
                                </div>
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
                                                        <td><?php echo $key->rolModuloMenuId ?></td>
                                                        <td><?php echo $key->rol ?>/<?php echo $key->modulo ?></td>
                                                        <td>
                                                        <a type="submit" class="btn btn-info" href="<?php echo base_url() . '/modAdministracion/RolModMenuController/obtenerId/' . $key->rolModuloMenuId ?>"><i class="fa fa-plus"></i>  Agregar Menú</a>                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!--MODAL -->
                                <div class="modal" id="modalEditar" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Agregar menú a </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- start form for validation -->
                                                <form id="updateForm" data-bs-action="rolModMenu/update" data-parsley-validate>
                                                    <label for="fullname">Rol:</label>
                                                        <select name="rol" class="form-control select_rol">
                                                            <?php foreach ($datos as $key) : ?>
                                                                <option value="<?= $key->rol;?>"></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <br>
                                                    <label>Listados de Menú en :</label>
                                                    <p style="padding: 5px;">
                                                        <select multiple id="select_menu" name="product_category" class="form-control">
                                                            <option value="">-Select-</option>
                                                            <?php foreach($datos as $key):?>
                                                                <option value="<?php echo $key->menu ?>"></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        <br>
                                                        <span class="btn btn-primary">Guardar</span>
                                                </form>
                                                <!-- Tabla para mostrar menus que posee el Usuario -->
                                                <div class="x_content">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Menus</th>
                                                                <th>Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Plan de Estudios</td>
                                                                <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Expedientes Graduados</td>
                                                                <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Calificación Institucional</td>
                                                                <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- end form for validations -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END MODAL -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>