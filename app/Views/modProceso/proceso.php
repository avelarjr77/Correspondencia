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
        <a href="<?= base_url().route_to('tipoProceso') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Tipo Proceso</a>
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Proceso</th>
                        <th>Tipo de Proceso</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datos as $key): ?>
                    <tr>
                        <td><?= $key->id ?></td>
                        <td><?= $key->nombre ?></td>
                        <td><?= $key->tipoProceso ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-tipoProceso="<?= $key->tipoProceso ?>" ><i class="fa fa-pencil-square-o"></i> Editar</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>"><i class="fa fa-trash"></i> Eliminar</a>
                            <a href="#" class="btn btn-primary btn-sm btn-etapa" data-id="<?= $key->id ?>" data-nombre="<?= $key->nombre ?>" data-tipoProceso="<?= $key->tipoProceso ?>" ><i class="fa fa-tasks"></i> Etapas</a>
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
                        <input type="text" id="nombreProceso" name="nombreProceso" required="required" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Tipo de Proceso: </label>
                        <select name="tipoProcesoId" class="form-control tipoProcesoId">
                            <option value="">-Selecciona un tipo de proceso-</option>
                            <?php foreach ($tipoProceso as $tp): ?>
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
                            <?php foreach ($tipoProceso as $tp): ?>
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

    <div class="container" id="etapa" style="display: none">
        <!--LISTADO DE ETAPA-->
        <div class="x_content">
            <button type="button" class="btn btn-outline-success mb-2 btn-agregar" data-toggle="modal" data-target="#agregarEtapaModal"><i class="fa fa-plus"></i> Agregar Etapa</button>
            <br><br>
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
        <!--FIN LISTADO ETAPA-->

        <!-- Modal Agregar ETAPA-->
        <form action="<?php echo base_url() . '/crearEtapa' ?>" method="POST">
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
                        <input type="text" id="nombreEtapa" name="nombreEtapa" required="required" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Orden</label>
                        <input type="number" id="orden" name="orden" required="required" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Proceso</label>
                        <input type="text" id="procesoEtapa" name="proceso" required="required" autocomplete="off" class="form-control"  readonly>
                    </div>

                    <div class="form-group">
                        <input type="text" id="procesoE" name="procesoId" class="form-control"  hidden>
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
        <!-- End Modal Agregar ETAPA-->

        <!-- Modal Edit ETAPA-->
        <form action="<?php echo base_url() . '/actualizarEtapa' ?>" method="POST">
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
                        <input type="text" id="procesoA" name="proceso" required="required" autocomplete="off" class="form-control"  readonly>
                    </div>

                    <div class="form-group">
                        <input type="text" id="procesoIdA" name="procesoId" class="form-control"  hidden>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="etapaId" class="etapaId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit ETAPA-->

        <!-- Modal Delete ETAPA-->
        <form action="<?php echo base_url() . '/eliminarEtapa' ?>" method="POST">
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
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="etapaId" class="etapaId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">SI</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Delete ETAPA-->

        <br>
        <a href="<?= base_url().route_to('proceso') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>

    <div class="container" id="actividad" style="display: none">
        <!--LISTADO DE ETAPA-->
        <div class="x_content">
            <button type="button" class="btn btn-outline-success mb-2 btn-agregarActividad" data-toggle="modal" data-target="#agregarActividadModal"><i class="fa fa-plus"></i> Agregar Actividad</button>
            <br><br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Actividad</th>
                        <th>Descripción</th>
                        <th>Etapa</th>
                        <th>Encargado</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody id="actividadData">
                    
                </tbody>
            </table>
        </div>
        <!--FIN LISTADO ETAPA-->

        <br>
        <a href="<?= base_url().route_to('proceso') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-angle-double-left"></i> Volver</a>
    </div>

</div>

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal(':D', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal(':c', 'No se agrego', 'error');
    }else if (mensaje == '2') {
        swal(':D', 'Eliminado', 'success');
    }else if (mensaje == '3') {
        swal(':c', 'No se Elimino Registro', 'error');
    }else if (mensaje == '4') {
        swal(':D', 'Actualizado con exito', 'success');
    }else if (mensaje == '5') {
        swal(':c', 'No se actualizo', 'error');
    }
</script>

