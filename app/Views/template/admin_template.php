<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/ucad.ico" type="image/ico" />

  <!-- Para mostrar el diseño del template -->
  <?= $this->include('template/head'); ?>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url() . route_to('homeMenu') ?>" class="site_title">
              <span>
                <P style="font-size:19px;">Correspondencia <b>UCAD</b></P>
              </span>
            </a>
          </div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic center">
              <img src="images/logo.jpeg" alt="..." class="img" width="70" style="float: right; margin:0px auto; border-radius: 7px">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <!-- strtoupper: se usa para cambiar un array a mayusculas -->
              <h2 style="font-size: 20px;"><?php echo strtoupper(session('usuario')); ?> </h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Menú</h3>
              <?php

              use App\Models\modAdministracion\SubmenuModel;
              use App\Models\modAdministracion\MenuSubmenuModel;
              use App\Models\modAdministracion\ModuloModel;
              use App\Models\modAdministracion\RolModMenuModel;
              use App\Models\modUsuario\UsuarioModel;

              ?>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i>Inicio<span style="z-index: 1;" class="fa fa-chevron-down lefht"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="homeMenu">Inicio</a></li>
                  </ul>
                </li>
              </ul>
              <ul class="nav side-menu">

                <?php

                $session = session();
                $menu     = new MenuSubmenuModel();
                $submenu  = new SubmenuModel();
                $obtenerRol = new UsuarioModel();

                $rol =  $obtenerRol->asArray()->select('r.nombreRol')->from('wk_usuario u')
                  ->join('wk_rol r', 'u.rolId=r.rolId')->where('u.usuario', $session->usuario)->first();
                $rolMenu  = new RolModMenuModel();
                $menu     = $rolMenu->asObject()->select('m.menuId, m.nombreMenu, i.nombreIcono')
                  ->from('co_rol_modulo_menu rmm')
                  ->join('wk_rol r', 'rmm.rolId= r.rolId')
                  ->join('co_modulo_menu mm', 'rmm.moduloMenuId= mm.moduloMenuId')
                  ->join('co_modulo mo', 'mm.moduloId=mo.moduloId')
                  ->join('co_menu m', 'mm.menuId=m.menuId')
                  ->join('wk_icono i', 'm.iconoId=i.iconoId')
                  ->where('r.nombreRol', $rol)
                  ->where('mo.moduloId', $session->modulo)
                  ->orderBy('menuId')
                  ->groupBy('menuId')
                  ->findAll();

                foreach ($menu as $key => $u) :
                  $submenus  = $submenu->asObject()->select()->where('menuId', $u->menuId)->orderBy('menuId')->findAll();
                ?>
                  <?php if ($u->nombreMenu) : ?>
                    <li><a><i class="<?php echo $u->nombreIcono ?>"></i><span><?= $u->nombreMenu ?></span> 
                    <span style="z-index: 1;" class="fa fa-chevron-down "></span></a>
                    <?php endif ?>
                    <ul class="nav child_menu">
                      <?php foreach ($submenus as $s) : ?>
                        <li><a href=<?= $s->nombreArchivo ?>><?php echo $s->nombreSubMenu ?> </a></li>
                      <?php endforeach; ?>
                    </ul>
                    </li>
                  <?php endforeach; ?>
              </ul>
              </ul>
            </div>


          </div>
          <!-- /sidebar menu -->
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
                  <!-- strtoupper: se usa para cambiar un array a mayusculas -->
                  <img src="images/user.png" alt=""><?php echo strtoupper(session('usuario')); ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo base_url('perfil') ?>"><i class="fa fa-user pull-right"></i> Perfil</a>
                  <a class="dropdown-item" href="<?php echo base_url('/salir') ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row"><br>
          <h6>Navegación&nbsp;&nbsp;<i class="fa fa-angle-right"> </i></h6>
          <h6><a href="<?= base_url() . route_to('homeModulos') ?>">&nbsp;&nbsp;Módulos&nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>&nbsp;&nbsp;</h6>
          <h6>
            <a href="homeMenu">
              <?php
              $modulo = new ModuloModel();
              $mod = $modulo->asArray()->select('m.nombre')->from('co_modulo m')->where('m.moduloId', $session->modulo)->first();
              echo $mod['nombre'] ?>
            </a>
          </h6>
        </div>
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
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- Para Agregar scripts -->
  <?= $this->include('template/scripts'); ?>
</body>

</html>