<?= $this->extend('/template/admin_template') ?>
<?= $this->section('content') ?>

<?php
    $menuId = $datos[0]['menuId'];
    $nombreMenu = $datos[0]['nombreMenu'];
?>

<div class="container">
<div class="row">
    <!-- Formulario para agregar MENÚ -->
    <div class="x_panel">
        <div class="x_title">
            <h2>Editar menú</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="container">
                <div class="col-md-12 col-sm-12 offset-md-12 right">
                    <form method="POST" action="<?php echo base_url() . '/modAdministracion/MenuSubmenuController/actualizar' ?>">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del Menú<span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="menuId" name="menuId" hidden=""  class="form-control"
                                value="<?php echo $menuId?>">
                                <input type="text" id="nombreMenu" name="nombreMenu" required="required" minlength="3" autocomplete="off" class="form-control"
                                value="<?php echo $nombreMenu?>">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




<?= $this->endSection() ?>
