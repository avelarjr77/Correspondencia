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
<div class="x_panel">
    <div class="x_content"><br><br>
        <div class="col-md-12 col-sm-12  text-center">
            <div class="jumbotron1 jumbotron-fluid" style="border-radius: 10PX;">
                <div class="container" style="color:#2A3F54;;  text-align: right; font-weight: bold; ">
                    <h2 class="display-4">  <b>Correspondencia UCAD &nbsp;&nbsp;&nbsp;&nbsp;</b></h2>
                    <p class="lead" style="font-style: italic;">
                       <b> Una Universidad Diferente. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</b></p>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
        </div>
        <div class="col-md-10">
            <?php foreach ($modulo as $key) : ?>
                <div class="card mb-3 rounded-lg shadow text-center" style="max-width: 400px;">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="images/mod.jpg" style="width: 190px;" alt="">
                        </div>
                        <div class="col-md-7" style="text-align: center;"><br>
                            <div class="card-body">
                                <h3 class="card-title" style="text-align: center;">Workflow</h3>
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
            <?php endforeach; ?>
        </div>
    </div>

</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection() ?>