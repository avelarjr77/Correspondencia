<?= $this->extend('template/templateModulo') ?>
<?= $this->section('content') ?>

<!-- page content modulos -->

<div class="row">
    <div class="x_panel">
        <div class="x_content">
            <div class="col-md-12 col-sm-12  text-center">
            </div>

            <div class="clearfix"></div>
            <?php foreach ($datos as $key) : ?>
            <div class="col-md-4 col-sm-4  profile_details">
                <div class="well profile_view">
                    <div class="col-sm-12">
                        <h4 class="brief"><i><?= $key->modulo ?></i></h4>
                        <div class="left col-sm-7">
                            <h2>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quia vel vero consectetur...
                            </h2>
                            </div>
                        <div class="right col-sm-5 text-center">
                        <div class="icon"><i class=" <?php echo $key->icono ?>" style="font-size: 75px;"></i></div><br>
                        <a  type="button" class="btn btn-primary btn-sm" href="<?= $key->archivo ?>">
                        Ir al modulo
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<!-- /page content modulos -->

<?= $this->endSection() ?>
