<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="">
    <div class="x_title">
        <h3>Información de Usuarios</h3>
        <div class="clearfix"></div>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-5 col-sm-5">
            <div class="x_panel">
                <div class="x_title">
                <h2>Género</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-center">
                        <div class="col-md-10" id="pastelG">
                            <canvas id="pastelGChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-5">
            <div class="x_panel">
                <div class="x_title">
                <h2>Estado</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-center">
                        <div class="col-md-10" id="pastelE">
                            <canvas id="pastelEChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>Usuarios por departamento</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    
                </ul>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-center">
                        <div class="col-md-10" id="barChart2">
                            <canvas id="departamentoChart"></canvas>
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

    //PASTEL GÉNERO 
    //get the bar chart canvas
    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
    var ctx = $("#pastelGChart");

    //bar chart data
    var data = {
      labels: cData.label,
      datasets: [
        {
          label: 'Género',
          data: cData.data,
          backgroundColor: [
            "#F597AD",
            "#005161"
          ],
          borderColor: [
            "#F597AD",
            "#005161"
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
          text: 'Total de usuarios por género'
        }
      }
    };

    //create bar Chart class object
    var chart1 = new Chart(ctx, {
      type: 'pie',
      data: data,
      options: options
    });

    //PASTEL ESTADO
    //get the bar chart canvas
    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
    var ctx = $("#pastelEChart");

    //bar chart data
    var data2 = {
      labels: cData.label2,
      datasets: [
        {
          label: 'Estado',
          data: cData.data2,
          backgroundColor: [
            "#0C856B",
            "#CFD6DA"
          ],
          borderColor: [
            "#0C856B",
            "#CFD6DA"
          ],
          borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
        }
      ]
    };

    //options
    var options2 = {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Total de usuarios por estado'
        }
      }
    };

    //create bar Chart class object
    var chart2 = new Chart(ctx, {
      type: 'pie',
      data: data2,
      options: options2
    });
    //////
    //BARRA DEPARTAMENTO
    //get the bar chart canvas
    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
    var ctx = $("#departamentoChart");

    //bar chart data
    var data3 = {
      labels: cData.label3,
      datasets: [
        {
          label: 'Usuarios',
          data: cData.data3,
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
    var options3 = {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Total de usuarios por departamento'
        }
      },
      scales: {
          y: {
            stacked: true,
              ticks: {
                beginAtZero: true,
                  suggestedMin: 5,
                  suggestedMax: 30
              },
              title: {
                display: true,
                text: 'Cantidad de usuarios'
              }
          }
      }
    };

    //create bar Chart class object
    var chart3 = new Chart(ctx, {
      type: 'bar',
      data: data3,
      options: options3
    });
    //////

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