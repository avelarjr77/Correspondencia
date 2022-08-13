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


<!-- MODAL PARA VISIALIZAR EL ARCHIVO -->
<div class="modal fade" id="modalArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header kv-zoom-header">
                <h6 class="modal-title kv-zoom-title" id="kvFileinputModalLabel"><span class="kv-zoom-caption"
                        title="Marco legal.docx">Marco legal.docx</span> <span class="kv-zoom-size prueba"> <samp>(19.29
                            KB)</samp>
                    </span>
                </h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-kv btn-default btn-outline-secondary btn-kv-close"
                        title="Close detailed preview" data-dismiss="modal" aria-hidden="true">
                        <i class="bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="floating-buttons"></div>
            <div class="" style="height: 585px;">
                <div class="kv-preview-data kv-zoom-body file-zoom-content krajee-default" width="100%">
                    <iframe id="iframePDF" width="100%" height="585px" class="kv-preview-data file-preview-office file-zoom-detail"
                        src="<?php echo base_url() . '../../uploads/ucad.png' ?>" frameborder="0">
                    </iframe>
                    <!--<iframe class="kv-preview-data file-preview-office file-zoom-detail"
                        src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url() . '../../uploads/Entregables.php' ?>"
                        style="width: 100%; height: 100%; max-width: 100%; min-height: 580px; transform: rotate(0deg);">
                    </iframe> -->
                </div>
            </div>
            <button type="button" class="btn btn-default btn-outline-secondary btn-navigate btn-kv-prev"
                  style="display: none;"><i class="bi-chevron-left"></i></button> <button
                type="button" class="btn btn-default btn-outline-secondary btn-navigate btn-kv-next"
                title="View next file" style="display: none;"><i class="bi-chevron-right"></i></button>
            <div class="kv-zoom-description" style="display: none;"></div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        // get Edit Product
        $('.btn-abrir').click(function(){
            // get data from button edit
            var documentoId = $(this).data('documentoId');
            var nombre = $(this).data('nombre');

            // Set data to Form Edit
            $.ajax({
                url: '<?= base_url() . route_to('listadoDocumentos') ?>',
                type: 'get',
                data: {documentoId: documentoId},
                success: function(response){
                    $('.prueba').html(response);
                    $('#modalArchivo').modal(show);

                    $.each(dataActividadList, function(index, val) {
                    actData.append("<tr><td>" + val.id + "</td>" +
                        "<td>" + val.actividad + "</td>"+
                        "</td></tr>")
                });
                }
            });
        });
    });

</script>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>


<?= $this->endSection() ?>