<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<br>

<!-- page content -->

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
                        src="uploads/MANUAL DE USUARIO.pdf" frameborder="0">
                    </iframe>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>


<script>
$(document).ready(function() {

    // get Edit
    $('.btn-edit').on('click', function() {
        // get data from button edit
        const documentoId = $(this).data('documentoId');
        const nombreDocumento = $(this).data('nombreDocumento');
        const tipoDocumentoId = $(this).data('tipoDocumentoId');
        const tipoEnvioId = $(this).data('tipoEnvioId');
        const transaccionActividadId = $(this).data('transaccionActividadId');

        // Set data to Form Edit
        $('.documentoId').val(documentoId);
        $('.nombreDocumento').val(nombreDocumento);
        $('.tipoDocumentoId').val(tipoDocumentoId).trigger('change');
        $('.tipoEnvioId').val(tipoEnvioId).trigger('change');
        $('.transaccionActividadId').val(transaccionActividadId);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete 
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const documentoId = $(this).data('documentoId');
            const nombreDocumento = $(this).data('nombreDocumento');
            const tipoDocumentoId = $(this).data('tipoDocumentoId');
            const tipoEnvioId = $(this).data('tipoEnvioId');
            const transaccionActividadId = $(this).data('transaccionActividadId');
            
            // Set data to Form Edit
            $('.documentoId').val(documentoId);
            $('.documentoN').html(documento);

        // Call Modal Edit
        $('#eliminarModal').modal('show');
    });

});
</script>

<script>
$(document).ready(function() {
        $('#datatable').DataTable({
            language: {
                url: 'vendors/datatables.net/es.json'
            },
            "order": [[0, 0]],
            "ordering":true,
        });
    });
</script>

<!-- /page content -->
<?= $this->endSection() ?>