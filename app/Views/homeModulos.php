<?= $this->extend('template/templateModulo') ?>
<?= $this->section('content') ?>
<div class="row">
    <!-- page content modulos -->
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
            <div class="row">
                <?php foreach ($modulo as $key) : ?>
                    <div class="col-sm-3">
                        <div class="profile-card card rounded-lg shadow  p-xl-3 mb-3 text-center position-relative overflow-hidden">
                            <div class="banner"></div>
                            <img src="images/administracion.png" alt="" class="img-circle1 mx-auto mb-3" style="width: 200px;">
                            <h3 style="	font-size: 1.65rem; display: block; opacity: 1;"><?= $key->modulo ?></h3>
                            <div class="text-left mb-4">
                                <form class="text-center" id="moduloId" action="<?php echo base_url() . '/homeMenus' ?>" method="POST">
                                    <button type="submit" class="btn btn-primary btn-sm center" style="border-radius:5px;padding:11px 23px;color:white;background-color:#305274">
                                        <i class="fa fa-long-arrow-right"></i> Ir al modulo
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
        $(".alert").fadeTo(200, 0).slideUp(200, function() {
            $(this).remove();
        });
    }, 2000);
</script>
<?= $this->endSection() ?>