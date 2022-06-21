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
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/all.min.css">
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/pnotify.css">
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/pnotify.buttons.css">
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/pnotify.nonblock.css">
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/styles__ltr.css">

  <link rel="icon" href="images/favicon.ico" type="image/ico" />
</head>

<body>
  <div class="container">
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/login.css" rel="stylesheet">
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/pnotify.nonblock.css">
    <!-- PNotify -->
    <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">


    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta name="robots" content="noindex">

    <!-- LOGIN -->
    <div class="login"><br>
      <!-- Verificar correo y usuario -->
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3" style="z-index: 300;">

          <?php if (session()->get('success')) : ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
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
          <div id="toggle-terms">
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
            <button type="submit" class="btn btn-secondary source" style="width:100%;background:#2a3f54 ">RECUPERAR CONTRASEÑA</button>
          </form>
          <p><a style="color: #2a3f54" target="_blank" href="">¿Cómo recuperar la contraseña? has clic aquí.</a></p>
        </div>
        <!-- SLIDER -->
        <div class="content">
          <!-- LOGO -->
          <div class="logo" style="background:#2a3f54">
            <a href="<?= base_url() . route_to('login') ?>"><img src="images/ucad.png" alt=""></a>
          </div>
          <!-- SLIDESHOW -->
          <div id="slideshow">

            <div class="one" style="display: block; opacity: 1;">
              <h2 style="font-size:3.6vw;"><span>UCAD</span></h2><br>
              <h3 style="font-size:3vh; ">SISTEMA DE CORRESPONDENCIA</h3>
            </div>
          </div>
        </div>


        <!-- LOGIN FORM -->
        <div class="user">
          <div class="form-wrap">
            <!-- TABS -->
            <div class="tabs">
              <h4 class="login-tab"><a class="log-in active" href="<?= base_url() . route_to('homeModulos') ?>"><span>Iniciar Sesión<span></span></span></a></h4>
            </div>

            <!-- TABS CONTENT -->
            <div class="tabs-content">

              <!-- TABS CONTENT LOGIN -->
              <div id="login-tab-content" class="active">
                <form class="login-form" action="<?= base_url() . route_to('homeModulos') ?>" method="post">
                  <input type="text" class="input" id="usuario" name="usuario" autocomplete="off" placeholder="Usuario">
                  <input type="password" class="input" id="clave" name="clave" autocomplete="off" placeholder="Contraseña">
                  <button type="submit" class="btn btn-secondary source" style="width:100%;background:#2a3f54 ">INGRESAR</button>
                </form>

                <!-- <div class="help-action"><br>
                  <p><a style="color: #2a3f54" target="_blank" href="#">¿Cómo iniciar sesión?</a></p>
                  <p><a style="color: #2a3f54" id="forgot" class="forgot" href="#">¿Olvidó su Contraseña?</a></p>
                </div> -->
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
  }
  document.getElementById("forgot").onclick = function() {
    recuperar();
  }
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

<!-- PNotify -->
<script src="vendors/pnotify/dist/pnotify.js"></script>
<script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
<script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</html>
