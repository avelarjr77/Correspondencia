<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Transacción</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content" id="proceso">
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <form id="frmProcesoInsti" action="<?= base_url() . '/crearTransaccion' ?>" method="POST">
                <div class="card border-primary mb-3">
                    <br>
                    <h4 id="tituloProceso"><b>&nbsp; Seleccione el Proceso a abrir:</b></h4><br>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <label>Proceso: </label>
                            <select name="procesoId" id="procesoId" class="form-control">
                                <option value="" disable>-Selecciona un proceso-</option>
                                <?php foreach ($datos as $p) : ?>
                                    <option value="<?= $p->procesoId ?>"><?= $p->nombreProceso ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Institución: </label>
                            <select name="institucionId" id="institucionId" class="form-control">
                                <option value="" disable>-Selecciona una institución-</option>
                                <?php foreach ($institucion as $i) : ?>
                                    <option value="<?= $i->institucionId ?>"><?= $i->nombreInstitucion ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Encargado: </label>
                            <select name="personaId" id="personaId" class="form-control">
                                <option value="" disable>-Selecciona un encargado-</option>
                                <?php foreach ($persona as $pe) : ?>
                                    <option value="<?= $pe->personaId ?>"><?= $pe->nombres ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5 form-group">
                            <br>
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" name="observaciones" id="observaciones" rows="2" required></textarea>
                        </div>
                        <div class="col-md-2">
                            <br><br><br>
                            <button type="submit" class="btn btn-outline-primary btn-agregarProceso">Crear Proceso</button>
                        </div>
                    </div><br>
                </div>
            </form>
            <br><br><br>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="#" class="btn btn-secondary btn-sm btn-procesosFin"><i class="fa fa-check-circle"></i> Procesos Finalizados</a>
                </div> <br><br>
                <div class="col-md-12 text-center">
                    <h4><b>PROCESOS CREADOS PARA DAR SEGUIMIENTO</b></h4>
                </div>               
                <br><br><br>
                <div class="card-box table-responsive"><br>
                    <table id="datatable" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proceso</th>
                                <th>Institución</th>
                                <th>Encargado</th>
                                <th>Acciones</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="procesoList">
                            <?php foreach ($transaccion as $key) : ?>
                                <tr>
                                    <td><?= $key->id ?></td>
                                    <td><?= $key->proceso ?></td>
                                    <td><?= $key->institucion ?></td>
                                    <td><?= $key->persona ?></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm btn-eliminarProceso" data-id="<?= $key->id ?>" data-proceso="<?= $key->proceso ?>" data-procesoid="<?= $key->procesoId ?>" data-estado="<?= $key->estado ?>"><i class="fa fa-trash"></i></a>
                                        <a href="#" class="btn btn-warning btn-sm btn-editarO" data-id="<?= $key->id ?>" data-proceso="<?= $key->proceso ?>" data-procesoid="<?= $key->procesoId ?>" data-estado="<?= $key->estado ?>" data-observaciones="<?= $key->observaciones ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="#" class="btn btn-primary btn-sm btn-verO" data-id="<?= $key->id ?>" data-proceso="<?= $key->proceso ?>" data-procesoid="<?= $key->procesoId ?>" data-estado="<?= $key->estado ?>" data-observaciones="<?= $key->observaciones ?>"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-success btn-sm btn-iniciarProceso" data-id="<?= $key->id ?>" data-proceso="<?= $key->proceso ?>" data-procesoid="<?= $key->procesoId ?>" data-estado="<?= $key->estado ?>"><i class="fa fa-play"></i> Iniciar/Ver</a>
                                    </td>
                                    <td>
                                        <a href="#" id="estadoProceso" class="btn btn-info btn-sm" data-estado="<?= $key->estado ?>" disable><?= $key->estado ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Edit Observaciones-->
            <form action="<?php echo base_url() . '/actualizarO' ?>" method="POST">
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Observaciones</h5>
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
                                <input type="hidden" name="transaccionId" class="transaccionId">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Edit Observaciones-->

            <!-- Modal ver Observaciones-->
            <div class="modal fade" id="verModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ver Observaciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Observaciones de proceso</h2>
                                </div>

                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Proceso</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="procesoOList">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="transaccionId" class="transaccionId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal ver Observaciones-->
        </div>
        <!--FIN LISTADO PROCESO-->
    </div>
    <div class="x_content" id="etapa" style="display: none">
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 id="tituloEtapas"><b> INFORMACIÓN DEL FLUJO DE ETAPAS</b></h4>
                </div><br><br><br>
                <div class="col-md-12 ">
                    <h4 id="tituloPp"><b> Proceso: <i id="procesoN"></i></b></h4>
                </div>
            </div>
            <br>
            <div class="row" id="tbl-etapa">
                <div class="col-md-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Etapa</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Fecha de Inicio</th>
                                <th>Hora de Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Hora Fin</th>
                            </tr>
                        </thead>
                        <tbody id="etapasData">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><i id="avisoE"></i></h4>
                </div>
            </div>
        </div>
        <!--FIN LISTADO PROCESO-->
        <br>
        <a href="#" id="recargarPP" class="btn btn-outline-secondary mb-2 volver-proceso"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>
    <div class="x_content" id="actividad" style="display: none">
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 id="tituloActividades"><b> INFORMACIÓN DEL FLUJO DE ACTIVIDADES</b></h4>
                </div><br><br><br>
                <div class="col-md-12 ">
                    <h4 id="tituloAC"><b> Etapa: <i id="etapaN"></i></b></h4>
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
                                <th>Ver Documento</th>
                            </tr>
                        </thead>
                        <tbody id="actividadData">

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
                                <tbody id="infoList">

                                </tbody>
                            </table>
                        </div>
                    </div><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><i id="avisoA"></i></h4>
                </div>
            </div>

            <div>
                <form action="<?php echo base_url() . '/listadoDocumentos' ?>" id="frm-id" method="GET">
                    <input type="hidden" name="transaccionActividadId" class="transaccionActividadId">
                    <!-- <input type="submit" value="Go"> -->
                </form>
            </div>
        </div>
        <!--FIN LISTADO PROCESO-->
        <br>
        <a href="#" id="recargarET" class="btn btn-outline-secondary mb-2 volver-etapa"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>
    <div class="x_content" id="procesoFinalizado" style="display: none">
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <div class="row text-center">
                <div class="col-md-12">
                    <h4><b>PROCESOS FINALIZADOS</b></h4>
                </div>
                <br><br><br>
                <div class="card-box table-responsive"><br>
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proceso</th>
                                <th>Institución</th>
                                <th>Encargado</th>
                                <th>Acciones</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="procesoList">
                            <?php foreach ($transaccionFin as $fin) : ?>
                                <tr>
                                    <td><?= $fin->id ?></td>
                                    <td><?= $fin->proceso ?></td>
                                    <td><?= $fin->institucion ?></td>
                                    <td><?= $fin->persona ?></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm btn-eliminarProceso" data-id="<?= $fin->id ?>" data-proceso="<?= $fin->proceso ?>" data-procesoid="<?= $fin->procesoId ?>" data-estado="<?= $fin->estado ?>"><i class="fa fa-trash"></i></a>
                                        <a href="#" class="btn btn-warning btn-sm btn-editarO" data-id="<?= $fin->id ?>" data-proceso="<?= $fin->proceso ?>" data-procesoid="<?= $fin->procesoId ?>" data-estado="<?= $fin->estado ?>" data-observaciones="<?= $fin->observaciones ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="#" class="btn btn-primary btn-sm btn-verO" data-id="<?= $fin->id ?>" data-proceso="<?= $fin->proceso ?>" data-procesoid="<?= $fin->procesoId ?>" data-estado="<?= $fin->estado ?>" data-observaciones="<?= $fin->observaciones ?>"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-success btn-sm btn-iniciarProcesoFin" data-id="<?= $fin->id ?>" data-proceso="<?= $fin->proceso ?>" data-procesoid="<?= $fin->procesoId ?>" data-estado="<?= $fin->estado ?>"><i class="fa fa-long-arrow-right"></i> Ver</a>
                                    </td>
                                    <td>
                                        <a href="#" id="estadoProceso" class="btn btn-info btn-sm" data-estado="<?= $fin->estado ?>" disable><?= $fin->estado ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <a href="#" class="btn btn-outline-secondary mb-2 volver-procesoFin"><i class="fa fa-angle-double-left"></i> Volver</a>
        </div>
        <!--FIN LISTADO PROCESO-->
    </div>
    <div class="x_content" id="etapaFin" style="display: none">
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 id="tituloEtapas"><b> INFORMACIÓN DEL FLUJO DE ETAPAS</b></h4>
                </div><br><br><br>
                <div class="col-md-12 ">
                    <h4 id="tituloPp"><b> Proceso: <i id="procesoN2"></i></b></h4>
                </div>
            </div>
            <br>
            <div class="row" id="tbl-etapa">
                <div class="col-md-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Etapa</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Fecha de Inicio</th>
                                <th>Hora de Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Hora Fin</th>
                            </tr>
                        </thead>
                        <tbody id="etapasData2">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><i id="avisoE"></i></h4>
                </div>
            </div>
        </div>
        <!--FIN LISTADO PROCESO-->
        <br>
        <a href="#" id="recargarPP" class="btn btn-outline-secondary mb-2 volver-procesoFinEtapa"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>
    <div class="x_content" id="actividadFin" style="display: none">
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 id="tituloActividades"><b> INFORMACIÓN DEL FLUJO DE ACTIVIDADES</b></h4>
                </div><br><br><br>
                <div class="col-md-12 ">
                    <h4 id="tituloAC"><b> Etapa: <i id="etapaN2"></i></b></h4>
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
                                <th>Ver Documento</th>
                            </tr>
                        </thead>
                        <tbody id="actividadData2">

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
                                <tbody id="infoList2">

                                </tbody>
                            </table>
                        </div>
                    </div><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><i id="avisoA"></i></h4>
                </div>
            </div>

            <div>
                <form action="<?php echo base_url() . '/listadoDocumentos' ?>" id="frm-id" method="GET">
                    <input type="hidden" name="transaccionActividadId" class="transaccionActividadId">
                    <!-- <input type="submit" value="Go"> -->
                </form>
            </div>
        </div>
        <!--FIN LISTADO PROCESO-->
        <br>
        <a href="#" id="recargarET" class="btn btn-outline-secondary mb-2 volver-etapaFin"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>
