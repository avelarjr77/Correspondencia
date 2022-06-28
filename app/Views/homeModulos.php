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
    <div class="x_content">
        <div class="col-md-12 col-sm-12  text-center">
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <?php foreach ($modulo as $key) : ?>
                <div class="col-sm-3">
                    <div class="profile-card card rounded-lg shadow  p-xl-3 mb-3 text-center position-relative overflow-hidden">
                        <img src="images/modulo.png" alt="" class="mx-auto mb-3" style="width: 180px;">
                        <h3 style="	font-size: 1.1rem; display: block; opacity: 1;"><?= $key->modulo ?></h3>
                        <div class="text-left mb-4">
                            <form class="text-center" id="moduloId" action="<?php echo base_url() . '/homeMenus' ?>" method="POST">
                                <button type="submit" class="btn btn-dark btn-sm center" style="border-radius:5px;padding:7px 15px;color:white;background-color:#305274">
                                    Ir al modulo
                                </button>
                                <input type="hidden" name="moduloId" class="moduloId" id="moduloId" value="<?= $key->moduloId ?> ">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });
    },3000);
</script>
<?= $this->endSection() ?>