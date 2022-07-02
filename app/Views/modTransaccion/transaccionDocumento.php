<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Documento</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content" id="proceso">   
        <br>
        <!--LISTADO DE PROCESO-->
        <div class="x_content">
        <div class="x_content">
            <form id="frmProcesoInsti" action="<?= base_url() . '/crearTransaccion' ?>" method="POST">
                <h4 id="tituloProceso"><b>Seleccione el Proceso a abrir:</b></h4>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Proceso: </label>
                        <select name="procesoId" id="procesoId" class="form-control">
                            <option value="" disable>-Selecciona un proceso-</option>
                            <?php foreach ($datos as $p): ?>
                                <option value="<?= $p->procesoId ?>"><?= $p->nombreProceso ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Institución: </label>
                        <select name="institucionId" id="institucionId" class="form-control">
                            <option value="" disable>-Selecciona una institución-</option>
                            <?php foreach ($institucion as $i): ?>
                                <option value="<?= $i->institucionId ?>"><?= $i->nombreInstitucion ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Encargado: </label>
                        <select name="personaId" id="personaId" class="form-control">
                            <option value="" disable>-Selecciona un encargado-</option>
                            <?php foreach ($persona as $pe): ?>
                                <option value="<?= $pe->personaId ?>"><?= $pe->nombres ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button type="submit" class="btn btn-outline-primary btn-agregarProceso">Crear Proceso</button>
                    </div>
                </div>
            </form>
            <br><br><br>
            <div class="row">
                <div class="col-md-5">
                    <h4 id="tituloP"><b>Procesos creados para dar seguimiento</b></h4>
                </div>
                <br><br><br>
                <div class="col-md-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proceso</th>
                                <th>Institución</th>
                                <th>Encargado</th>
                                <th>Acción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="procesoList">
                            <?php foreach($transaccion as $key): ?>
                            <tr>
                                <td><?= $key->id ?></td>
                                <td><?= $key->proceso ?></td>
                                <td><?= $key->institucion ?></td>
                                <td><?= $key->persona ?></td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm btn-eliminarProceso" data-id="<?= $key->id ?>" data-proceso="<?= $key->proceso ?>" data-procesoid="<?= $key->procesoId ?>"  data-estado="<?= $key->estado ?>"><i class="fa fa-trash"></i> Eliminar</a>
                                    <a href="#" class="btn btn-success btn-sm btn-iniciarProceso" data-id="<?= $key->id ?>" data-proceso="<?= $key->proceso ?>" data-procesoid="<?= $key->procesoId ?>"  data-estado="<?= $key->estado ?>"><i class="fa fa-play"></i> Iniciar/Ver</a>
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
        </div>
        <!--FIN LISTADO PROCESO-->
        <br><br><br><br>
        <a href="<?= base_url().route_to('transaccionLista') ?>"  class="btn btn-outline-secondary mb-2 volver-etapa"><i class="fa fa-angle-double-left"></i> Volver</a>
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
    });

</script>



<?= $this->endSection() ?>
