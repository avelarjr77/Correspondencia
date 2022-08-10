<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- page content -->

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Configuración de Documento</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Documento</button>
                <a href="<?= base_url().route_to('tipoEnvio') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar tipo de envio</a>
                <br>

                <!--LISTADO DE DOCUMENTO    -->
                <div class="card-box table-responsive"><br>
            <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del documento</th>
                                <th>Documento</th>
                                <th>Tipo de documento</th>
                                <th>Tipo de envio</th>
                                <th>Transacciones de Actividad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos as $key): ?>
                            <tr>
                                <td><?php echo $key->documentoId ?></td>
                                <td><?php echo $key->nombreDocumento ?></td>
                                <td><?php echo $key->tipoDocumentoId ?></td>
                                <td><?php echo $key->tipoEnvioId ?></td>
                                <td><?php echo $key->transaccionActividadId ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-edit" data-documentoId="<?php echo $key->documentoId ?>" data-nombreDocumento="<?php echo $key->nombreDocumento ?>" data-tipoDocumentoId="<?php echo $key->tipoDocumentoId ?>" data-tipoEnvioId="<?php echo $key->tipoEnvioId ?>" data-transaccionActividadId="<?php echo $key->transaccionActividadId ?>" ><i class="fa fa-pencil-square-o"></i> Editar</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-documentoId="<?php echo $key->documentoId ?>" data-nombreDocumento="<?php echo $key->nombreDocumento ?>" data-tipoDocumentoId="<?php echo $key->tipoDocumentoId ?>" data-tipoEnvioId="<?php echo $key->tipoEnvioId ?>" data-transaccionActividadId="<?php echo $key->transaccionActividadId ?>" ><i class="fa fa-trash"></i> Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?> 

                        </tbody>
                    </table>
                </div>
                <!--FIN LISTADO DOCUMENTO-->

                <!-- Modal Agregar documento-->
                <form action="<?php echo base_url() . '/crearDocumento' ?>" method="POST">
                    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un documento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Nombre Documento<span class="required ">*</span></label>
                                <div class="col-md-8">
                                    <input minlength="6" maxlength="75" type="text" class="form-control nombreDocumento" id="nombreDocumento" name="nombreDocumento" required autocomplete="off">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div> 
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Documento<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input minlength="6" maxlength="45" class="form-control documento" name="documento" id="documento" type="text" required autocomplete="off">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Tipo Documento <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="tipoDocumentoId" id="tipoDocumentoId" required="required" class="form-control tipoDocumentoId">
                                        <option value="">-Selecciona un tipo de documento-</option>
                                        <?php foreach ($tipoDocumento as $td): ?>
                                            <option value="<?php echo $td->tipoDocumentoId ?>"> <?php echo $td->tipoDocumento ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Tipo de Envio <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="tipoEnvioId" id="tipoEnvioId" required="required" class="form-control tipoEnvioId">
                                        <option value="">-Selecciona un tipo de Envio-</option>
                                        <?php foreach ($tipoEnvio as $te): ?>
                                            <option value="<?php echo $te->tipoEnvioId ?>"><?php echo $te->tipoEnvio ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Transaccion Actividad <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="transaccionActividadId" required="required" id="transaccionActividadId" class="form-control transaccionActividadId">
                                        <option value="">-Selecciona tipo de transaccion-</option>
                                        <?php foreach ($datos as $d): ?>
                                            <option value="<?php echo $d->transaccionActividadId ?>"><?php echo $d->transaccionActividadId ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <button type="reset" class="btn btn-outline-info btn-xs">Limpiar</button>
                                </div>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Agregar documento-->

                <!-- Modal Edit documento-->
                <form action="<?php echo base_url() . '/actualizarDocumento' ?>" method="POST">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Documento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Nombre documento<span class="required ">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control nombreDocumento" id="nombreDocumento" name="nombreDocumento"  type="text" required autocomplete="off">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Documento<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control documento" name="documento" id="documento" type="text" required autocomplete="off">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Tipo Documento <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="tipoDocumentoId" id="tipoDocumentoId" class="form-control">
                                        <option value="">-Selecciona un tipo de documento-</option>
                                        <?php foreach ($tipoDocumento as $td): ?>
                                            <option value="<?php echo $td->tipoDocumentoId ?>"><?php echo $td->tipoDocumento ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Tipo de Envio <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="tipoEnvioId" id="tipoEnvioId" class="form-control">
                                        <option value="">-Selecciona un tipo de Envio-</option>
                                        <?php foreach ($tipoEnvio as $te): ?>
                                            <option value="<?php echo $te->tipoEnvioId ?>"><?php echo $te->tipoEnvio ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label-align">Transaccion Actividad <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select name="transaccionActividadId" id="transaccionActividadId" class="form-control">
                                        <option value="">-Selecciona tipo de transaccion-</option>
                                        <?php foreach ($datos as $d): ?>
                                            <option value="<?php echo $d->transaccionActividadId ?>"><?php echo $d->transaccionActividadId ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="documentoId" class="documentoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Edit documento-->

                <!-- Modal Delete documento-->
                <form action="<?php echo base_url() . '/eliminarDocumento' ?>" method="POST">
                    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Documento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                        <h4>¿Esta seguro que desea eliminar el registro de: <b><i class="documentoN"></i></b> ?</h4>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="documentoId" class="documentoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Delete documento-->

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    }
</script>

<script>
    $(document).ready(function(){

        // get Edit
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const documentoId = $(this).data('documentoId');
            const nombreDocumento = $(this).data('nombreDocumento');
            const documento = $(this).data('documento');
            const tipoDocumentoId = $(this).data('tipoDocumentoId');
            const tipoEnvioId = $(this).data('tipoEnvioId');
            const transaccionActividadId = $(this).data('transaccionActividadId');

            // Set data to Form Edit
            $('.documentoId').val(documentoId);
            $('.nombreDocumento').val(nombreDocumento);
            $('.documento').val(documento);
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
            const documento = $(this).data('documento');
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
    $('#datatable').DataTable( {
        language: {
            url: 'vendors/datatables.net/es.json'
        }
    } );
} );
</script>

<!-- /page content -->
<?= $this->endSection() ?>