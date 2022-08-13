<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Actividades</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content" id="proceso">
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 id="tituloActividades"><b> INFORMACIÓN DEL FLUJO DE ACTIVIDADES</b></h4>
                </div><br><br><br>
                <div class="col-md-6">
                    <?php foreach ($titulos as $t) : ?>
                        <h4><b> Proceso: <i id="procesoN"><?= $t->nombreProceso ?></i></b></h4>
                        <h4><b> Etapa: <i id="EtapaN"><?= $t->nombreEtapa ?></i></b></h4>
                    <?php endforeach; ?>
                </div>
            </div>
            <br>
            <div class="row" id="tbl-actividad">
                <div class="col-md-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Actividad</th>
                                <th>Responsable</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Documento</th>
                            </tr>
                        </thead>
                        <tbody id="procesoList">
                            <?php foreach ($datos as $key) : ?>
                                <tr>
                                    <td><?= $key->id ?></td>
                                    <td><?= $key->actividad ?></td>
                                    <td><?= $key->persona ?></td>
                                    <td>
                                        <a href="#" id="estadoActividad" class="btn btn-info btn-sm" data-estado="<?= $key->estado ?>" disable><?= $key->estado ?></a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm btn-iniciarActividad" data-id="<?= $key->id ?>" data-actividad="<?= $key->actividad ?>" data-persona="<?= $key->persona ?>" data-estado="<?= $key->estado ?>" data-transacciond="<?= $key->transaccionDetalleId ?>" data-etapaid="<?= $key->etapaId ?>" data-ordenactividad="<?= $key->ordenActividad ?>" data-ordenetapa="<?= $key->ordenEtapa ?>" data-procesoid="<?= $key->procesoId ?>" data-transaccionid="<?= $key->transaccionId ?>" data-nombreproceso="<?= $key->nombreProceso ?>"><i class="fa fa-play"></i> </a>
                                        <a href="#" class="btn btn-danger btn-sm btn-finalizarActividad" data-id="<?= $key->id ?>" data-actividad="<?= $key->actividad ?>" data-persona="<?= $key->persona ?>" data-estado="<?= $key->estado ?>" data-transacciond="<?= $key->transaccionDetalleId ?>" data-etapaid="<?= $key->etapaId ?>" data-ordenactividad="<?= $key->ordenActividad ?>" data-ordenetapa="<?= $key->ordenEtapa ?>" data-procesoid="<?= $key->procesoId ?>" data-transaccionid="<?= $key->transaccionId ?>" data-nombreproceso="<?= $key->nombreProceso ?>"><i class="fa fa-stop"></i> </a>
                                        <a href="#" class="btn btn-secondary btn-sm btn-editarO" data-id="<?= $key->id ?>" data-observaciones="<?= $key->observaciones ?>" data-etapaid="<?= $key->etapaId ?>"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-documento" data-id="<?= $key->id ?>" data-actividad="<?= $key->actividad ?>" data-actividadid="<?= $key->actividadId ?>" data-estado="<?= $key->estado ?>"><i class="fa fa-upload"></i> Cargar Documento</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <!-- Modal Edit Observaciones-->
                <form action="<?php echo base_url() . '/actualizarActO' ?>" method="POST">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear/Editar Observaciones</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea class="form-control" name="observaciones" id="observacionesA" rows="3" required></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="transaccionActividadId" class="transaccionActividadId">
                                    <input type="hidden" name="etapaId" class="etapaId">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Edit Observaciones-->

                <div class="col-md-12">
                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-info-circle"></i> Información Adicional
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Actividad</th>
                                        <th>Fecha Creación</th>
                                        <th>Hora Creación</th>
                                        <th>Fecha Inicio</th>
                                        <th>Hora Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Hora Fin</th>
                                    </tr>
                                </thead>
                                <tbody id="procesoList">
                                    <?php foreach ($datos as $key) : ?>
                                        <tr>
                                            <td><?= $key->id ?></td>
                                            <td><?= $key->actividad ?></td>
                                            <td><?= $key->fechaCreacion ?></td>
                                            <td><?= $key->horaCreacion ?></td>
                                            <td><?= $key->fechaInicio ?></td>
                                            <td><?= $key->horaInicio ?></td>
                                            <td><?= $key->fechaFin ?></td>
                                            <td><?= $key->horaFin ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div><br>
                </div>
            </div>
        </div>
        <!--FIN LISTADO PROCESO-->

        <br><br><br><br>
        <a href="<?= base_url() . route_to('transaccionLista') ?>" class="btn btn-outline-secondary mb-2 volver-etapa"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>
    <div class="x_content" id="documento" style="display: none">
        <br>

        <!--LISTADO DE PROCESO
        EN ESTA PARTE SE GUARDA EL NOMBRE DEL DOCUMENTO PERO NO GUARDA EL DOCUMENTO EN LA CARPETA
        TIENE QUE EJECUTAR LA ACCION QUE ESTA DENTROO DEL FORM DE DROPZONE                 
        -->

        <div class="x_content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 id="tituloActividades"><b> INFORMACIÓN DE DOCUMENTO</b></h4>
                    <h4><i class="fas fa-file-word"></i></h4>
                </div><br><br><br>
                <div class="col-md-6">
                    <h4><b> Actividad: <i id="actividadN"></i></b></h4>
                </div>
            </div>
            <br>
            <!-- name="fileUpload" id="fileUpload"
             enctype="multipart/form-data"-->
            <form  action="<?php echo base_url() . '/crearDocumentoImage' ?>" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <input id="nombreDocumento"  name="nombreDocumento" class="file" type="file" 
                            data-preview-file-type="any" data-browse-on-zone-click="true"  require >
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div id="errors"></div>
                        <div class="mb-3 form-check">
                            <label>Tipo de documento: </label>
                            <select name="tipoDocumentoId" id="tipoDocumentoId" class="form-control" required>
                                <option value="" disable>-Selecciona un tipo de documento-</option>
                                <?php foreach ($tipoDoc as $td) : ?>
                                    <option value="<?= $td->tipoDocumentoId ?>"><?= $td->tipoDocumento ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <label>Tipo de envio: </label>
                            <select name="tipoEnvioId" id="tipoEnvioId" class="form-control" required>
                                <option value="" disable>-Selecciona un tipo de envio-</option>
                                <?php foreach ($tipoEnvio as $te) : ?>
                                    <option value="<?= $te->tipoEnvioId ?>"><?= $te->tipoEnvio ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                                <input class="form-control" id="transaccionActividadId" name="transaccionActividadId"  type="text" hidden>
                        </div>
                        <br>
                        <button type="submit" name="submit"  class="btn btn-primary btn-tDocumnto">Guardar</button>
                    </div>
                </div>
            </div>
            </form>

            <br><br><br>
            <div class="row" id="tbl-actividad">
                <div class="col-md-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Documento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="docList">
                            <?php foreach ($doc as $d) : ?>
                                <tr>
                                    <td><?= $d->documentoId ?></td>
                                    <td><?= $d->nombreDocumento ?></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm btn-finalizarActividad"><i class="fa fa-trash"></i> Eliminar</a>
                                        <a href="#" class="btn btn-success btn-sm btn-iniciarActividad"><i class="fa fa-tasks"></i> Ver</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br><br><br>
            <a href="#" class="btn btn-outline-secondary mb-2 volver"><i class="fa fa-angle-double-left"></i> Volver</a>
        </div>
        <!--FIN LISTADO PROCESO
    ------------------------------------------------------------------------------------------------------------
        -->
    </div>
