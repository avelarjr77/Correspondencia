<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<style>
    @media (max-width: 770px) {
        .jumbotron {
            padding: 8rem 2rem;
            height: 650px;
        }
    }
</style>

<h3>Inicio</h3>
<div class="x_content">
    <div class="bs-example" data-example-id="simple-jumbotron">
        <div class="jumbotron" style="padding: 9rem 2rem; background-size: cover; ">
            <div style="margin: -10% 0 0 0;">
                <h1>¡Bienvenido/da!</h1>
                <p style="font-style: italic; font-size:medium;">Sistema de correspondencia UCAD.</p>
                <hr>

                <!-- top tiles -->
                <div class="row col-sm-12 justify-content-center text-center" style="display: inline-block;">
                    <div class="tile_count">
                        <div class="col-md-3 tile_stats_count">
                            <?php foreach ($prActivo as $pr) : ?>
                                <h6 class="count_top"><i class="fa fa-circle"></i> Procesos Activos</h6>
                                <div class="count blue"><?= $pr->totalP ?></div>
                                <span class="count_bottom">Procesos bajo su cargo</span>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-3 tile_stats_count">
                            <?php foreach ($etapasActivas as $eact) : ?>
                                <h6 class="count_top"><i class="fa fa-circle"></i> Etapas Activas</h6>
                                <div class="count blue"><?= $eact->totalE ?></div>
                                <span class="count_bottom">Total</span>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-3 tile_stats_count">
                            <?php foreach ($actPendientes as $actp) : ?>
                                <h6 class="count_top"><i class="fa fa fa-clock-o"></i> Actividades Pendientes</h6>
                                <div class="count blue"><?= $actp->totalAct ?></div>
                                <span class="count_bottom">Total</span>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-3 tile_stats_count">
                            <?php foreach ($usuariosTotal as $usu) : ?>
                                <h6 class="count_top"><i class="fa fa-users"></i> Total Usuarios</h6>
                                <div class="count blue"><?= $usu->totalU ?></div>
                                <span class="count_bottom"><?= $usu->departamento ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- /top tiles -->


<?= $this->endSection() ?>