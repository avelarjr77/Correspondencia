<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row"><br>
    <h6><a href="<?= base_url() . route_to('home') ?>">Modulos</a></h6>
    <h6><a href="<?= base_url() . route_to('homeAdministracion') ?>">/Configuración General</a></h6>
</div>
<h3>Home</h3>

<?= $this->endSection() ?>