</div>



<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<!-- Input file -->

<script src="vendors/fileinput/js/fileinput.min.js"></script>
<script src="vendors/fileinput/js/plugins/buffer.min.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/plugins/filetype.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/plugins/filetype.min.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/plugins/piexif.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/locales/fr.js" type="text/javascript"></script>
<script src="vendors/fileinput/js/locales/es.js" type="text/javascript"></script>
<script src="vendors/fileinput/themes/fa5/theme.js" type="text/javascript"></script>
<script src="vendors/fileinput/themes/explorer-fa5/theme.js" type="text/javascript"></script> 

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal('', 'Este documento ya existe en la base de datos', 'error');
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
    var footerTemplate = '<div class="file-thumbnail-footer" style ="height:94px">\n' +
        '  <input class="kv-input kv-new form-control input-sm form-control-sm text-center {TAG_CSS_NEW}" value="{caption}" placeholder="Enter caption...">\n' +
        '   <div class="small" style="margin:15px 0 2px 0">{size}</div> {progress}\n{indicator}\n{actions}\n' +
        '</div>';

    $("#fileUpload").fileinput({

        language: 'es',
        uploadUrl: "http://localhost/correspondencia-ucad/upload.php",
        maxFilePreviewSize: 10240,
        sobrescribirInitial: false,
        actionUpload: false,
        showZoom: false,
        initialPreviewAsData: true,
        layoutTemplates: {
            footer: footerTemplate
        },
        previewThumbTags: {
            '{TAG_VALUE}': '', // no value
            '{TAG_CSS_NEW}': '', // new thumbnail input
            '{TAG_CSS_INIT}': 'kv-hidden' // hide the initial input
        },
    });
