<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="container x_panel" id="contenido" >
    <div class="x_title">
        <h2>Listado de Procesos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="row justify-content-center" style="color:#010806;">
        <?php 
            use App\Models\modTransaccion\TransaccionListModel;

            foreach($datos as $key): 
            
            $tlist  = new TransaccionListModel();
            $etapa = $tlist->asObject()->select('td.etapaId, e.nombreEtapa, 
                        (CASE
                            WHEN MONTH(ta.fechaInicio) = 1 THEN "Enero"
                            WHEN MONTH(ta.fechaInicio) = 2 THEN "Febrero"
                            WHEN MONTH(ta.fechaInicio) = 3 THEN "Marzo"
                            WHEN MONTH(ta.fechaInicio) = 4 THEN "Abril"
                            WHEN MONTH(ta.fechaInicio) = 5 THEN "Mayo"
                            WHEN MONTH(ta.fechaInicio) = 6 THEN "Junio"
                            WHEN MONTH(ta.fechaInicio) = 7 THEN "Julio"
                            WHEN MONTH(ta.fechaInicio) = 8 THEN "Agosto"
                            WHEN MONTH(ta.fechaInicio) = 9 THEN "Septiembre"
                            WHEN MONTH(ta.fechaInicio) = 10 THEN "Octubre"
                            WHEN MONTH(ta.fechaInicio) = 11 THEN "Noviembre"
                            ELSE "Diciembre"
                        END) as mes, DAY(ta.fechaInicio) as dia')->from('wk_transaccion_actividades ta')
                        ->join('wk_transaccion_detalle td', 'td.transaccionDetalleId = ta.transaccionDetalleId')
                        ->join('wk_transaccion t', 't.transaccionId = td.transaccionId')
                        ->join('wk_etapa e', 'e.etapaId = td.etapaId')
                        ->where('t.procesoId',$key->procesoId)
                        ->groupBy('td.etapaId')->findAll();
        ?>
            <div class="col-md-5">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 style="font-size:15px;"><b>Proceso: <?= $key->nombreProceso ?></b></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php 
                            foreach($etapa as $e): 

                            $tlista  = new TransaccionListModel();
                            $actividad = $tlista->asObject()->select('ta.actividadId, a.nombreActividad')->from('wk_transaccion_actividades ta')
                            ->join('wk_transaccion_detalle td', 'td.transaccionDetalleId = ta.transaccionDetalleId')
                            ->join('wk_transaccion t', 't.transaccionId = td.transaccionId')
                            ->join('wk_etapa e', 'e.etapaId = td.etapaId')
                            ->join('wk_actividad a', 'a.actividadId = ta.actividadId')
                            ->where('td.etapaId',$e->etapaId)
                            ->groupBy('ta.actividadId')->findAll();    
                        ?>
                        <form action="<?php echo base_url() . '/transaccionActividades' ?>" method="GET">
                            <article class="media event">
                                <div class="row justify-content-around">
                                    <div class="col-md-3">
                                        <a class="pull-left date">
                                            <p class="month"><?= $e->mes ?></p>
                                            <p class="day"><?= $e->dia ?></p>
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="media-body">
                                            <input type="hidden" name="etapaId" class="etapaId" value="<?= $e->etapaId ?>">
                                            <button style="color:#010806;" type="submit" class="btn btn-sm btn-link"><b><?= $e->nombreEtapa ?></b></button>
                                            <p>&nbsp; &nbsp; Actividades en esta etapa:</p>
                                            <?php foreach($actividad as $a): ?>
                                                <ul>
                                                    <li ><?= $a->nombreActividad ?></li>
                                                </ul>
                                            <?php endforeach; ?> 
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </form><br>
                        <?php endforeach; ?> 
                    </div>
                </div>
            </div>
        <?php endforeach; ?> 
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){

        //$('#contenido').css("color","#010806");
        //$('#contenido').css("font-size",14);
    });

</script>

<?= $this->endSection() ?>
