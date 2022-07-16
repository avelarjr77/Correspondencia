<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>


<!-- Reportes -->
<div class="x_panel">
    <div class="x_title">
        <h2>Generar Reportes</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <p>Por favor, seleccione el tipo de reporte que desea generar.</p>
        <div class="">
            <div class="col-md-12 col-sm-12 offset-md-12 right">
                <div class="col-md-1 col-sm-1 "> </div>
                <div class="col-md-8 col-sm-8 ">
                    <select id="url" class="form-control">
                        <option>Seleciona un tipo de reporte</option>
                        <option value="pruebaR">Listado de Procesos del presente mes</option>
                        <option value="promedioActividad">Tiempo Promedio de Finalización de Actividades</option>
                        <option>Option three</option>
                        <option>Option four</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 "> 
                <button type="button" class="btn btn-primary btn-xs btn-reporte">Generar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-reporte').on('click', function() {
            // get data from button edit
            var url = $('#url').val();
            location.href = "<?= base_url()?>/" + url;
        });
    });
</script>

<?= $this->endSection() ?>