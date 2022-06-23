<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Gráficas</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
            <h2>Bar graph <small>Sessions</small></h2>
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
                <div class="row justify-content-center">
                    <form id="frm_bar">
                        <div class="col-md-10 form-group">
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
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
            <div class="x_title">
            <h2>Radar <small>Sessions</small></h2>
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
            <canvas id="canvasRadar"></canvas>
            </div>
        </div>
        </div>

        <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
            <div class="x_title">
            <h2>Donut Graph <small>Sessions</small></h2>
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
            <canvas id="canvasDoughnut"></canvas>
            </div>
        </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
            <div class="x_title">
            <h2>Pie Graph Chart <small>Sessions</small></h2>
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
            <canvas id="pieChart"></canvas>
            </div>
        </div>
        </div>

        <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
            <div class="x_title">
            <h2>Pie Area Graph <small>Sessions</small></h2>
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
            <canvas id="polarArea"></canvas>
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
  $(function(){

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

    //var fechas = $("#fecha").val();

    $('#btn_filtro_bar').on('click',function(){
        $.ajax({
            type: 'GET',
            url: '<?= base_url().route_to('gBarraFecha') ?>', 
            data: $("#frm_bar").serialize(),
            success: function(response){ 

                /* var dataR = JSON.parse(response);

                console.log(dataR); */

                //get the bar chart canvas
                var cData = JSON.parse(`<?php echo $chart_data; ?>`);
                var ctx = $("#barChartActPersona");
            
                //bar chart data
                var data = {
                    labels: cData.label,
                    datasets: [
                    {
                        label: 'Persona',
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
                        borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
                    }
                    ]
                };
            
                //options
                var options = {
                    responsive: true,
                    title: {
                    display: true,
                    position: "top",
                    text: "Total de actividades por persona",
                    fontSize: 18,
                    fontColor: "#111"
                    },
                    legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 10,
                                suggestedMax: 30
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Cantidad de Actividades'
                            }
                        }]
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
            error: function(){
                swal('¡Error!','Error de ejecución del Ajax', 'error');
            }
        }); 
    }); 
 
  });
</script>

<?= $this->endSection() ?>