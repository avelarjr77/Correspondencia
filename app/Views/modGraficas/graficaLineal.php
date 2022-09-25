<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="">
    <div class="x_title">
        <h3>Actividades</h3>
        <div class="clearfix"></div>
    </div>

    <!-- top tiles -->
    <div class="row row justify-content-center text-center">
        <div class="tile_count">
            <div class="col-md-12 col-sm-12  ">
                <div class="col-md-4 col-sm-4  tile_stats_count">
                    <?php foreach($i as $in): ?>
                    <h6 class="count_top"><i class="fa fa-clock-o"></i> Total Actividades Inactivas</h6>
                    <div class="count"><?= $in->total ?></div>
                    <span class="count_bottom">En este mes</span>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4 col-sm-4 tile_stats_count">
                    <?php foreach($p as $pr): ?>
                    <h6 class="count_top"><i class="fa fa-angle-double-right"></i> Total Actividades En Progreso</h6>
                    <div class="count"><?= $pr->total ?></div>
                    <span class="count_bottom">En este mes</span>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4 col-sm-4 tile_stats_count">
                    <?php foreach($f as $fi): ?>
                    <h6 class="count_top"><i class="fa fa-check-square-o"></i> Total Actividades Finalizadas</h6>
                    <div class="count"><?= $fi->total ?></div>
                    <span class="count_bottom">En este mes</span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /top tiles -->

    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Actividades por mes este año</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <canvas id="lineChartL"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-6  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tiempo de finalización de actividades</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-center">
                        <form id="frm_bar3">
                            <div class="col-md-10 form-group">
                                <label for="">Escoge un período de tiempo:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="fecha" class="form-control float-right" id="fecha">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br><br><br>
                                <button type="button" class="btn btn-outline-info" id="btn_filtro_bar3">
                                    <i class="fas fa-chart-line"></i>Graficar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10" id="barChart3" style="display: none">
                            <canvas id="barChartPromedio"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Actividades Asignadas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-center">
                        <form id="frm_bar">
                            <div class="col-md-10 form-group">
                                <label for="">Escoge un período de tiempo:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="fecha" class="form-control float-right" id="calendario">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br><br><br>
                                <button type="button" class="btn btn-outline-info" id="btn_filtro_bar">
                                    <i class="fas fa-chart-line"></i>Graficar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10" id="barChart" style="display: none">
                            <canvas id="barChartActPersona"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/select2/dist/js/select2.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
