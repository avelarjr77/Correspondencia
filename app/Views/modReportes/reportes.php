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

        <div >
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#procesoUnico" role="tab" aria-controls="home" aria-selected="true">Reporte Por Proceso</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#flujoEtapa" role="tab" aria-controls="contact" aria-selected="false">Etapas por Proceso</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#flujoAct" role="tab" aria-controls="contact" aria-selected="false">Actividades por Proceso</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tiempo" role="tab" aria-controls="profile" aria-selected="false">Procesos por período de tiempo</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tiempoAct" role="tab" aria-controls="profile" aria-selected="false">Actividades por período de tiempo</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#usuario" role="tab" aria-controls="profile" aria-selected="false">Usuarios</a>
            </li>
            </ul>

            <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="procesoUnico" role="tabpanel" aria-labelledby="home-tab">
                <div class="container" id="personalizado" >
                    <br><br>
                    <form id="frmProceso" method="POST">
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
                            <button type="button" class="btn btn-primary btn-xs btn-proceso">Generar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="flujoEtapa" role="tabpanel" aria-labelledby="contact-tab">
                <div class="container" id="etapaP" >
                    <br><br>
                    <form id="frmProcesoEt" method="POST">
                        <div class="col-md-12 col-sm-12 offset-md-12 right">
                            <p>Por favor, seleccione el proceso del reporte que desea generar.</p>
                            <div class="col-md-6 col-sm-6 ">
                                <select name="procesoId" id="procesoAct" class="form-control">
                                    <option disabled selected>Seleciona un proceso</option>
                                    <?php foreach($datos as $et): ?>
                                        <option value="<?= $et->procesoId ?>"><?= $et->proceso ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </div>

                            <div>
                                <input type="text" hidden value="flujoEtapa" id="url3">
                            </div>
                            <div class="col-md-3 col-sm-3 "> 
                                <button type="button" class="btn btn-primary btn-xs btn-etapa">Generar</button>
                                <!-- <a href="#" type="button" class="btn btn-primary btn-xs btn-proceso" hidden>Generar</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="flujoAct" role="tabpanel" aria-labelledby="contact-tab">
                <div class="container" id="actividadesP" >
                    <br><br>
                    <form id="frmProcesoAct" method="POST">
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

                            <div>
                                <input type="text" hidden value="flujoActividad" id="url2">
                            </div>
                            <div class="col-md-3 col-sm-3 "> 
                                <button type="button" class="btn btn-primary btn-xs btn-actividad">Generar</button>
                                <!-- <a href="#" type="button" class="btn btn-primary btn-xs btn-proceso" hidden>Generar</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="tiempo" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container" id="tiempo" >
                    <br><br>
                    <form id="frmProcesoTiempo" method="POST">
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
                            <button type="button" class="btn btn-primary btn-xs btn-tiempo">Generar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="tiempoAct" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container" id="tiempoAct" >
                    <br><br>
                    <form id="frmProcesoTiempoAct" method="POST">
                        <div class="col-md-12 col-sm-12 offset-md-12 right">
                            <div class="col-md-6 col-sm-6 ">
                                <label for="">Escoge un período de tiempo para mostrar el flujo de las actividades:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="fechaAct" class="form-control float-right" id="fechaAct">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 "> 
                                <br><br><br>
                            <button type="button" class="btn btn-primary btn-xs btn-tiempoAct">Generar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="usuario" role="tabpanel" aria-labelledby="contact-tab">
                <div class="container" id="usuarioP" >
                    <br><br>
                    <form id="frmusuarioP" method="POST">
                        <div class="col-md-12 col-sm-12 offset-md-12 right">
                            <p>Al dar clic en cada botón se generará un reporte con la información respectiva.</p>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-secondary btn-reporte">Información General</button>
                                <button type="button" class="btn btn-secondary btn-reporteD">Desempeño de usuarios por proceso</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>

            <br><br><br>
        </div>
    
    </div>

</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        Swal.fire(
        'Error',
        'No hay datos para mostrar en ese rango de fechas',
        'error'
        );
    }else if (mensaje == '1'){
        Swal.fire(
        'Error',
        'No hay datos para mostrar',
        'error'
        );
    }
</script>

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

        $("#fechaAct").daterangepicker({
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
            //var url = $('#url').val();
            location.href = "<?= base_url()?>/" + 'vistaDetalle';
        });

        $('.btn-reporteD').on('click', function() {
            //var url = $('#url').val();
            location.href = "<?= base_url()?>/" + 'usuarioD';
        });

        $('.btn-proceso').on('click', function() {
            var vl = $("#frmProceso").serializeArray();
            var valor = vl[0]['value']
            console.log(valor);
            location.href = "<?= base_url()?>/" +"modReportes"+"/"+"ProcesoUnicoController"+"/"+"index"+"/"+valor;
        });

        $('.btn-rendimientoU').on('click', function() {
            var vl = $("#frmRendimientoP").serializeArray();
            var valor = vl[0]['value']
            console.log(valor);
            location.href = "<?= base_url()?>/" +"modReportes"+"/"+"ProcesoDetalleController"+"/"+"index"+"/"+valor;
        });

        $('.btn-tiempo').on('click', function() {
            var vl = $("#frmProcesoTiempo").serializeArray();
            var valor = vl[0]['value'];
            var f = valor.split(" - ");
            //var fechas = ""+f+""
            //var fe = fechas[0]+fechas[1];

            var fechaI = f[0];
            var fechaF = f[1];

            var fi = fechaI.split("/");

            var fic= ""+fi[2]+"-"+fi[1]+"-"+fi[0]+"";

            var ff = fechaF.split("/");

            var ffc= ""+ff[2]+"-"+ff[1]+"-"+ff[0]+"";

            var fechas = ""+fic+"a"+ffc+"";

            console.log(fic, ffc);
            location.href = "<?= base_url()?>/" +"modReportes"+"/"+"ProcesoTiempoController"+"/"+"index"+"/"+fechas;
        });

        $('.btn-tiempoAct').on('click', function() {
            var vl = $("#frmProcesoTiempoAct").serializeArray();
            var valor = vl[0]['value'];
            var f = valor.split(" - ");
            //var fechas = ""+f+""
            //var fe = fechas[0]+fechas[1];

            var fechaI = f[0];
            var fechaF = f[1];

            var fi = fechaI.split("/");

            var fic= ""+fi[2]+"-"+fi[1]+"-"+fi[0]+"";

            var ff = fechaF.split("/");

            var ffc= ""+ff[2]+"-"+ff[1]+"-"+ff[0]+"";

            var fechas = ""+fic+"a"+ffc+"";

            console.log(fic, ffc);
            location.href = "<?= base_url()?>/" +"modReportes"+"/"+"ProcesoTiempoActController"+"/"+"index"+"/"+fechas;
        });

        $('.btn-actividad').on('click', function() {
            var vl = $("#frmProcesoAct").serializeArray();
            var valor = vl[0]['value']
            console.log(valor);
            location.href = "<?= base_url()?>/" +"modReportes"+"/"+"FlujoActividadesController"+"/"+"index"+"/"+valor;
        });

        $('.btn-etapa').on('click', function() {
            var vl = $("#frmProcesoEt").serializeArray();
            var valor = vl[0]['value']
            console.log(valor);
            location.href = "<?= base_url()?>/" +"modReportes"+"/"+"FlujoEtapaController"+"/"+"index"+"/"+valor;
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