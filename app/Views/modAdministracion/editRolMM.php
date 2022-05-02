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
                                                    <?php foreach ($modMenu as $menu): ?>
                                                        <option value="<?= $menu->id ?>"><?= $menu->nomMenu ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>         

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Editar</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>
                                    <div class="col-sm-12">
                                        <form action="" method="POST">
                                            <label>Menús que posee <i id="nRol"></i>:</label>
                                            <table id="datatable" class="display " style="width: 100%;" role="grid">
                                                <tbody>
                                                    <?php foreach ($modMenu as $key): ?>
                                                        <tr role="row">
                                                            <td><?php echo $key->nomMenu ?></td>
                                                            <td><a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->menu ?>"><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </form>
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