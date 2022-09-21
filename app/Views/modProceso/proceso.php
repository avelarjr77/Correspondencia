<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>


<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Proceso</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content" id="proceso">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Proceso</button>
        <a href="<?= base_url() . route_to('tipoProceso') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Tipo Proceso</a>
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="card-box table-responsive"><br>
            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Proceso</th>
                        <th>Tipo de Proceso</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $key) : ?>
                        <tr>
                            <td><?= $key->id ?></td>
                            <td><?= $key->nombre ?></td>
                            <td><?= $key->tipoProceso ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-tipoProceso="<?= $key->tipoProceso ?>"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>"><i class="fa fa-trash"></i> Eliminar</a>
                                <a href="#" class="btn btn-primary btn-sm btn-etapa" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-tipoProceso="<?= $key->tipoProceso ?>"><i class="fa fa-tasks"></i> Etapas</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <!--FIN LISTADO PROCESO-->

        <!-- Modal Agregar PROCESO-->
        <form action="<?php echo base_url() . '/crearProceso' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Proceso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Proceso</label>
                                <input type="text" id="nombreProceso" name="nombreProceso" required="required" minlength="4" maxlength="100" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Tipo de Proceso: </label>
                                <select name="tipoProcesoId" class="form-control tipoProcesoId" required>
                                    <option value="">-Selecciona un tipo de proceso-</option>
                                    <?php foreach ($tipoProceso as $tp) : ?>
                                        <option value="<?= $tp->tipoProcesoId ?>"><?= $tp->tipoProceso ?></option>
                                    <?php endforeach; ?>
                                </select>
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
        <!-- End Modal Agregar PROCESO-->

        <!-- Modal Edit PROCESO-->
        <form action="<?php echo base_url() . '/actualizarProceso' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Proceso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Proceso</label>
                                <input type="text" id="nombreProceso" name="nombreProceso" autocomplete="off" required="required" class="form-control nombreProceso">
                            </div>

                            <div class="form-group">
                                <label>Tipo de Proceso: </label>
                                <select name="tipoProcesoId" class="form-control tipoProcesoId">
                                    <option value="">-Selecciona un tipo de proceso-</option>
                                    <?php foreach ($tipoProceso as $tp) : ?>
                                        <option value="<?= $tp->tipoProcesoId ?>"><?= $tp->tipoProceso ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="procesoId" class="procesoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit PROCESO-->

        <!-- Modal Delete PROCESO-->
        <form action="<?php echo base_url() . '/eliminarProceso' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Proceso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar el Proceso: <b><i class="procesoN"></i></b> ?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="procesoId" class="procesoId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete PROCESO-->
    </div>

    <div class="x_content" id="etapa" style="display: none">
        <!--LISTADO DE ETAPA-->
        <div class="x_content">

            <div class="row">
                <div class="col-md-1">
                    <h4 id="tituloP">Proceso:</h4>
                </div>

                <div class="col-md-4">
                    <input type="text" id="procesoNom" name="proceso" class="form-control" readonly>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-success mb-2 btn-agregar" data-toggle="modal" data-target="#agregarEtapaModal"><i class="fa fa-plus"></i> Agregar Etapa</button>
                </div>
            </div>

            <br><br>
            <div id="tabla-etapa" style="display: none">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Etapa</th>
                            <th>Orden</th>
                            <th>Nombre del Proceso</th>
                            <th scope="col" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="etapaData">

                    </tbody>
                </table>
            </div>
        </div>
        <!--FIN LISTADO ETAPA-->

        <!-- Modal Agregar ETAPA-->
        <form action="" id="frmCrearEtapa" method="POST">
            <div class="modal fade" id="agregarEtapaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Etapa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Etapa</label>
                                <input type="text" id="nE" name="nombreEtapa" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Orden</label>
                                <input type="number" id="od" name="orden" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Proceso</label>
                                <input type="text" id="procesoEtapa" name="proceso" required="required" autocomplete="off" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <input type="text" id="procesoE" name="procesoId" class="form-control" hidden>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary btn-crearEtapa">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Agregar ETAPA-->

        <!-- Modal Edit ETAPA-->
        <form action="" id="frmEditarEtapa" method="POST">
            <div class="modal fade" id="actualizarEtapaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Etapa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre del Etapa</label>
                                <input type="text" id="nombreEtapaA" name="nombreEtapa" autocomplete="off" required="required" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Orden</label>
                                <input type="number" id="ordenA" name="orden" required="required" autocomplete="off" class="form-control ">
                            </div>

                            <div class="form-group">
                                <label>Proceso</label>
                                <input type="text" id="procesoA" name="proceso" required="required" autocomplete="off" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <input type="text" id="procesoIdA" name="procesoId" class="form-control" hidden>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="etapaId" id="etapaIdAc" class="etapaId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary btn-editarEtapa">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit ETAPA-->

        <!-- Modal Delete ETAPA-->
        <form action="" id="frmEliminarEtapa" method="POST">
            <div class="modal fade" id="eliminarEtapaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Etapa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar la Etapa: <b><i class="etapaN"></i></b> ?</h4>
                            <input type="hidden" id="procesoIdEP" class="etapaId">

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="etapaId" id="etapaIdE" class="etapaId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary btn-eliminarEtapa">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete ETAPA-->

        <br>
        <a href="#" class="btn btn-outline-secondary mb-2 volver-proceso"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>

    <div class="x_content" id="actividad" style="display: none">
        <!--LISTADO DE ACTIVIDAD-->
        <div class="x_content">
            <div class="row">
                <div class="col-md-1">
                    <h4 id="tituloE">Etapa:</h4>
                </div>

                <div class="col-md-4">
                    <input type="text" id="etapaNom" name="etapa" class="form-control" readonly>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-success mb-2 btn-agregarActividad" data-toggle="modal" data-target="#agregarActividadModal"><i class="fa fa-plus"></i> Agregar Actividad</button>
                </div>
            </div>

            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="tbl-actividad">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre de la Actividad</th>
                                <th>Descripción</th>
                                <th>Orden</th>
                                <th>Nombre de la Etapa</th>
                                <th>Encargado</th>
                                <th scope="col" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="actividadData">

                        </tbody>
                    </table>
                    <br>
                    <h4 id="aviso"></h4>
                </div>
            </div>
            
        </div>
        <!--FIN LISTADO ACTIVIDAD-->

        <!-- Modal Agregar ACTIVIDAD-->
        <form action="" id="frmCrearActividad" method="POST">
            <div class="modal fade" id="agregarActividadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar una nueva Actividad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre de la Actividad</label>
                                <input type="text" id="nombreActividad" name="nombreActividad" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" id="descripcion" name="descripcion" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Orden</label>
                                <input type="number" id="ordenA" name="orden" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Etapa</label>
                                <input type="text" id="actividadEtapa" name="etapa" required="required" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label>Encargado/a </label>
                                <select name="personaId" id="personaData" class="form-control">
                                    <option value="" disable>-Selecciona un encargado-</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <input type="number" id="actividadE" name="etapaId" class="form-control" hidden>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary btn-crearActividad">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Agregar ACTIVIDAD-->

        <!-- Modal Edit ACTIVIDAD-->
        <form action="" id="frmEditarActividad" method="POST">
            <div class="modal fade" id="editActividadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Actividad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre de la Actividad</label>
                                <input type="text" id="nombreActividadA" name="nombreActividad" autocomplete="off" required="required" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" id="descripcionA" name="descripcion" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Orden</label>
                                <input type="number" id="ordenAc" name="orden" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Etapa</label>
                                <input type="text" id="actividadEtapaN" name="etapa" required="required" autocomplete="off" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <input type="number" id="actEtapa" name="etapaId" class="form-control" hidden>
                            </div>

                            <div class="form-group">
                                <label>Encargado/a </label>
                                <select name="personaId" id="personaDataA" class="form-control">
                                    <option value="" disable>-Selecciona un encargado-</option>

                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="actividadId" id="actividadIdA">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary btn-editarActividad">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit ACTIVIDAD-->

        <!-- Modal Delete ACTIVIDAD-->
        <form action="" id="frmEliminarActividad" method="POST">
            <div class="modal fade" id="eliminarActividadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Actividad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar la Actividad: <b><i class="actividadN"></i></b> ?</h4>
                            <input type="hidden" id="EtapaIdAE">

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="actividadId" id="actividadIdE">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary btn-eliminarActividad">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete ACTIVIDAD-->

        <br>
        <a href="#" class="btn btn-outline-secondary mb-2 volver-etapa"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>

