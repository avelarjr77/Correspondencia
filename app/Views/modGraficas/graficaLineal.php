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
      <div class="top_tiles">
        <div class="animated flipInY col-md-4 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-clock-o"></i></div>
              <?php foreach($i as $in): ?>
                <div class="count"><?= $in->total ?></div>
                <h5>Total Estados <?= $in->estado ?>s</h5>
              <?php endforeach; ?>
          </div>
        </div>
        <div class="animated flipInY col-md-4 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-angle-double-right"></i></div>
              <?php foreach($p as $pr): ?>
                <div class="count"><?= $pr->total ?></div>
                <h5>Total Estados <?= $pr->estado ?></h5>
              <?php endforeach; ?>
          </div>
        </div>
        <div class="animated flipInY col-md-4 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square-o"></i></div>
              <?php foreach($f as $fi): ?>
                <div class="count"><?= $fi->total ?></div>
                <h5>Total Estados <?= $fi->estado ?>s</h5>
              <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
            <h2>Line graph<small>Sessions</small></h2>
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
                    <div class="col-md-4 form-group">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fa fa-calendar"></i>
                              </span>
                          </div>
                          <input type="text" class="form-control float-right" id="fecha">
                      </div>
                    </div>
                    <div class="col-md-10">
                        <canvas id="lineChartL"></canvas>
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

    /* $("#fecha").daterangepicker({
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
    }); */

    //get the bar chart canvas
    var cData = JSON.parse(`<?php echo $chart_dataL; ?>`);
    var ctx = $("#lineChartL");

    //bar chart data
    var data = {
      labels: cData.label,
      datasets: [
        {
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
        text: "Total de actividades por mes",
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
                  suggestedMin: 5,
                  suggestedMax: 15
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
      type: 'pie',
      data: data,
      options: options
    });
 
  });
</script>

<?= $this->endSection() ?>