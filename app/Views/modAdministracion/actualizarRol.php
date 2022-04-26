<?= $this->extend('/template/admin_template') ?>
<?= $this->section('content') ?>

<?php
$rolId = $datos[0]['rolId'];
$nombreRol = $datos[0]['nombreRol'];
?>

<div class="container">
<div class="row">
    <!-- Formulario para agregar MENÚ -->
    <div class="x_panel">
        <div class="x_title">
            <h2>Editar rol</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="container">
                <div class="col-md-12 col-sm-12 offset-md-12 right">
                    <form method="POST" action="<?php echo base_url() . '/modAdministracion/RolController/actualizar' ?>">
                        <div class="item form-group">
                                <input type="text" id="rolId" name="rolId" hidden=""  class="form-control"
                                value="<?php echo $rolId?>">
                                <input type="text" id="nombreRol" name="nombreRol" required="required" minlength="3" autocomplete="off" class="form-control"
                                value="<?php echo $nombreRol?>">
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
