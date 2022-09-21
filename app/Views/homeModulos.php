<?= $this->extend('template/templateModulo') ?>
<?= $this->section('content') ?>

<!-- page content modulos -->

<!-- Verificar correo y usuario -->
<div class="container">
    <div class="col-md-9"></div>
    <div class="col-md-3" style="z-index: 300;">

        <?php if (session()->get('success')) : ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fa fa-user"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="col-md-12 col-sm-12  text-center">
    <div class="jumbotron1 jumbotron-fluid shadow" style="border-radius: 10PX;">
        <div class="container text1-jumbotron">
            <h3 class="display-5" style="font-weight: 100;"><b>Sistema de Correspondencia</b></h3>
            <p class="lead" style="font-style: italic; ">
                <b> Universidad Cristiana de las Asambleas de Dios</b>
            </p>
        </div>
    </div>
</div>
<div class="x_panel">
    <div class="x_content"><br><br>
        <div class="row">
            <?php foreach ($modulo as $key) : ?><br>
                <div class="col-md-6">
                    <div class="card shadow text-center" style="max-width: 400px;">
                        <div class="row no-gutters">
                            <div class="col-md-5">
                                <img src="images/mod.jpg" style="width: 210px; height:auto;" alt="">
                            </div>
                            <div class="col-md-7" style="text-align: center;"><br>
                                <div class="card-body">
                                    <h3 class="card-title" style="text-align: center;"><?= $key->modulo ?></h3>
                                    <div class="container">
                                        <div class="row"></div><br>
                                    </div>
                                    <form class="text-center" id="moduloId" action="<?php echo base_url() . '/homeMenus' ?>" method="POST">
                                        <button type="submit" class="btn btn-dark btn-sm center" style="border-radius:5px;padding:7px 15px;color:white;background-color:#305274">
                                            Ir al modulo
                                        </button>
                                        <input type="hidden" name="moduloId" class="moduloId" id="moduloId" value="<?= $key->moduloId ?> ">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <br>
</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection() ?>