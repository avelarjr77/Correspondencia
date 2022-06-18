<<<<<<< HEAD
<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row"><br>
    <h6><a href="<?= base_url() . route_to('homeModulos') ?>">Modulos</a></h6>
</div>
<h3>Inicio</h3>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">¡Bienvenido/a!</h1>
    <p class="lead">Sistema de correspondencia UCAD</p>
  </div>
</div>

<?= $this->endSection() ?>
=======
<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row"><br>
    <h6><a href="<?= base_url() . route_to('homeModulos') ?>">Modulos</a></h6>
    <h6><a href="<?= base_url() . route_to('homeMenus') ?>">/Configuración General</a></h6>
</div>
<h3>Home</h3>

<?= $this->endSection() ?>
<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="row"><br>
    <h6><a href="<?= base_url() . route_to('homeModulos') ?>">Modulos</a></h6>
</div>
<h3>Home</h3>

<?= $this->endSection() ?>
>>>>>>> 711bee2ba907a9be1f29d1bfe0d0456d5164e07c
