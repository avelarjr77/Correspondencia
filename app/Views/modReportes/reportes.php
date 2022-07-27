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
    <div class="x_content" id="reportes">
        <p>Por favor, seleccione el tipo de reporte que desea generar.</p>
        <div class="">
            <div class="col-md-12 col-sm-12 offset-md-12 right">
                <div class="col-md-1 col-sm-1 "> </div>
                <div class="col-md-8 col-sm-8 ">
                    <select id="url" class="form-control">
                        <option disabled selected>Seleciona un tipo de reporte</option>
                        <option value="pruebaR">Listado de Procesos del mes de <?php echo $mes ?></option>
                        <option value="promedioActividad">Tiempo Promedio de Finalización de Actividades</option>
                        <option value="procesoDetalle">Flujo de Procesos del mes de <?php echo $mes ?></option>
                        <option value="vistaDetalle">Detalle de usuarios en el sistema</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 "> 
                <button type="button" class="btn btn-primary btn-xs btn-reporte">Generar</button>
                </div>
            </div>
        </div><br><br><br><br><br>

        <button class="btn btn-info abrir-menu" type="button"><i class="fa fa-bars"></i> Reportes Personalizados</button>
    </div>
    
    <div id="menu" style="display: none">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Reporte Por Proceso</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Reporte de procesos por período de tiempo</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Flujo de Actividades por Proceso</a>
        </li>
        </ul>

        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container" id="personalizado" >
                <br><br>
                <form action="<?= base_url() . route_to('procesoUnico') ?>" id="frmProceso" method="POST">
                    <div class="col-md-12 col-sm-12 offset-md-12 right">
                        <p>Por favor, seleccione el proceso del reporte que desea generar.</p>
                        <div class="col-md-6 col-sm-6 ">
                            <select name="procesoId" id="proceso" class="form-control">
                                <option disabled selected>Seleciona un proceso</option>
                                <?php foreach($datos as $d): ?>
                                    <option value="<?= $d->procesoId ?>"><?= $d->proceso ?></option>
                                <?php endforeach; ?> 
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 "> 
                        <button type="submit" class="btn btn-primary btn-xs">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container" id="tiempo" >
                <br><br>
                <form action="<?= base_url() . route_to('procesoTiempo') ?>" id="frmProcesoTiempo" method="POST">
                    <div class="col-md-12 col-sm-12 offset-md-12 right">
                        <div class="col-md-6 col-sm-6 ">
                            <label for="">Escoge un período de tiempo para mostrar el flujo de los procesos:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="text" name="fecha" class="form-control float-right" id="fecha">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 "> 
                            <br><br><br>
                        <button type="submit" class="btn btn-primary btn-xs">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="container" id="actividadesP" >
                <br><br>
                <form action="<?= base_url() . route_to('flujoActividad') ?>" id="frmProcesoAct" method="POST">
                    <div class="col-md-12 col-sm-12 offset-md-12 right">
                        <p>Por favor, seleccione el proceso del reporte que desea generar.</p>
                        <div class="col-md-6 col-sm-6 ">
                            <select name="procesoId" id="procesoAct" class="form-control">
                                <option disabled selected>Seleciona un proceso</option>
                                <?php foreach($datos as $d): ?>
                                    <option value="<?= $d->procesoId ?>"><?= $d->proceso ?></option>
                                <?php endforeach; ?> 
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 "> 
                        <button type="submit" class="btn btn-primary btn-xs">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <br><br><br>
        <a href="#" class="btn btn-outline-secondary mb-2 volver"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>

</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $("#fecha").daterangepicker({
            "locale":{
                "format":"DD/MM/YYYY",
                "separator":" - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "daysOfWeek":[
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sab"
                ],
                "monthNames":[
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ]
            }
        });

        $('.btn-reporte').on('click', function() {
            // get data from button edit
            var url = $('#url').val();
            location.href = "<?= base_url()?>/" + url;
        });

        $('.btn-proceso').on('click', function() {
            // get data from button edit
            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('procesoUnico') ?>",
                data: $("#frmProceso").serialize(),
                success: function(data) {

                    var dataEEtapaC = JSON.parse(data);
                    console.log(dataEEtapaC); 
                }
            });
        });

        $('.abrir-menu').on('click', function() {
            $('#menu').css("display", "block");
            $('#reportes').hide();
        });

        $('.volver').on('click',function(){
            $('#reportes').css("display", "block");
            $('#menu').hide();
        });
    });
</script>

<?= $this->endSection() ?>