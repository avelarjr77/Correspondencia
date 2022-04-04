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
                                    </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>