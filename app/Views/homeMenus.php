<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<h3>Inicio</h3>
<!-- top tiles -->
<div class="row col-sm-12" style="display: inline-block;">
    <div class="tile_count ">
        <div class="col-md-3 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Usuarios</span>
            <div class="count green">5</div>
        </div>
        <div class="col-md-3 tile_stats_count">
            <span class="count_top"><i class="fa fa-female"></i> Usuaios Mujeres</span>
            <div class="count ">3</div>
        </div>
        <div class="col-md-3 tile_stats_count">
            <span class="count_top"><i class="fa fa-male"></i> Usuaios Hombres</span>
            <div class="count">2</div>
            <span class="count_bottom">
        </div>
        <div class="col-md-3  tile_stats_count">
            <span class="count_top"><i class="fa fa-gears"></i> Procesos</span>
            <div class="count blue center">19</div>
        </div>
    </div>
</div>
<br>
<!-- /top tiles -->
<div class="x_content">

    <div class="bs-example" data-example-id="simple-jumbotron">
        <div class="jumbotron">
            <h1>Bienvenido/da!</h1>
            <p style="font-style: italic; font-size:medium;">Sistema de correspondencia UCAD.</p>
        </div>
    </div>

</div>

<?= $this->endSection() ?>