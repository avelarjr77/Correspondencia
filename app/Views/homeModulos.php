<?= $this->extend('template/templateModulo') ?>
<?= $this->section('content') ?>

<!-- page content modulos -->
<div class="row">
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
        <div class="x_content">
            <div class="col-md-12 col-sm-12  text-center">
            </div>

            <div class="clearfix"></div>
            <?php foreach ($modulo as $key) : ?>
                <div class="col-md-4 col-sm-4  profile_details">
                    <div class="well profile_view">
                        <div class="col-sm-12">
                            <h4 class="brief"><i><?= $key->modulo ?></i></h4>
                            <div class="left col-sm-7">
                                <h2>
                                    <?= $key->descripcion ?>
                                </h2>
                            </div>
                            <div class="right col-sm-5 text-center">
                                <div class="icon"><i class=" <?php echo $key->icono ?>" style="font-size: 75px;"></i></div><br>
                                <form id="moduloId" action="<?php echo base_url() . '/homeMenus' ?>" method="POST">
                                    <button type="submit" class="btn btn-primary btn-sm">
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
    }, 5000);
</script>
<?= $this->endSection() ?>
