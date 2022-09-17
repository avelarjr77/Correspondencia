<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<br>

<!-- page content -->

<?php 
    use App\Models\modUsuario\UsuarioModel;

    $session = session();
    
    $usuario  = new UsuarioModel();
    $rolA = $usuario->asArray()->select('r.nombreRol')->from('wk_usuario u')
    ->join('wk_rol r', 'u.rolId=r.rolId')->where('u.usuario', $session->usuario)->first();
    //var_dump($rolA);
?>
<?php if ($rolA['nombreRol'] === 'Usuario'): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manual del Usuario</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <div class="" style="height: 590px;">
                    <div class="kv-preview-data kv-zoom-body file-zoom-content krajee-default" width="100%">
                        <iframe id="iframePDF" width="100%" height="590px" class="kv-preview-data file-preview-office file-zoom-detail"
                            src="uploads/MANUAL_DE_USUARIOv2.pdf" frameborder="0">
                        </iframe>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($rolA['nombreRol'] === 'Administrador'): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manual del Administrador</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <div class="" style="height: 590px;">
                    <div class="kv-preview-data kv-zoom-body file-zoom-content krajee-default" width="100%">
                        <iframe id="iframePDF" width="100%" height="590px" class="kv-preview-data file-preview-office file-zoom-detail"
                            src="uploads/Manual_del_administradorv2.pdf" frameborder="0">
                        </iframe>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($rolA['nombreRol'] === 'Super Admin'): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manual del Desarrollador</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <div class="" style="height: 590px;">
                    <div class="kv-preview-data kv-zoom-body file-zoom-content krajee-default" width="100%">
                        <iframe id="iframePDF" width="100%" height="590px" class="kv-preview-data file-preview-office file-zoom-detail"
                            src="uploads/MANUAL_DEL_DESARROLLADORv2.pdf" frameborder="0">
                        </iframe>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>





<!-- /page content -->
<?= $this->endSection() ?>