</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/select2/dist/js/select2.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {

        // get Edit 
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const tipoProceso = $(this).data('tipoProceso');

            // Set data to Form Edit
            $('.procesoId').val(id);
            $('.nombreProceso').val(nombre);
            $('.tipoProcesoId').val(tipoProceso);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete 
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            // Set data to Form Edit
            $('.procesoId').val(id);
            $('.procesoN').html(nombre);
            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });

        // get Etapa
        $('.btn-etapa').on('click', function() {
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

            //var eData = $("#etapaData");
            $("#etapaData").empty();
            recargarEtapa(idE);

            /* $.ajax({
                type: "GET",
                url: "<= base_url() . route_to('etapa') ?>",
                data: {
                    procesoId: idE
                },
                success: function(data) {

                    var dataEtapa = JSON.parse(data);

                    //console.log(dataEtapa[0]['proceso']);
                    $("#etapaData").empty();

                    $.each(dataEtapa, function(index, val) {
                        eData.append("<tr><td>" + val.id + "</td>" +
                            "<td>" + val.nombre + "</td>" +
                            "<td>" + val.orden + "</td>" +
                            "<td>" + val.proceso + "</td>" +
                            "<td><a href='#' onclick='actualizarEtapa(" + val.procesoId + " , " + val.id + ")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> Editar</a>" +
                            "<a href='#' onclick='borrarEtapa(" + val.id + " , " + val.procesoId + " )' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> Eliminar</a>" +
                            "<a href='#' onclick='actividad(" + val.id + " , \"" + val.nombre + "\")' class='btn btn-primary btn-sm btn-actividad' data-i='" + val.id + "' data-n='" + val.nombre + "'><i class='fa fa-tasks'></i> Actividades</a>" +
                            "</td></tr>")
                    });
                }
            }); */

            // Call Modal Edit
            //$('#editModal').modal('show');
            $('#etapa').css("display", "block");
            $('#proceso').hide();
        });

    });

    $('.btn-crearEtapa').on('click', function() {

        var idProcesoC = $('#procesoE').val();
        //var datosC = $("#etapaData");

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('crearEtapa') ?>",
            data: $("#frmCrearEtapa").serialize(),
            success: function(data) {

                var dataEEtapaC = JSON.parse(data);

                if (dataEEtapaC == '6') {
                    swal('', 'Etapa aregada con éxito', 'success');
                } else if (dataEEtapaC == '7') {
                    swal('', 'Falló agregar etapa', 'error');
                }
                console.log(dataEEtapaC);
                $('#nE').val('');
                $('#od').val('');

                recargarEtapa(idProcesoC);
            }
        });

        /* $.ajax({
            type: "GET",
            url: "<= base_url().route_to('etapaC') ?>",
            data: {procesoId: idProcesoC},
            success:function(data){

                var dataEtapaCE = JSON.parse(data);
                console.log(dataEtapaCE);
                
                $("#etapaData").empty();

                $.each(dataEtapaCE, function(index, val) {
                    datosC.append("<tr><td>"+val.id+"</td>"+
                    "<td>"+val.nombre+"</td>"+
                    "<td>"+val.orden+"</td>"+
                    "<td>"+val.proceso+"</td>"+
                    "<td><a href='#' onclick='actualizarEtapa("+val.procesoId+" , "+val.id+")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> Editar</a>"+
                    "<a href='#' onclick='borrarEtapa("+val.id+", "+val.procesoId+")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> Eliminar</a>"+
                    "<a href='#' onclick='actividad("+val.id+")' class='btn btn-primary btn-sm btn-actividad' data-i='"+val.id+"' data-n='"+val.nombre+"'><i class='fa fa-tasks'></i> Actividades</a>"+
                    "</td></tr>")
                });
            }
        }); */

        //recargarEtapa(idProcesoC);

        $('#agregarEtapaModal').modal('hide');
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal
    });

    function recargarEtapa(idPP) {
        var datosC = $("#etapaData");

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('etapaC') ?>",
            data: {
                procesoId: idPP
            },
            success: function(data) {

                var dataEtapaCE = JSON.parse(data);
                console.log(dataEtapaCE);

                $("#etapaData").empty();

                $.each(dataEtapaCE, function(index, val) {
                    datosC.append("<tr><td>" + val.id + "</td>" +
                        "<td>" + val.nombre + "</td>" +
                        "<td>" + val.orden + "</td>" +
                        "<td>" + val.proceso + "</td>" +
                        "<td><a href='#' onclick='actualizarEtapa(" + val.procesoId + " , " + val.id + ")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> </a>" +
                        "<a href='#' onclick='borrarEtapa(" + val.id + " , " + val.procesoId + " )' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> </a>" +
                        "<a href='#' onclick='actividad(" + val.id + ", \"" + val.nombre + "\")' class='btn btn-primary btn-sm btn-actividad' data-i='" + val.id + "' data-n='" + val.nombre + "'><i class='fa fa-tasks'></i> Actividades</a>" +
                        "</td></tr>")
                });

                $('#tabla-etapa').css("display", "block");
            }
        });
    }

    function borrarEtapa(id, idP) {
        $('.etapaId').val(id);
        $('#procesoIdEP').val(idP);
        $('.etapaN').html(id);

        // Call Modal Edit
        $('#eliminarEtapaModal').modal('show');
    }

    $('.btn-eliminarEtapa').on('click', function() {

        var idProceso = $('#procesoIdEP').val();
        //var datos = $("#etapaData");

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('eliminarEtapa') ?>",
            data: $("#frmEliminarEtapa").serialize(),
            success: function(data) {

                var dataEEtapa = JSON.parse(data);

                if (dataEEtapa == '8') {
                    swal('', 'Etapa eliminada con éxito', 'success');
                } else if (dataEEtapa == '9') {
                    swal('', 'Falló eliminar etapa', 'error');
                }

                console.log(dataEEtapa);
                recargarEtapa(idProceso);
            }
        });
        $('#eliminarEtapaModal').modal('hide');

        /* $.ajax({
            type: "GET",
            url: "<= base_url().route_to('etapaLN') ?>",
            data: {procesoId: idProceso},
            success:function(data){

                var dataEtapa = JSON.parse(data);
                
                $("#etapaData").empty();

                $.each(dataEtapa, function(index, val) {
                    datos.append("<tr><td>"+val.id+"</td>"+
                    "<td>"+val.nombre+"</td>"+
                    "<td>"+val.orden+"</td>"+
                    "<td>"+val.proceso+"</td>"+
                    "<td><a href='#' onclick='actualizarEtapa("+val.procesoId+" , "+val.id+")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> Editar</a>"+
                    "<a href='#' onclick='borrarEtapa("+val.id+", "+val.procesoId+")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> Eliminar</a>"+
                    "<a href='#' onclick='actividad("+val.id+")' class='btn btn-primary btn-sm btn-actividad' data-i='"+val.id+"' data-n='"+val.nombre+"'><i class='fa fa-tasks'></i> Actividades</a>"+
                    "</td></tr>")
                });
            }
        }); */

        //recargarEtapa(idProceso);
    });

    function actualizarEtapa(idA, idE) {
        //$('.etapaId').val(id);
        // console.log(idE);
        //idA es de id actualizar y trae procesoId
        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('etapaList') ?>",
            data: {
                procesoId: idA
            },
            success: function(data) {

                var dataA = JSON.parse(data);

                for (var k in dataA) {
                    if (dataA[k]['id'] == idE) {
                        var i = k;
                    };
                    //console.log(i);
                }

                $('#procesoA').val(dataA[i]['proceso']);
                $('#nombreEtapaA').val(dataA[i]['nombre']);
                $('#ordenA').val(dataA[i]['orden']);
                $('#procesoIdA').val(dataA[i]['procesoId']);
                $('.etapaId').val(dataA[i]['id']);

            }
        });

        // Call Modal Edit
        $('#actualizarEtapaModal').modal('show');
    }

    $('.btn-editarEtapa').on('click', function() {

        var idPA = $('#procesoIdA').val();
        //var datosActualizar = $("#etapaData");

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('actualizarEtapa') ?>",
            data: $("#frmEditarEtapa").serialize(),
            success: function(data) {

                var dataEAtapa = JSON.parse(data);

                if (dataEAtapa == '10') {
                    swal('', 'Etapa actualizada con éxito', 'success');
                } else if (dataEAtapa == '11') {
                    swal('', 'Falló actualizar etapa', 'error');
                }

                console.log(dataEAtapa);
                recargarEtapa(idPA);
            }
        });

        $('#actualizarEtapaModal').modal('hide');

        /* $.ajax({
            type: "GET",
            url: "<= base_url().route_to('etapaLNA') ?>",
            data: {procesoId: idPA},
            success:function(data){

                var dataEtapaAC = JSON.parse(data);

                console.log(dataEtapaAC)
                
                $("#etapaData").empty();

                $.each(dataEtapaAC, function(index, val) {
                    datosActualizar.append("<tr><td>"+val.id+"</td>"+
                    "<td>"+val.nombre+"</td>"+
                    "<td>"+val.orden+"</td>"+
                    "<td>"+val.proceso+"</td>"+
                    "<td><a href='#' onclick='actualizarEtapa("+val.procesoId+" , "+val.id+")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> Editar</a>"+
                    "<a href='#' onclick='borrarEtapa("+val.id+", "+val.procesoId+")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> Eliminar</a>"+
                    "<a href='#' onclick='actividad("+val.id+")' class='btn btn-primary btn-sm btn-actividad' data-i='"+val.id+"' data-n='"+val.nombre+"'><i class='fa fa-tasks'></i> Actividades</a>"+
                    "</td></tr>")
                });
            }
        }); */

        //recargarEtapa(idPA);
    });

    function actividad(idAC, etapa) {
        console.log(idAC, etapa);
        //idAC trae etapaId
        console.log(etapa);
        $('#actividadE').val(idAC);
        $('#etapaNom').empty();
        $('#etapaNom').val(etapa);
        $('#actividadEtapa').val(etapa);
        $('#tituloE').css("color", "#010806");
        $('#tituloE').css("font-size", 16);

        //var aData = $("#actividadData");
        $("#actividadData").empty();
        recargarActividad(idAC);

        // Call Modal Edit
        $('#actividad').css("display", "block");
        $('#etapa').hide();
    }

    function personaCrear() {
        //ajax para listar persona
        var pData = $("#personaData");
        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('personaList') ?>",
            success: function(data) {

                var dataPersona = JSON.parse(data);

                //console.log(dataPersona[0]['personaId']);
                //console.log(proceso);
                $("#personaData").empty();
                $('#personaData').append('<option disable>-Selecciona una persona-</option>');

                $.each(dataPersona, function(index, val) {
                    pData.append("<option value=" + val.personaId + ">" + val.nombres + "</option>")
                });
            }
        });
    }

    function recargarActividad(idA) {
        var datosACC = $("#actividadData");
        console.log(idA);

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('actividadC') ?>",
            data: {
                etapaId: idA
            },
            success: function(data) {

                var dataACList = JSON.parse(data);

                $("#actividadData").empty();

                $.each(dataACList, function(index, val) {
                    datosACC.append("<tr><td>" + val.id + "</td>" +
                        "<td>" + val.nombre + "</td>" +
                        "<td>" + val.descripcion + "</td>" +
                        "<td>" + val.ordenA + "</td>" +
                        "<td>" + val.etapa + "</td>" +
                        "<td>" + val.persona + "</td>" +
                        "<td><a href='#' onclick='actualizarActividad(" + val.id + " , " + val.etapaId + ")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> </a>" +
                        "<a href='#' onclick='borrarActividad(" + val.id + ", " + val.etapaId + ")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> </a>" +
                        "</td></tr>")
                });
            }
        });
    }

    $('.btn-agregarActividad').on('click', function() {
        $('#nombreActividad').val('');
        $('#descripcion').val('');
        $('#ordenA').val('');
        //$('#personaData').val('');
        personaCrear();
    });

    $('.btn-crearActividad').on('click', function() {

        var dEtapAC = $('#actividadE').val();

        console.log(dEtapAC);

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('crearActividad') ?>",
            data: $("#frmCrearActividad").serialize(),
            success: function(data) {

                var dataActividadCCN = JSON.parse(data);

                if (dataActividadCCN == '12') {
                    swal('', 'Actividad aregada con éxito', 'success');
                } else if (dataActividadCCN == '13') {
                    swal('', 'Falló agregar actividad', 'error');
                }

                /* $('#nombreActividad').val('');
                $('#descripcion').val('');
                $('#personaData').val(''); */
                console.log(dataActividadCCN);
                //listadoPersona();
                recargarActividad(dEtapAC);
            }
        });

        $('#agregarActividadModal').modal('hide');
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal

        /* $.ajax({
            type: "GET",
            url: "<= base_url().route_to('actividadC') ?>", 
            data: {etapaId: dEtapAC},
            success:function(data){

                var dataACList = JSON.parse(data);
                
                $("#actividadData").empty();

                $.each(dataACList, function(index, val) {
                    datosACC.append("<tr><td>"+val.id+"</td>"+
                    "<td>"+val.nombre+"</td>"+
                    "<td>"+val.descripcion+"</td>"+
                    "<td>"+val.etapa+"</td>"+
                    "<td>"+val.persona+"</td>"+
                    "<td><a href='#' onclick='actualizarActividad("+val.id+" , "+val.etapaId+")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> </a>"+
                    "<a href='#' onclick='borrarActividad("+val.id+", "+val.etapaId+")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> </a>"+
                    "</td></tr>")
                });
            }
        }); */
    });

    function borrarActividad(id, idEAc) {
        $('#actividadIdE').val(id);
        $('#EtapaIdAE').val(idEAc);
        $('.actividadN').html(id);

        // Call Modal Edit
        $('#eliminarActividadModal').modal('show');
    }

    $('.btn-eliminarActividad').on('click', function() {

        var idEtapaActNew = $('#EtapaIdAE').val();

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('eliminarActividad') ?>",
            data: $("#frmEliminarActividad").serialize(),
            success: function(data) {

                var dataActividadEl = JSON.parse(data);

                if (dataActividadEl == '14') {
                    swal('', 'Actividad eliminada con éxito', 'success');
                } else {
                    swal('', 'Falló eliminar actividad', 'error');
                }

                console.log(dataActividadEl);
                recargarActividad(idEtapaActNew);
            }
        });
        $('#eliminarActividadModal').modal('hide');

        /* $.ajax({
            type: "GET",
            url: "<= base_url().route_to('actividadLN') ?>",
            data: {etapaId: idEtapaActNew},
            success:function(data){

                var dataEtapaANew = JSON.parse(data);
                
                $("#actividadData").empty();

                $.each(dataEtapaANew, function(index, val) {
                    datosAN.append("<tr><td>"+val.id+"</td>"+
                    "<td>"+val.nombre+"</td>"+
                    "<td>"+val.descripcion+"</td>"+
                    "<td>"+val.etapa+"</td>"+
                    "<td>"+val.persona+"</td>"+
                    "<td><a href='#' onclick='actualizarActividad("+val.id+" , "+val.etapaId+")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> </a>"+
                    "<a href='#' onclick='borrarActividad("+val.id+", "+val.etapaId+")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> </a>"+
                    "</td></tr>")
                });
            }
        }); */

        //recargarActividad(idEtapaActNew);
    });

    function actualizarActividad(idActividad, idEtapa) {

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('actList') ?>",
            data: {
                etapaId: idEtapa
            },
            success: function(data) {

                var dataAct = JSON.parse(data);

                for (var k in dataAct) {
                    if (dataAct[k]['id'] == idActividad) {
                        var i = k;
                    };
                    //console.log(i);
                }

                $('#actividadEtapaN').val(dataAct[i]['etapa']);
                $('#actEtapa').val(dataAct[i]['etapaId']);
                $('#nombreActividadA').val(dataAct[i]['nombre']);
                $('#descripcionA').val(dataAct[i]['descripcion']);
                $('#ordenAc').val(dataAct[i]['ordenA']);
                $('#personaDataA').val(dataAct[i]['personaId']);
                $('#actividadIdA').val(dataAct[i]['id']);

            }
        });

        var pDataA = $("#personaDataA");

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('personaListA') ?>",
            success: function(data) {

                var dataP = JSON.parse(data);

                $('#personaDataA').empty();

                $.each(dataP, function(index, val) {
                    pDataA.append("<option value=" + val.personaId + ">" + val.nombres + "</option>")
                });
            }
        });

        // Call Modal Edit
        $('#editActividadModal').modal('show');
    }

    $('.btn-editarActividad').on('click', function() {

        var idANew = $('#actEtapa').val();

        $.ajax({
            type: "GET",
            url: "<?= base_url() . route_to('actualizarActividad') ?>",
            data: $("#frmEditarActividad").serialize(),
            success: function(data) {

                var dataEActividadN = JSON.parse(data);

                if (dataEActividadN == '16') {
                    swal('', 'Actividad actualizada con éxito', 'success');
                } else if (dataEActividadN == '17') {
                    swal('', 'Falló actualizar actividad', 'success');
                }

                console.log(dataEActividadN);
                recargarActividad(idANew);
            }
        });

        $('#editActividadModal').modal('hide');

    });

    // volver a proceso 
    $('.volver-proceso').on('click', function() {

        $('#proceso').css("display", "block");
        $('#etapa').hide();
    });

    // volver a etapa 
    $('.volver-etapa').on('click', function() {
        //recargarEtapa(idp);

        $('#etapa').css("display", "block");
        $('#actividad').hide();
    });
</script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    console.log(mensaje);

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
    } else if (mensaje == '6') {
        swal('', 'Datos duplicados o caracteres de puntuación no admitidos', 'error');
    } else if (mensaje == '7') {
        swal({
            icon: "error",
            title: "¡Este Proceso no puede ser eliminado!",
            text: "Lo sentimos, no se puede eliminar el Proceso porque está en uso por una Transacción."
        });
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