</script>


<script>
    $(document).ready(function() {

        $('.btn-finalizarActividad').on('click', function() {
            // get data from button edit
            var id = $(this).data('id');
            var actividad = $(this).data('actividad'); //actividadId
            var etapaId = $(this).data('etapaid');
            var persona = $(this).data('persona');
            var estado = $(this).data('estado');
            var transacciond = $(this).data('transacciond');
            var ordenActividad = $(this).data('ordenactividad');
            var ordenEtapa = $(this).data('ordenetapa');
            var procesoId = $(this).data('procesoid');
            var nombreProceso = $(this).data('nombreproceso');
            var transaccionId = $(this).data('transaccionid');

            console.log(id, actividad, etapaId, persona, estado, transacciond, ordenActividad, ordenEtapa,
                procesoId, transaccionId, nombreProceso);

            if (estado == 'En Progreso') {
                Swal.fire({
                    title: '¿Desea Finalizar esta actividad?',
                    text: "No podrá reverir este cambio",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, finalizar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "<?= base_url() . route_to('actividadF') ?>",
                            data: {
                                transaccionActividadId: id,
                                etapaId: etapaId,
                                ordenActividad: ordenActividad,
                                procesoId: procesoId,
                                ordenEtapa: ordenEtapa,
                                transaccionDetalleId: transacciond,
                                transaccionId: transaccionId
                            },
                            success: function(data) {

                                var dataAct = JSON.parse(data);

                                console.log(dataAct);

                                Swal.fire(
                                    '¡Finalizada!',
                                    'La actividad ha finalizado',
                                    'success'
                                )

                                location.href =
                                    "<?= base_url() . route_to('transaccionActividades') ?>?etapaId=" +
                                    dataAct;

                            }
                        });
                    }
                })
            } else if (estado == 'Inactivo' || estado == 'Finalizado') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No es posible finalizar una actividad Inactiva o Finalizada'
                })
            }
        });

        $('.btn-iniciarActividad').on('click', function() {
            // get data from button edit
            var id = $(this).data('id');
            var actividad = $(this).data('actividad'); //actividad
            var estado = $(this).data('estado');
            var etapaId = $(this).data('etapaid');

            console.log(id);

            if (estado == 'Inactivo') {
                Swal.fire({
                    title: '¿Desea Iniciar esta actividad?',
                    text: "No podrá reverir este cambio",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Iniciar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "<?= base_url() . route_to('actividadI') ?>",
                            data: {
                                transaccionActividadId: id,
                                etapaId: etapaId
                            },
                            success: function(data) {

                                var dataActi = JSON.parse(data);

                                console.log(dataActi);

                                Swal.fire(
                                    '¡Iniciada!',
                                    'La actividad ' + actividad + ' ha iniciado',
                                    'success'
                                )

                                location.href =
                                    "<?= base_url() . route_to('transaccionActividades') ?>?etapaId=" +
                                    dataActi;

                            }
                        });
                    }
                })
            } else if (estado == 'En Progreso' || estado == 'Finalizado') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No es posible iniciar una actividad Activa o Finalizada'
                })
            } else {

            }
        });

        $('.btn-documento').on('click', function() {
            var id = $(this).data('id');
            var actividad = $(this).data('actividad');
            var actividadId = $(this).data('actividadid');
            var estado = $(this).data('estado');

            $('#actividadN').html(actividad);
            $('#transaccionActividadId').val(id);

            $('#documento').css("display", "block");
            $('#proceso').hide();
        });

        $('.btn-editarO').on('click', function() {
            // get data from button edit
            var id = $(this).data('id');
            var observaciones = $(this).data('observaciones');
            var etapaId = $(this).data('etapaid');

            console.log(id, observaciones);

            $('.transaccionActividadId').val(id);
            $('.etapaId').val(etapaId);
            $('#observacionesA').val(observaciones);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        $('.volver').on('click', function() {
            $('#proceso').css("display", "block");
            $('#documento').hide();
        });
        
        $('.btn-tDocumento').on('click', function() {
            var id = $(this).data('id');
            $('#transaccionActividadId').val(id);
        });

    });
</script>


<?= $this->endSection() ?>