$(function() {

    $("#fecha").daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "daysOfWeek": [
                "Dom",
                "Lun",
                "Mar",
                "Mie",
                "Jue",
                "Vie",
                "Sab"
            ],
            "monthNames": [
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

    $("#calendario").daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "daysOfWeek": [
                "Dom",
                "Lun",
                "Mar",
                "Mie",
                "Jue",
                "Vie",
                "Sab"
            ],
            "monthNames": [
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

    $('#btn_filtro_bar3').on('click', function() {

        //$('#barChartPromedio').empty();
        $('#barChartPromedio').remove();
        $('#barChart3').append('<canvas id="barChartPromedio"></canvas>');
        $.ajax({
            type: 'GET',
            url: '<?= base_url().route_to('gBarraPromedio') ?>',
            data: $("#frm_bar3").serialize(),
            success: function(response) {

                var dataR = JSON.parse(response);

                console.log(dataR);
                console.log(dataR['label']);
                console.log(dataR['data']);

                //get the bar chart canvas
                //var cData = JSON.parse(`<php echo $chart_data; ?>`);
                var ctx = $("#barChartPromedio");

                //bar chart data
                var data = {
                    labels: dataR['label'],
                    datasets: [{
                        label: 'Días',
                        data: dataR['data'],
                        backgroundColor: [
                            "#26b99a",
                            "#03586A",
                            "#34495E",
                            "#97CD7A",
                            "#CFD4D8",
                            "#036475",
                            "#BCE9E0",
                            "#B3CDD2",
                            "#b1bfc9",
                            "#b3dee2",
                            "#82c9ae",
                        ],
                        borderColor: [
                            "#26b99a",
                            "#03586A",
                            "#34495E",
                            "#97CD7A",
                            "#CFD4D8",
                            "#036475",
                            "#BCE9E0",
                            "#B3CDD2",
                            "#b1bfc9",
                            "#b3dee2",
                            "#82c9ae",
                        ],
                        borderWidth: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
                    }]
                };

                //options
                var options = {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Tiempo de finalización de actividades por persona'
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                beginAtZero: true,
                                type: 'integer',
                                suggestedMin: 5,
                                suggestedMax: 30
                            },
                            title: {
                                display: true,
                                text: 'Cantidad de tiempo (días)'
                            }
                        }
                    }
                };

                //create bar Chart class object
                var chart1 = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options
                });

                $('#barChart3').css("display", "block");
            },
            error: function() {
                swal('¡Error!', 'Error de ejecución del Ajax', 'error');
            }
        });
    });

    $('#btn_filtro_bar').on('click', function() {
        //$('#barChartActPersona').empty();
        $('#barChartActPersona').remove();
        $('#barChart').append('<canvas id="barChartActPersona"></canvas>');

        $.ajax({
            type: 'GET',
            url: '<?= base_url().route_to('gBarraFecha') ?>',
            data: $("#frm_bar").serialize(),
            success: function(response) {

                var dataR = JSON.parse(response);

                console.log(dataR);
                console.log(dataR['label']);
                console.log(dataR['data']);

                //get the bar chart canvas
                //var cData = JSON.parse(`<php echo $chart_data; ?>`);
                var ctx = $("#barChartActPersona");

                //bar chart data
                var data = {
                    labels: dataR['label'],
                    datasets: [{
                        label: 'Actividades',
                        data: dataR['data'],
                        backgroundColor: [
                            "#26b99a",
                            "#03586A",
                            "#34495E",
                            "#97CD7A",
                            "#CFD4D8",
                            "#036475",
                            "#BCE9E0",
                            "#B3CDD2",
                            "#b1bfc9",
                            "#b3dee2",
                            "#82c9ae",
                        ],
                        borderColor: [
                            "#26b99a",
                            "#03586A",
                            "#34495E",
                            "#97CD7A",
                            "#CFD4D8",
                            "#036475",
                            "#BCE9E0",
                            "#B3CDD2",
                            "#b1bfc9",
                            "#b3dee2",
                            "#82c9ae",
                        ],
                        borderWidth: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
                    }]
                };

                //options
                var options = {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Total de actividades asignadas por persona'
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                beginAtZero: true,
                                type: 'integer',
                                suggestedMin: 5,
                                suggestedMax: 30
                            },
                            title: {
                                display: true,
                                text: 'Cantidad de Actividades'
                            }
                        }
                    }
                };

                //create bar Chart class object
                var chart1 = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options
                });

                $('#barChart').css("display", "block");
            },
            error: function() {
                swal('¡Error!', 'Error de ejecución del Ajax', 'error');
            }
        });
    });

    //get the bar chart canvas
    var cData = JSON.parse(`<?php echo $chart_dataL; ?>`);
    var ctx = $("#lineChartL");

    //bar chart data
    var data = {
        labels: cData.label,
        datasets: [{
            label: 'Actividades',
            data: cData.data,
            backgroundColor: [
                "#26b99a",
                "#03586A",
                "#34495E",
                "#26B99A",
                "#CFD4D8",
                "#036475",
                "#BCE9E0",
                "#B3CDD2",
                "#b1bfc9",
                "#b3dee2",
                "#82c9ae",
            ],
            borderColor: [
                "#26b99a",
                "#03586A",
                "#34495E",
                "#26B99A",
                "#CFD4D8",
                "#036475",
                "#BCE9E0",
                "#B3CDD2",
                "#b1bfc9",
                "#b3dee2",
                "#82c9ae",
            ],
            borderWidth: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
        }]
    };

    //options
    var options = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Total de actividades por mes este año'
            }
        },
        scales: {
            y: {
                stacked: true,
                ticks: {
                    beginAtZero: true,
                    suggestedMin: 5,
                    suggestedMax: 15
                },
                title: {
                    display: true,
                    text: 'Cantidad de Actividades'
                }
            }
        }
    };

    //create bar Chart class object
    var chart1 = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });

});
</script>

<?= $this->endSection() ?>