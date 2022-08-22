<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - Correspondencia </title>
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/login.css">

  <link rel="icon" href="images/favicon.ico" type="image/ico" />
</head>

<body>
  <div class="container">

    <!-- LOGIN -->
    <div class="login"><br>
      <!-- Verificar correo y usuario -->
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3" style="z-index: 300;">

          <?php if (session()->get('success')) : ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="background-color: f44336;">
              <i class="fa fa-check-circle"></i>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?= session()->get('success') ?>
            </div>
          <?php endif; ?>

          <?php if (session()->get('danger')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-warning"></i>
              <?= session()->get('danger') ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="wrap">
        <!-- TOGGLE -->
        <div id="toggle-wrap">
          <div id="toggle-terms" class="">
            <div id="cross">
              <span></span>
              <span></span>
            </div>
          </div>
        </div>

        <!-- RECOVERY -->
        <div class="recovery" id="recovery"><br><br><br>
          <h2>¿Olvidaste tu Contraseña?</h2>
          <p>Por favor, digite <strong> su correo electrónico</strong> para poder recuperar su contraseña.</p>
          <p><strong>Verifica que los datos de tu correo electrónico sean correctos.</strong></p>
          <form class="login-form" action="<?= base_url() . '/recuperarContraseña' ?>" method="POST">
            <input type="email" class="input" id="email" name="email" placeholder="Ingresa tu correo electrónico aquí" required>
            <button type="submit" class="btn btn-secondary source" style="width:100%;background:#2a3f54 ">RECORDAR CONTRASEÑA</button>
          </form>
        </div>
        <!-- SLIDER -->
        <div class="content">
          <!-- LOGO -->
          <div class="logo" style="background:#2a3f54">
            <a href="<?= base_url() . route_to('login') ?>"><img src="images/ucad.png" alt=""></a>
          </div>
          <!-- SLIDESHOW -->
          <div id="slideshow">

            <div class="one">
              <h2 ><span>UCAD</span></h2><br>
              <h3 >SISTEMA DE CORRESPONDENCIA</h3>
            </div>
          </div>
        </div>


        <!-- LOGIN FORM -->
        <div class="user">
          <div class="form-wrap">
            <!-- TABS -->
            <div class="tabs">
              <h4 class="login-tab"><a class="log-in active" href="<?= base_url() . route_to('login') ?>"><span>Iniciar Sesión<span></span></span></a></h4>
            </div>

            <!-- TABS CONTENT -->
            <div class="tabs-content">

              <!-- TABS CONTENT LOGIN -->
              <div id="login-tab-content" class="active">
                <form class="login-form" action="<?= base_url() . route_to('homeModulos') ?>" method="post">
                  <input type="text" class="input" id="usuario" name="usuario" autocomplete="off" placeholder="Usuario" required>
                  <input type="password" class="input" id="clave" name="clave" autocomplete="off" placeholder="Contraseña" required>
                  <button type="submit" class="btn btn-secondary source" style="width:100%;background:#2a3f54 ">INGRESAR</button>
                </form>

                <div class="help-action"><br>
                  <p><a style="color: #2a3f54" id="forgot" class="forgot" href="#">¿Olvidó su Contraseña?</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

<script>
  function recuperar() {
    document.getElementById("recovery").classList.toggle("open");
    document.getElementById("toggle-terms").classList.toggle("open");
  }
  document.getElementById("forgot").onclick = function() {
    recuperar();
  }
</script>
<script>
  function cerrar() {
    document.getElementById("recovery").classList.remove("open");
    document.getElementById("toggle-terms").classList.remove("open");
  }
  document.getElementById("cross").onclick = function() {
    cerrar();
};
</script>
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(700, function() {
      $(this).remove();
    });
  }, 5000);
</script>
<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</html>
