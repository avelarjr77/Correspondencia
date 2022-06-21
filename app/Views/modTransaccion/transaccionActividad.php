<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<style>
    .dropzone {
        width: 900px;
        height: 200px;
        min-height: 0px;
    }   
</style>

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
                    <?php foreach($titulos as $t): ?>
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
                            <?php foreach($datos as $key): ?>
                            <tr>
                                <td><?= $key->id ?></td>
                                <td><?= $key->actividad ?></td>
                                <td><?= $key->persona ?></td>
                                <td>
                                    <a href="#" id="estadoActividad" class="btn btn-info btn-sm" data-estado="<?= $key->estado ?>" disable><?= $key->estado ?></a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm btn-iniciarActividad" data-id="<?= $key->id ?>" data-actividad="<?= $key->actividad ?>" data-persona="<?= $key->persona ?>"  data-estado="<?= $key->estado ?>" data-transacciond="<?= $key->transaccionDetalleId ?>" data-etapaid="<?= $key->etapaId ?>" data-ordenactividad="<?= $key->ordenActividad ?>" data-ordenetapa="<?= $key->ordenEtapa ?>" data-procesoid="<?= $key->procesoId ?>" data-transaccionid="<?= $key->transaccionId ?>" data-nombreproceso="<?= $key->nombreProceso ?>"><i class="fa fa-play"></i> Iniciar</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-finalizarActividad" data-id="<?= $key->id ?>" data-actividad="<?= $key->actividad ?>" data-persona="<?= $key->persona ?>"  data-estado="<?= $key->estado ?>" data-transacciond="<?= $key->transaccionDetalleId ?>" data-etapaid="<?= $key->etapaId ?>" data-ordenactividad="<?= $key->ordenActividad ?>" data-ordenetapa="<?= $key->ordenEtapa ?>" data-procesoid="<?= $key->procesoId ?>" data-transaccionid="<?= $key->transaccionId ?>" data-nombreproceso="<?= $key->nombreProceso ?>"><i class="fa fa-stop"></i> Finalizar</a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-documento" data-id="<?= $key->id ?>" data-actividad="<?= $key->actividad ?>" data-actividadid="<?= $key->actividadId ?>"  data-estado="<?= $key->estado ?>"><i class="fa fa-upload"></i> Cargar Documento</a>
                                </td>
                            </tr>
                            <?php endforeach; ?> 

                        </tbody>
                    </table>
                </div>
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
                                    <?php foreach($datos as $key): ?>
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
        <a href="<?= base_url().route_to('transaccionLista') ?>"  class="btn btn-outline-secondary mb-2 volver-etapa"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>
    <div class="x_content" id="documento" style="display: none">   
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 id="tituloActividades"><b> INFORMACIÓN DE DOCUMENTO</b></h4>
                </div><br><br><br>
                <div class="col-md-6">
                    <h4><b> Actividad: <i id="actividadN"></i></b></h4>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="<?php echo base_url() . '/actividadDoc' ?>" class="dropzone"></form>
                    <br />
                    <br />
                    <br />
                    <br />
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <label>Nombre: </label>
                    <input type="text" name="nombreDocumento" id="nombreDocumento" class="form-control" placeholder="Esribe un nombre" require>
                </div>
                <div class="col-md-3">
                    <label>Tipo de documento: </label>
                    <select name="institucionId" id="institucionId" class="form-control">
                        <option value="" disable>-Selecciona un tipo de documento-</option>
                        <?php foreach ($tipoDoc as $td): ?>
                            <option value="<?= $td->tipoDocumentoId ?>"><?= $td->tipoDocumento ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Tipo de envio: </label>
                    <select name="personaId" id="personaId" class="form-control">
                        <option value="" disable>-Selecciona un tipo de envio-</option>
                        <?php foreach ($tipoEnvio as $te): ?>
                            <option value="<?= $te->tipoEnvioId ?>"><?= $te->tipoEnvio ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <br>
                    <button type="submit" class="btn btn-outline-primary btn-agregarDoc">Agregar</button>
                </div>
            </div>
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
                            <?php foreach($doc as $d): ?>
                            <tr>
                                <td><?= $d->documentoId ?></td>
                                <td><?= $d->nombreDocumento ?></td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm btn-finalizarActividad" ><i class="fa fa-trash"></i> Eliminar</a>
                                    <a href="#" class="btn btn-success btn-sm btn-iniciarActividad" ><i class="fa fa-tasks"></i> Ver</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--FIN LISTADO PROCESO-->
        <br><br><br><br>
        <a href="#"  class="btn btn-outline-secondary mb-2 volver"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){

        $('.btn-finalizarActividad').on('click',function(){
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

            console.log(id, actividad, etapaId, persona, estado, transacciond, ordenActividad, ordenEtapa, procesoId, transaccionId, nombreProceso);

            if(estado == 'En Progreso'){
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
                            url: "<?= base_url().route_to('actividadF') ?>",
                            data: {transaccionActividadId: id, etapaId: etapaId, ordenActividad: ordenActividad, procesoId: procesoId, 
                                    ordenEtapa: ordenEtapa, transaccionDetalleId: transacciond, transaccionId: transaccionId},
                            success:function(data){

                                var dataAct = JSON.parse(data);
                                
                                console.log(dataAct);

                                Swal.fire(
                                '¡Finalizada!',
                                'La actividad ha finalizado',
                                'success'
                                )

                                location.href ="<?= base_url().route_to('transaccionActividades') ?>?etapaId="+dataAct;
                                
                            }
                        });
                    }
                })
            }else if(estado == 'Inactivo' || estado == 'Finalizado') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No es posible finalizar una actividad Inactiva o Finalizada'
                })
            }
        });

        $('.btn-iniciarActividad').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            var actividad = $(this).data('actividad'); //actividad
            var estado = $(this).data('estado');
            var etapaId = $(this).data('etapaid');

            console.log(id);

            if(estado == 'Inactivo'){
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
                            url: "<?= base_url().route_to('actividadI') ?>",
                            data: {transaccionActividadId: id, etapaId: etapaId},
                            success:function(data){

                                var dataActi = JSON.parse(data);
                                
                                console.log(dataActi);

                                Swal.fire(
                                '¡Iniciada!',
                                'La actividad '+actividad+' ha iniciado',
                                'success'
                                )

                                location.href ="<?= base_url().route_to('transaccionActividades') ?>?etapaId="+dataActi;
                                
                            }
                        });
                    }
                })
            }else if(estado == 'En Progreso' || estado == 'Finalizado') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No es posible iniciar una actividad Activa o Finalizada'
                })
            }else{
                
            }
        });

        $('.btn-documento').on('click',function(){
            var id = $(this).data('id');
            var actividad = $(this).data('actividad');
            var actividadId = $(this).data('actividadid');
            var estado = $(this).data('estado');
            $('#actividadN').html(actividad);

            $('#documento').css("display", "block");
            $('#proceso').hide();
        });

        $('.volver').on('click',function(){
            $('#proceso').css("display", "block");
            $('#documento').hide();
        });

        /* $("#input-44").fileinput({
            uploadUrl: '/file-upload-batch/2',
            showUpload: false,
            maxFileCount:5,
            maxFilePreviewSize: 10240,
            fileActionSettings: {
                showRemove: false,
                showUpload: false,
                showZoom: true,
                showDrag: false
            } 
        }); */
    });
</script>



<?= $this->endSection() ?>