<script>
    $(document).ready(function(){

        // get Edit 
        $('.btn-edit').on('click',function(){
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
        $('.btn-delete').on('click',function(){
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
        $('.btn-etapa').on('click',function(){
            // get data from button edit
            const idE = $(this).data('id');
            const nombreE = $(this).data('nombre');
            //const tipoProcesoE = $(this).data('tipoProceso');

            // Set data to Form Edit
            $('.procesoId').val(idE);
            $('.nombreProceso').val(nombreE);

            var eData = $("#etapaData");;

            $.ajax({
                type: "GET",
                url: "<?= base_url().route_to('etapa') ?>",
                data: {procesoId: idE},
                success:function(data){

                    var dataEtapa = JSON.parse(data);
                    
                    //console.log(dataEtapa[0]['proceso']);
                    //console.log(dataEtapa.length);

                    var proceso = dataEtapa[0]['proceso'];
                    //console.log(proceso);
                    $('#procesoEtapa').val(proceso);
                    $('#procesoE').val(dataEtapa[0]['procesoId']);

                    $.each(dataEtapa, function(index, val) {
                        eData.append("<tr><td>"+val.id+"</td>"+
                        "<td>"+val.nombre+"</td>"+
                        "<td>"+val.orden+"</td>"+
                        "<td>"+val.proceso+"</td>"+
                        "<td><a href='#' onclick='actualizarEtapa("+val.procesoId+" , "+val.id+")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> Editar</a>"+
                        "<a href='#' onclick='borrarEtapa("+val.id+")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> Eliminar</a>"+
                        "<a href='#' onclick='actividad("+val.id+")' class='btn btn-primary btn-sm btn-actividad' data-idac='"+val.id+"' data-nombreac='"+val.nombre+"'><i class='fa fa-tasks'></i> Actividades</a>"+
                        "</td></tr>")
                    });
                }
            });

            // Call Modal Edit
            //$('#editModal').modal('show');
            $('#etapa').css("display", "block");
            $('#proceso').hide();
        });

        
    });

    function borrarEtapa(id) { 
        $('.etapaId').val(id);
        $('.etapaN').html(id);

        // Call Modal Edit
        $('#eliminarEtapaModal').modal('show');
        
    }

    function actualizarEtapa(idA, idE) { 
        //$('.etapaId').val(id);
       // console.log(idE);

        $.ajax({
                type: "GET",
                url: "<?= base_url().route_to('etapaList') ?>",
                data: {procesoId: idA},
                success:function(data){

                    var dataA = JSON.parse(data);

                    for(var k in dataA) {
                        if(dataA[k]['id'] == idE) {
                            var i = k;
                        };
                        //console.log(i);
                    } 
                    
                    console.log(dataA);
                    console.log(i);
                    //console.log(dataA.length);

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

    function actividad(idAC) { 
        // Set data to Form Edit
        $('.etapaId').val(idAC);
        //$('.nombreEtapa').val(nombreE); 

        var aData = $("#actividadData");;

        $.ajax({
            type: "GET",
            url: "<?= base_url().route_to('actividad') ?>",
            data: {etapaId: idAC},
            success:function(data){

                var dataActividad = JSON.parse(data);
                
                //console.log(dataEtapa[0]['proceso']);
                //console.log(dataEtapa.length);

                /* var proceso = dataEtapa[0]['proceso'];
                //console.log(proceso);
                $('#procesoEtapa').val(proceso);
                $('#procesoE').val(dataEtapa[0]['procesoId']); */

                $.each(dataActividad, function(index, val) {
                    aData.append("<tr><td>"+val.id+"</td>"+
                    "<td>"+val.nombre+"</td>"+
                    "<td>"+val.descripcion+"</td>"+
                    "<td>"+val.etapa+"</td>"+
                    "<td>"+val.persona+"</td>"+
                    "<td><a href='#' onclick='actualizarActividad("+val.etapaId+" , "+val.id+")' class='btn btn-warning btn-sm btn-editEtapa' ><i class='fa fa-pencil-square-o'></i> Editar</a>"+
                    "<a href='#' onclick='borrarActividad("+val.id+")' class='btn btn-danger btn-sm btn-deleteEtapa' ><i class='fa fa-trash'></i> Eliminar</a>"+
                    "</td></tr>")
                });
            }
        });

        // Call Modal Edit
        $('#actividad').css("display", "block");
        $('#etapa').hide();
    }

</script>

<?= $this->endSection() ?>
