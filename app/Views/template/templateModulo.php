<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendors/icons-1.8.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

  <title>Correspondencia UCAD</title>

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
  <link href="vendors/sweetalert2/sweetalert2.css" rel="stylesheet">

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url() . route_to('homeMenu') ?>" class="site_title"><span>
                <P style="font-size:19px;">Correspondencia <b>UCAD</b></P>
              </span></a>
          </div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic center">
              <img src="images/logo.jpeg" alt="..." class="img" width="70" style="float: right; margin:0px auto; border-radius: 7px">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2 style="font-size: 20px;"><?php echo session('usuario'); ?> </h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">

          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/img.jpg" alt=""><?php echo session('usuario'); ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo base_url('/salir') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <?= $this->renderSection('content'); ?>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="text-center">
          Sistema de Correspondencia &copy; <?= date('Y'); ?>
          <br>
          <p>Universidad Cristiana de las Asambleas de Dios</p> <a href="https://colorlib.com"></a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  

  <!-- jQuery -->
  <script src="vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="build/js/custom.min.js"></script>
  
  <script src="vendors/Chart.js/dist/Chart.min.js"></script>

  <!-- Dropzone.js -->
  <script src="vendors/dropzone/dist/min/dropzone.min.js"></script>

  <!--SweetAlert-->
  <script src="vendors/sweetalert2/sweetalert2.min.js"></script>
  <script src="vendors/sweetalert2/sweetalert.min.js"></script>

</body>

</html>