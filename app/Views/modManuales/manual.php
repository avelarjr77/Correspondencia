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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal('No se agrego', 'Los datos ingresados contienen signos de puntuacion', 'error');
    }else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    }else if (mensaje == '3') {
        swal('', 'No se Elimino Registro', 'error');
    }else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    }else if (mensaje == '5') {
        swal('No se actualizo', 'Los datos ingresados contienen signos de puntuacion', 'error');
    }else if (mensaje == '6') {
        swal('', 'Este documento ya existe en la base de datos', 'error');
    }else if (mensaje == '7') {
        swal('', 'Tipo de documento no admitido en la base de datos', 'error');
    }
</script>

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