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

    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta name="robots" content="noindex">

    <!-- LOGIN -->
    <div class="login"><br>
      <!-- Verificar correo y usuario -->

      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">

          <?php if (session()->get('success')) : ?>
            <div class="alert alert-success">
              <?= session()->get('success') ?>
            </div>
          <?php endif; ?>

          <?php if (session()->get('danger')) : ?>
            <div class="alert alert-danger">
              <?= session()->get('danger') ?>
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
        <!-- TERMS -->
        <div class="terms">
          <h3>¿Cómo activar su Usuario en EDU?</h3>
          <p class="small">A continuación los pasos para poder registrarse en la plataforma EDU:</p>
          <h3>Docentes y Administrativos</h3>
          <p>Para poder activar su usuario, deberá digitar el correo electrónico que ha brindado en UCAD para tener contacto y que es al correo que tiene acceso, seguidamente deberá ingresar el usuario que se le ha brindado para ingresar a la plataforma Uonline 5. Al enviar la solicitud, el sistema verificará si usted está registrado y enviará a su correo un código para poder ingresar a la plataforma.</p>

          <h3>Estudiantes</h3>
          <p>Si usted es estudiante, debe asegurarse que ha brindado en Registro Académico un correo electrónico personal para que podamos enviar los pasos a seguir para acceder. Debe llenar el formulario con su correo brindado y su número de carnet que será el usuario a utilizar.</p>
        </div>
        <!-- RECOVERY -->
        <div class="recovery" id="recovery">
        <h2>¿Olvidaste tu Contraseña?</h2>
          <p>Por favor, digite <strong> su correo electrónico</strong> para enviar los pasos a seguir y recuperar su contraseña.</p>
          <p><strong>Verifica que los datos de tu correo electrónico sean correctos.</strong></p>
          <form class="login-form" action="<?= base_url() . '/recuperarContraseña' ?>" method="POST">
            <input  class="input" id="email"   name="email"   placeholder="Ingresa tu correo electrónico aquí" >
            <input type="text"  class="input" id="usuario" name="usuario" placeholder="Ingresa tu usuario/carnet aquí" required="">
            <button type="submit" class="btn btn-secondary source" style="width:100%;background:#2a3f54 ">ENVIAR SOLICITUD</button>
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
              <h4 class="login-tab"><a class="log-in active" href="<?= base_url() . route_to('home') ?>"><span>Iniciar Sesión<span></span></span></a></h4>
              <h4 class="signup-tab"><a class="sign-up" href="#signup-tab-content"><span>Activar Usuario</span></a></h4>
            </div>

            <!-- TABS CONTENT -->
            <div class="tabs-content">

              <!-- TABS CONTENT LOGIN -->
              <div id="login-tab-content" class="active">
                <form class="login-form" action="<?= base_url() . route_to('home') ?>" method="post">
                  <input type="text" class="input" id="usuario" name="usuario" autocomplete="off" placeholder="Usuario">
                  <input type="password" class="input" id="clave" name="clave" autocomplete="off" placeholder="Contraseña">
                  <button type="submit" class="btn btn-secondary source" style="width:100%;background:#2a3f54 ">INGRESAR</button>
                </form>

                <div class="help-action"><br>
                  <p><a style="color: #2a3f54" target="_blank" href="#">¿Cómo iniciar sesión?</a></p>
                  <p><a style="color: #2a3f54" id="forgot" class="forgot" href="#">¿Olvidó su Contraseña?</a></p>
                </div>
              </div>

              <!-- TABS CONTENT SIGNUP -->
              <div id="signup-tab-content">
                <form class="signup-form" action="<?= base_url() . route_to('login') ?>" method="post">
                  <input type="text" class="input" name="carnet" id="carnet" autocomplete="off" placeholder="Usuario / Carnet">
                  <input type="password" class="input" name="clave" id="clave" autocomplete="off" placeholder="Contraseña">
                  <button type="submit" class="btn btn-secondary source" style="width:100%;background:#2a3f54 ">Registrarse</button>
                </form>
                <div class="help-action">
                  <p><a style="color: #2a3f54" target="_blank" href="#">¿Cómo activar su usuario?</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  function recuperar() {
    document.getElementById("recovery").classList.toggle("open");
  }
  document.getElementById("forgot").onclick = function() {
    recuperar();
  }
</script>

<div style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 3px; position: absolute; transition: visibility 0s linear 0.3s, opacity 0.3s linear 0s; opacity: 0; visibility: hidden; z-index: 2000000000; left: 0px; top: -10000px;">
  <div style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 2000000000; background-color: rgb(255, 255, 255); opacity: 0.05;"></div>
  <div class="g-recaptcha-bubble-arrow" style="border: 11px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -11px; z-index: 2000000000;"></div>
  <div class="g-recaptcha-bubble-arrow" style="border: 10px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -10px; z-index: 2000000000;"></div>
  <div style="z-index: 2000000000; position: relative;"><iframe title="El reCAPTCHA caduca dentro de dos minutos" src="./Login _ EDU_files/bframe.html" name="c-jej9nkeny2ic" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" style="width: 100%; height: 100%;"></iframe></div>
</div>
<div style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 3px; position: absolute; transition: visibility 0s linear 0.3s, opacity 0.3s linear 0s; opacity: 0; visibility: hidden; z-index: 2000000000; left: 0px; top: -10000px;">
  <div style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 2000000000; background-color: rgb(255, 255, 255); opacity: 0.05;"></div>
  <div class="g-recaptcha-bubble-arrow" style="border: 11px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -11px; z-index: 2000000000;"></div>
  <div class="g-recaptcha-bubble-arrow" style="border: 10px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -10px; z-index: 2000000000;"></div>
  <div style="z-index: 2000000000; position: relative;"><iframe title="El reCAPTCHA caduca dentro de dos minutos" src="./Login _ EDU_files/bframe(1).html" name="c-gv7a9v4xmvhu" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" style="width: 100%; height: 100%;"></iframe></div>
</div>

</html>