</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- <script src="vendors/select2/dist/js/select2.min.js"></script>
<script src="vendors/select2/dist/css/select2.min.css"></script> -->
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {

        /* $('.select-proceso').select2();
        $('.select-institucion').select2();
        $('.select-persona').select2(); */

        // Eliminar Proceso
        $('.btn-eliminarProceso').on('click', function() {
            // get data from button edit
            var id = $(this).data('id');
            var proceso = $(this).data('proceso');
            var procesoId = $(this).data('procesoid');
            var estado = $(this).data('estado');

            if (estado == 'Inactivo') {
                Swal.fire({
                    title: '¿Desea eliminar este proceso?',
                    text: "No podrá reverir este cambio",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "<?= base_url() . route_to('transaccionEliminar') ?>",
                            data: {
                                transaccionId: id
                            },
                            success: function(data) {

                                var dataEtapa = JSON.parse(data);

                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro fue borrado',
                                    'success'
                                )

                                location.href = "<?= base_url() . route_to('transaccionConfig') ?>";
                            }
                        });
                    }
                })
            } else if (estado == 'En Progreso') {
                Swal.fire({
                    title: '¿Desea eliminar este proceso?',
                    text: "No podrá reverir este cambio, se eliminaran todas las etapas y actividades de este proceso",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "<?= base_url() . route_to('transaccionEliminarP') ?>",
                            data: {
                                transaccionId: id
                            },
                            success: function(data) {

                                var dataEtapa = JSON.parse(data);

                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro fue borrado',
                                    'success'
                                )

                                location.href = "<?= base_url() . route_to('transaccionConfig') ?>";
                            }
                        });
                    }
                })
            } else if (estado == 'Finalizado') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No es posible eliminar un proceso Activo o Finalizado'
                })
            }
        });

        $('.btn-editarO').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const observaciones = $(this).data('observaciones');

            // Set data to Form Edit
            $('.transaccionId').val(id);
            $('#observacionesA').val(observaciones);
            // Call Modal Edit
            $('#editModal').modal('show');
            $('body').removeClass('modal-open'); 
            //$('.modal-backdrop').remove(); 
        });

        $('.btn-procesosFin').on('click', function() {
            $('#procesoFinalizado').css("display", "block");
            $('#proceso').hide();
            $('body').removeClass('modal-open'); 
            //$('.modal-backdrop').remove(); 
        });

        $('.btn-verO').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const observaciones = $(this).data('observaciones');

            var obData = $("#procesoOList");

            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('transaccionObservaciones') ?>",
                data: {
                    transaccionId: id
                },
                success: function(data) {

                    var dataDetO = JSON.parse(data);
                    console.log(dataDetO);

                    $("#etapasData").empty();

                    $.each(dataDetO, function(index, val) {
                        obData.append("<tr><td>" + val.id + "</td>" +
                            "<td>" + val.proceso + "</td>" +
                            "<td>" + val.observaciones + "</td>" +
                            "</tr>")
                    });
                }
            });

            verObservacionesAct(id);
            $('#verModal').modal('show');
            $('body').removeClass('modal-open'); 
            //$('.modal-backdrop').remove(); 
        });

        function verObservacionesAct(id) {
            var etData = $("#etapasData");

            //console.log(list, id);

            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('transaccionObservaciones') ?>",
                data: {
                    transaccionId: id
                },
                success: function(data) {

                    var dataDetO = JSON.parse(data);
                    console.log(dataDetO);

                    $("#etapasData").empty();

                    $.each(dataDetO, function(index, val) {
                        obData.append("<tr><td>" + val.id + "</td>" +
                            "<td>" + val.proceso + "</td>" +
                            "<td>" + val.observaciones + "</td>" +
                            "</tr>")
                    });
                }
            });
        }
        
        $('.btn-iniciarProceso').on('click', function() {
            // get data from button edit
            var id = $(this).data('id');
            var proceso = $(this).data('proceso');
            var procesoId = $(this).data('procesoid');

            $('#procesoN').html(proceso);

            var estado = $(this).data('estado');
            console.log(proceso);

            if (estado == 'Inactivo') {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() . route_to('transaccionEtapa') ?>",
                    data: {
                        procesoId: procesoId
                    },
                    success: function(data) {

                        var dataEtapa = JSON.parse(data);

                        console.log(dataEtapa);

                        var listado = dataEtapa[0]['etapaId'];

                        if (dataEtapa == '') {
                            $('#tbl-etapa').hide();
                            $('#avisoE').html('No hay etapas configuradas para este proceso.');
                        } else {
                            insertTDetalle(listado, id);
                            $('#recargarPP').attr('href', '<?= base_url() . route_to('transaccionConfig') ?>');
                        }
                    }
                });
            } else {
                etapaLista(id);
            }

            // Call Modal Edit
            $('#etapa').css("display", "block");
            $('#proceso').hide();
            $('#procesoFinalizado').hide();
            $('body').removeClass('modal-open'); 
            //$('.modal-backdrop').remove(); 
        });

        $('.btn-iniciarProcesoFin').on('click', function() {
            // get data from button edit
            var id = $(this).data('id');
            var proceso = $(this).data('proceso');
            var procesoId = $(this).data('procesoid');

            $('#procesoN2').html(proceso);

            var estado = $(this).data('estado');
            console.log(proceso);

            if (estado == 'Inactivo') {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() . route_to('transaccionEtapa') ?>",
                    data: {
                        procesoId: procesoId
                    },
                    success: function(data) {

                        var dataEtapa = JSON.parse(data);

                        console.log(dataEtapa);

                        var listado = dataEtapa[0]['etapaId'];

                        if (dataEtapa == '') {
                            $('#tbl-etapa').hide();
                            $('#avisoE').html('No hay etapas configuradas para este proceso.');
                        } else {
                            insertTDetalle(listado, id);
                            $('#recargarPP').attr('href', '<?= base_url() . route_to('transaccionConfig') ?>');
                        }
                    }
                });
            } else {
                etapaLista2(id);
            }

            // Call Modal Edit
            $('#etapaFin').css("display", "block");
            //$('#proceso').hide();
            $('#procesoFinalizado').hide();
            $('body').removeClass('modal-open'); 
            //$('.modal-backdrop').remove(); 
        });

        function insertTDetalle(list, id) {
            var etData = $("#etapasData");

            console.log(list, id);

            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('transaccionDet') ?>",
                data: {
                    etapaId: list,
                    transaccionId: id
                },
                success: function(data) {

                    var dataDet = JSON.parse(data);

                    console.log(dataDet);

                    $("#etapasData").empty();

                    $.each(dataDet, function(index, val) {
                        etData.append("<tr><td>" + val.id + "</td>" +
                            "<td>" + val.etapa + "</td>" +
                            "<td><a href='#' id='estadoTDet' class='btn btn-info btn-sm btn-estadoTDet' disable>" + val.estado + "</a></td>" +
                            "<td><a href='#' onclick='actividad(" + val.etapaId + " , " + val.id + ", \"" + val.estado + "\" , \"" + val.etapa + "\")' class='btn btn-primary btn-sm btn-actividad' ><i class='fa fa-tasks'></i> Actividades</a>" +
                            "</td>" +
                            "<td>" + val.fechaInicio + "</td>" +
                            "<td>" + val.horaInicio + "</td>" +
                            "<td>" + val.fechaFin + "</td>" +
                            "<td>" + val.horaFin + "</td>" +
                            "</tr>")
                    });

                    var idTD = dataDet[0]['id'];
                    var etapaIdTD = dataDet[0]['etapaId'];

                    console.log('etapa', etapaIdTD, 'tdetalle', idTD);
                    actividadTransaccion(etapaIdTD, idTD);
                }
            });
        }

        function etapaLista(id) {
            var etapaData = $("#etapasData");
            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('transaccionList') ?>",
                data: {
                    transaccionId: id
                },
                success: function(data) {

                    var dataEtapaList = JSON.parse(data);

                    console.log(dataEtapaList);

                    $("#etapasData").empty();

                    $.each(dataEtapaList, function(index, val) {
                        etapaData.append("<tr><td>" + val.id + "</td>" +
                            "<td>" + val.etapa + "</td>" +
                            "<td><a href='#' id='estadoTDet' class='btn btn-info btn-sm btn-estadoTDet' disable>" + val.estado + "</a></td>" +
                            "<td><a href='#' onclick='actividad(" + val.etapaId + " , " + val.id + " , \"" + val.estado + "\" , \"" + val.etapa + "\")' class='btn btn-primary btn-sm btn-actividad' ><i class='fa fa-tasks'></i> Actividades</a>" +
                            "</td>" +
                            "<td>" + val.fechaInicio + "</td>" +
                            "<td>" + val.horaInicio + "</td>" +
                            "<td>" + val.fechaFin + "</td>" +
                            "<td>" + val.horaFin + "</td>" +
                            "</tr>")
                    });
                }
            });
        }

        function etapaLista2(id) {
            var etapaData = $("#etapasData2");
            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('transaccionList') ?>",
                data: {
                    transaccionId: id
                },
                success: function(data) {

                    var dataEtapaList = JSON.parse(data);

                    console.log(dataEtapaList);

                    $("#etapasData2").empty();

                    $.each(dataEtapaList, function(index, val) {
                        etapaData.append("<tr><td>" + val.id + "</td>" +
                            "<td>" + val.etapa + "</td>" +
                            "<td><a href='#' id='estadoTDet' class='btn btn-info btn-sm btn-estadoTDet' disable>" + val.estado + "</a></td>" +
                            "<td><a href='#' onclick='actividad2(" + val.etapaId + " , " + val.id + " , \"" + val.estado + "\" , \"" + val.etapa + "\")' class='btn btn-primary btn-sm btn-actividad' ><i class='fa fa-tasks'></i> Actividades</a>" +
                            "</td>" +
                            "<td>" + val.fechaInicio + "</td>" +
                            "<td>" + val.horaInicio + "</td>" +
                            "<td>" + val.fechaFin + "</td>" +
                            "<td>" + val.horaFin + "</td>" +
                            "</tr>")
                    });
                }
            });
        }

        $('.btn-estado').on('click', function() {
            // get data from button edit
            const idE = $(this).data('id');
            const nombreE = $(this).data('nombre');
            //const tipoProcesoE = $(this).data('tipoProceso');

            // Set data to Form Edit
            $('.procesoId').val(idE);
            $('.nombreProceso').val(nombreE);
            $('#procesoEtapa').val(nombreE);
            $('#procesoNom').val(nombreE);
            $('#procesoE').val(idE);
            $('#tituloP').css("color", "#010806");
            $('#tituloP').css("font-size", 16);
            //$("#etapaData").find("tr:gt(0)").remove();

            var eData = $("#etapaData");

            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('etapa') ?>",
                data: {
                    procesoId: idE
                },
                success: function(data) {

                    var dataEtapa = JSON.parse(data);

                    //console.log(dataEtapa[0]['proceso']);
                    //console.log(dataEtapa.length);
                    $("#etapaData").empty();

                    $.each(dataEtapa, function(index, val) {
                        eData.append("<tr><td>" + val.id + "</td>" +
                            "<td>" + val.nombre + "</td>" +
                            "<td>" + val.orden + "</td>" +
                            "<td>" + val.proceso + "</td>" +
                            "<td><a href='#' onclick='actualizarEtapa(" + val.procesoId + " , " + val.id + ")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> Editar</a>" +
                            "<a href='#' onclick='borrarEtapa(" + val.id + " , " + val.procesoId + " )' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> Eliminar</a>" +
                            "<a href='#' onclick='actividad(" + val.id + ")' class='btn btn-primary btn-sm btn-actividad' data-i='" + val.id + "' data-n='" + val.nombre + "'><i class='fa fa-tasks'></i> Actividades</a>" +
                            "</td></tr>")
                    });
                }
            });

            // Call Modal Edit
            //$('#editModal').modal('show');
            $('#etapa').css("display", "block");
            $('#proceso').hide();
            $('#procesoFinalizado').hide();
            $('body').removeClass('modal-open'); 
            //$('.modal-backdrop').remove(); 
        });

    });

    function actividadTransaccion(etapaId, id) {
        //id: es el id de transaccionDetalleId

        console.log(etapaId, id);

        //actividadesLista(id);

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('transaccionActividad') ?>",
            data: {
                etapaId: etapaId
            },
            success: function(data) {

                var dataActividad = JSON.parse(data);

                console.log(dataActividad);
                var listadoA = dataActividad[0]['actividadId'];

                if (dataActividad == '') {
                    //$('#tbl-actividad').hide();
                    $('#avisoA').html('No hay actividades configuradas para esta etapa.');
                    console.log('vacio');
                } else {
                    insertTActividades(listadoA, id);
                    console.log(listadoA);
                }
            }
        });
    }

    function actividad(etapaId, id, estado, etapa) {
        //id: es esl id de transaccionDetalleId

        $('#etapaN').html(etapa);

        console.log(etapaId, id, estado, etapa);

        var actData = $("#actividadData");
        var infoData = $("#infoList");

        $.ajax({
            type: "POST",
            url: "<?= base_url() . route_to('transaccionActList') ?>",
            data: {
                transaccionDetalleId: id
            },
            success: function(data) {

                var dataActividadList = JSON.parse(data);

                console.log(dataActividadList);

                $("#actividadData").empty();
                $("#infoList").empty();

                $.each(dataActividadList, function(index, val) {
                    actData.append("<tr><td>" + val.id + "</td>" +
                        "<td>" + val.actividad + "</td>" +
                        "<td>" + val.persona + "</td>" +
                        "<td><a href='#' id='estadoTDet' class='btn btn-info btn-sm btn-estadoTDet' disable>" + val.estado + "</a></td>" +
                        "<td><a href='#' onclick='documentoLista(" + val.id + ")' class='btn btn-primary btn-sm'><i class='fa fa-tasks'></i> Ver Documentos</a>" +
                        "</td></tr>")

                    infoData.append("<tr><td>" + val.id + "</td>" +
                        "<td>" + val.actividad + "</td>" +
                        "<td>" + val.fechaCreacion + "</td>" +
                        "<td>" + val.horaCreacion + "</td>" +
                        "<td>" + val.fechaInicio + "</td>" +
                        "<td>" + val.horaInicio + "</td>" +
                        "<td>" + val.fechaFin + "</td>" +
                        "<td>" + val.horaFin + "</td></tr>")
                });
            }
        });


        // ACTIVAR DIV
        $('#actividad').css("display", "block");
        $('#etapa').hide();
    }

    function actividad2(etapaId, id, estado, etapa) {
        //id: es esl id de transaccionDetalleId

        $('#etapaN2').html(etapa);

        console.log(etapaId, id, estado, etapa);

        var actData = $("#actividadData2");
        var infoData = $("#infoList2");

        $.ajax({
            type: "POST",
            url: "<?= base_url() . route_to('transaccionActList') ?>",
            data: {
                transaccionDetalleId: id
            },
            success: function(data) {

                var dataActividadList = JSON.parse(data);

                console.log(dataActividadList);

                $("#actividadData2").empty();
                $("#infoList2").empty();

                $.each(dataActividadList, function(index, val) {
                    actData.append("<tr><td>" + val.id + "</td>" +
                        "<td>" + val.actividad + "</td>" +
                        "<td>" + val.persona + "</td>" +
                        "<td><a href='#' id='estadoTDet' class='btn btn-info btn-sm btn-estadoTDet' disable>" + val.estado + "</a></td>" +
                        "<td><a href='#' onclick='documentoLista(" + val.id + ")' class='btn btn-primary btn-sm'><i class='fa fa-tasks'></i> Ver Documentos</a>" +
                        "</td></tr>")

                    infoData.append("<tr><td>" + val.id + "</td>" +
                        "<td>" + val.actividad + "</td>" +
                        "<td>" + val.fechaCreacion + "</td>" +
                        "<td>" + val.horaCreacion + "</td>" +
                        "<td>" + val.fechaInicio + "</td>" +
                        "<td>" + val.horaInicio + "</td>" +
                        "<td>" + val.fechaFin + "</td>" +
                        "<td>" + val.horaFin + "</td></tr>")
                });
            }
        });

        // ACTIVAR DIV
        $('#actividadFin').css("display", "block");
        $('#etapaFin').hide();
    }

    function documentoLista(id){

        $('.transaccionActividadId').val(id);

        $( "#frm-id" ).submit();

        location.href = "<?= base_url() . route_to('listadoDocumentos') ?>?transaccionActividadId=" +id;
    }

    function insertTActividades(listadoA, id) {
        var aData = $("#actividadData");

        console.log(listadoA, id);

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('transaccionActDet') ?>",
            data: {
                actividadId: listadoA,
                transaccionDetalleId: id
            },
            success: function(data) {

                var dataDetAct = JSON.parse(data);

                console.log(dataDetAct);
            }
        });
    }

    // volver a proceso 
    $('.volver-proceso').on('click', function() {

        $('#etapa').hide();
        $('#proceso').css("display", "block");
        
    });

    // volver a proceso 
    $('.volver-procesoFin').on('click', function() {

        $('#proceso').css("display", "block");
        $('#procesoFinalizado').hide();
    });

    $('.volver-procesoFinEtapa').on('click', function() {
        $('#etapaFin').hide();
        $('#procesoFinalizado').css("display", "block");
    });

    // volver a etapa 
    $('.volver-etapa').on('click', function() {

        $('#etapa').css("display", "block");
        $('#actividad').hide();
        $('#procesoFinalizado').hide();
    });

    $('.volver-etapaFin').on('click', function() {

        $('#etapaFin').css("display", "block");
        $('#actividadFin').hide();
        $('#procesoFinalizadoFin').hide();
    });

</script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal('', 'Falló Agregar', 'error');
    } else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    } else if (mensaje == '3') {
        swal('', 'Falló Eliminar Registro', 'error');
    } else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    } else if (mensaje == '5') {
        swal('', 'Falló actualizar', 'error');
    } 
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            language: {
                url: 'vendors/datatables.net/es.json'
            },
            "order": [[0, 'asc']],
        });
    });
</script>

<?= $this->endSection() ?>