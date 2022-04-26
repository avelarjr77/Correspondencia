<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<?php
    $rolModuloMenuId = $datos[0]['rolModuloMenuId'];
    $rol = $datos[0]['rolId'];
?>

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
                                        <form method="POST" action="<?php echo base_url() . '/editRolMM' ?>">                                            <label for="fullname">Rol:</label>
                                            <input type="text" id="rolModuloMenuId" name="rolModuloMenuId" hidden=""  class="form-control"
                                            value="<?php echo $rolModuloMenuId?>">

                                            <input type="text" id="rol" name="rol" required="required" minlength="3" autocomplete="off" class="form-control"
                                            value="<?php echo $rol?>">
                                            <br>
                                            <label>Escoger Menú:</label>
                                            <p style="padding: 5px;"></p>
                                            <select id="select_menu" name="menu" class="form-select">
                                                <option value="" selected>Escoge un menú</option>
                                                < foreach($datos as $key):?>
                                                    <option value="< echo $key->menu ?>"></option>
                                                < endforeach;?>
                                            </select><br>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
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