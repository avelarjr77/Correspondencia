<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="">
    <div class="x_title">
        <h3>Procesos</h3>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>

    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>Tiempo de demora por proceso</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-center">
                        <form id="frm_bar2">
                            <div class="col-md-10 form-group">
                            <label for="">Escoge un período de tiempo:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="calendario" class="form-control float-right" id="calendario">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br><br><br>
                                <button type="button" class="btn btn-outline-info" id="btn_filtro_bar2">
                                    <i class="fas fa-chart-line"></i>Graficar 
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10" id="barChart2" style="display: none">
                            <canvas id="barChartProceso"></canvas>
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

    $("#calendario").daterangepicker({
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
                    datasets: [
                    {
                        label: 'Persona',
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
                        borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
                    }
                    ]
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

    $('#btn_filtro_bar2').on('click',function(){
        $('#barChartProceso').remove(); 
        $('#barChart2').append('<canvas id="barChartProceso"></canvas>');

        $.ajax({
            type: 'GET',
            url: '<?= base_url().route_to('gBarraProceso') ?>', 
            data: $("#frm_bar2").serialize(),
            success: function(response){ 

                var dataP = JSON.parse(response);

                console.log(dataP);
                console.log(dataP['label']);
                console.log(dataP['data']);

                //get the bar chart canvas
                //var cData = JSON.parse(`<php echo $chart_data; ?>`);
                var ctx = $("#barChartProceso");
            
                //bar chart data
                var data = {
                    labels: dataP['label'],
                    datasets: [
                    {
                        label: 'Tiempo',
                        data: dataP['data'],
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
                        borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
                    }
                    ]
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
                            text: 'Tiempo de demora por proceso'
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                beginAtZero: true,
                                type: 'integer',
                                suggestedMin: 5,
                                suggestedMax: 15
                            },
                            title: {
                                display: true,
                                text: 'Cantidad de Tiempo (minutos)'
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

                $('#barChart2').css("display", "block");
            }, 
            error: function(){
                swal('¡Error!','Error de ejecución del Ajax', 'error');
            }
        }); 
    }); 
 
  });
</script>

<?= $this->endSection() ?>