<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="container x_panel" id="contenido">
    <div class="x_title">
        <h2>Listado de Documentos</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <?php foreach($datos as $key): ?>
    <div class="container">
        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="font-size:15px;"><b><?php echo $key->nombreActividad ?></b></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row justify-content-around">
                        <div class="col-md-12">
                            <div class="file-thumbnail-footer text-center">
                                <h1 class="" style="font-size: 80px;"><i
                                        class="fa fa-file-o text-default"></i>
                                </h1>
                                <div class="file-footer-caption" title="<?php echo $key->nombreDocumento ?>">
                                    <div class="file-caption-info"><?php echo $key->nombreDocumento ?></div>
                                    <div class="file-size-info"> <samp></samp></div>
                                </div>
                                <div class="file-upload-indicator" title="Not uploaded yet"></div>
                                <div class="file-actions">
                                    <div class="file-footer-buttons"><br>
                                        <a href="#" class="kv-file-zoom btn btn-sm btn-kv btn-default btn-primary btn-abrir"
                                            title="View Details" data-toggle="modal" data-target="#modalArchivo"
                                            data-id="<?php echo $key->documentoId ?>" data-nombre="<?php echo $key->nombreDocumento ?>">
                                            <i class=""></i>Abrir documento
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>


<!-- MODAL PARA VISUALIZAR EL ARCHIVO -->
<div class="modal fade" id="modalArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header kv-zoom-header">
                <h5 class="modal-title kv-zoom-title nombreD" id="kvFileinputModalLabel"><span class="kv-zoom-caption" title=""></span> <span class="kv-zoom-size prueba">
                    </span>
                </h5>
                <div class="">
                    <a class="btn btn-sm btn-default btn-outline-secondary btn-descarga" id="btn-descarga"><i class="fa fa-download"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-kv btn-default btn-outline-secondary btn-kv-close" title="Close detailed preview" data-dismiss="modal" aria-hidden="true">
                        <i class="bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="floating-buttons"></div>
            <div class="" style="height: 450px;">
                <div class="kv-preview-data kv-zoom-body file-zoom-content krajee-default" width="100%">
                    <iframe id="iframePDF" width="100%" height="450px" class="kv-preview-data file-preview-office file-zoom-detail" src="" frameborder="0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA VISUALIZAR EL ARCHIVO -->

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {

        $('.btn-abrir').on('click', function() {

            var id = $(this).data('id');
            var nombre = $(this).data('nombre');

            console.log(id, nombre);

            $('.nombreD').html(nombre);
            $('iframe').attr("src", "uploads/" + nombre + "");

            $('.btn-descarga').on('click', function() {

                $('.nombreD').html(nombre);
                $('#btn-descarga').attr("href", "uploads/" + nombre + "");
                $('#btn-descarga').attr("download", nombre);
            });

            $('#btn-descarga').attr("href", "#");
            $('#btn-descarga').removeAttr("download");
        });
    });
</script>


<?= $this->endSection() ?>