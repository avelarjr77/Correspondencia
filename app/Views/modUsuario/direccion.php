<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!---------DIRECCION---------------------------------------------------------->
<div class="x_panel">
    <div class="x_title">
        <h2>Configuración de Dirección</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#agregarModal"><i class="fa fa-plus"></i> Agregar Dirección</button>
        <a href="<?= base_url() . route_to('persona') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Persona</a>
        <br>

        <!--LISTADO DE DIRECCION-->
        <div class="card-box table-responsive"><br>
            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Persona</th>
                        <th>Tipo Dirección</th>
                        <th>Dirección</th>
                        <th>Municipio</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody><?php foreach ($datos as $key) : ?>
                        <tr>
                            <td><?php echo $key->id ?></td>
                            <td><?php echo $key->nombre ?></td>
                            <td><?php echo $key->tipoDireccion ?></td>
                            <td><?php echo $key->direccion ?></< /td>
                            <td><?php echo $key->municipio ?></< /td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>" data-td="<?php echo $key->tipoDireccion ?>" data-direccion="<?php echo $key->direccion ?>" data-municipio="<?php echo $key->municipio ?>" data-municipioid="<?php echo $key->municipioId ?>" data-personaid="<?php echo $key->personaId ?>" ><i class="fa fa-pencil-square-o"></i> Editar</a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>" data-td="<?php echo $key->tipoDireccion ?>" data-direccion="<?php echo $key->direccion ?>" data-municipio="<?php echo $key->municipio ?>" data-municipioid="<?php echo $key->municipioId ?>" data-personaid="<?php echo $key->personaId ?>" ><i class="fa fa-trash"></i> Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!--FIN LISTADO DIRECCION-->

        <!-- Modal Agregar DIRECCION-->
        <form action="<?php echo base_url() . '/crearDireccion' ?>" method="POST">
            <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Dirección</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Persona: </label>
                                <select name="personaId" class="form-control" required="required">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($persona as $pers) : ?>
                                        <option value="<?php echo $pers->personaId ?>"><?php echo $pers->nombres ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tipo de Dirección:</label>
                                <select name="tipoDireccion" class="form-control" required="required">
                                    <option value="" disable>-Selecciona un tipo de dirección-</option>
                                    <option value="P">Principal</option>
                                    <option value="S">Secundaria</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Dirección:</label>
                                <input type="text" id="nombreDireccion" name="nombreDireccion" required="required" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Departamento:</label>
                                <select name="departamentoId" class="form-control departamentoIdC" required="required">
                                    <option value="">-Selecciona un Departamento-</option>
                                    <?php foreach ($departamento as $dep) : ?>
                                        <option value="<?php echo $dep->deptoId ?>"><?php echo $dep->nombreDepto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group" style="display: none" id="muni">
                                <label>Municipio:</label>
                                <select name="municipioId" class="form-control municipioIdC" required="required">
                                    
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
        <!-- End Modal Agregar DIRECCION-->

        <!-- Modal Edit DIRECCION-->
        <form action="<?php echo base_url() . '/actualizarDireccion' ?>" method="POST">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Dirección</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">

                                <label>Persona: </label>
                                <select name="personaId" class="form-control personaId" required="required">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($persona as $pers) : ?>
                                        <option value="<?php echo $pers->personaId ?>"><?php echo $pers->nombres ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tipo de Dirección:</label>
                                <select name="tipoDireccion" id="td" class="form-control td" required="required">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Dirección:</label>
                                <input type="text" id="nombreDireccion" name="nombreDireccion" required="required" autocomplete="off" class="form-control nombreDireccion">
                            </div>

                            <div class="form-group">
                                <label>Departamento:</label>
                                <select name="departamentoId" id="departamentoIdA" class="form-control departamentoIdA" required="required">
                                    <!-- <option value="">-Selecciona un Departamento-</option>
                                    <php foreach $departamento as $dep : ?>
                                        <option value="<php echo $dep->deptoId ?>"><php echo $dep->nombreDepto ?></option>
                                    <php endforeach; ?> -->
                                </select>
                            </div>

                            <div class="form-group" style="display: none" id="muniA">
                                <label>Municipio:</label>
                                <select name="municipioId" class="form-control municipioIdA" required="required">
                                    <option value="">-Selecciona una persona-</option>
                                    <?php foreach ($municipioA as $munic) : ?>
                                        <option value="<?php echo $munic->municipioId ?>"><?php echo $munic->nombreMunicipio ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="direccionId" class="direccionId">
                            <button type="button" class="btn btn-secondary btn-editar" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-editar">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit DIRECCION-->

        <!-- Modal Delete DIRECCION-->
        <form action="<?php echo base_url() . '/eliminarDireccion' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Dirección</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>¿Esta seguro que desea eliminar la Dirección: <b><i class="direccionN"></i></b> ?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="direccionId" class="direccionId">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Delete DIRECCION-->



    </div>
</div>
<!------------------------------------------------------------------->

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert2/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal('', 'No se agrego', 'error');
    } else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    } else if (mensaje == '3') {
        swal('', 'No se Elimino Registro', 'error');
    } else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    } else if (mensaje == '5') {
        swal('', 'No se actualizo', 'error');
    }
</script>

<script>
    $(document).ready(function() {

        $('.departamentoIdC').on('change', function() {
            var deptoId = $('.departamentoIdC').val();
            console.log(deptoId);

            var mData = $(".municipioIdC");

            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('obtenerMun') ?>",
                data: {
                    deptoId: deptoId
                },
                success: function(data) {

                    var dataMun = JSON.parse(data);

                    console.log(dataMun);
                    $(".municipioIdC").empty();
                    $(".municipioIdC").append('<option value="">-Selecciona un Municipio-</option>');

                    $.each(dataMun, function(index, val) {
                        mData.append("<option value=" + val.municipioId + ">" + val.nombreMunicipio + "</option>")
                    });

                }
            });
            $("#muni").css("display", "block");
        });

        // get Edit Direccion
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const td = $(this).data('td');
            const direccion = $(this).data('direccion');
            const municipio = $(this).data('municipio');
            const municipioid = $(this).data('municipioid');
            const persona = $(this).data('personaid');
            console.log(td);

            $("#muniA").hide();
            llenarDepto(municipioid);
            seleccionarDepto(municipioid);

            $('.departamentoIdA').on('change', function() {
                var deptoId = $('.departamentoIdA').val();
                console.log(deptoId);

                var mData = $(".municipioIdA");

                $.ajax({
                    type: "GET",
                    url: "<?= base_url() . route_to('obtenerMunA') ?>",
                    data: {
                        deptoId: deptoId
                    },
                    success: function(data) {

                        var dataMun = JSON.parse(data);

                        console.log(dataMun);
                        $(".municipioIdA").empty();
                        $(".municipioIdA").append('<option value="">-Selecciona un Municipio-</option>');

                        $.each(dataMun, function(index, val) {
                            mData.append("<option value=" + val.municipioId + ">" + val.nombreMunicipio + "</option>")
                        });
                    }
                });

                $("#muniA").css("display", "block");
            });

            if (td == 'Principal') {
                $(".td").empty();
                $(".td").append('<option disable>-Selecciona un tipo de dirección-</option>'+
                            '<option value="P" selected>Principal</option>'+
                            '<option value="S">Secundaria</option>');
            }else{
                $(".td").empty();
                $(".td").append('<option disable>-Selecciona un tipo de dirección-</option>'+
                            '<option value="P">Principal</option>'+
                            '<option value="S" selected>Secundaria</option>');
            }

            // Set data to Form Edit
            $('.direccionId').val(id);
            $('.nombreDireccion').val(direccion);
            $('.municipioIdA').val(municipioid).trigger('change');
            $('.personaId').val(persona);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        $('.btn-editar').on('click', function() {
            $('.departamentoIdA').empty();
            $("#muniA").hide();
        });

        function seleccionarDepto(municipio) {
            var dData = $(".departamentoIdA");

            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('obtenerDepto') ?>",
                data: {
                    municipioId: municipio
                },
                success: function(data) {

                    var dataMuni = JSON.parse(data);

                    console.log(dataMuni);

                    var sel = document.getElementById("departamentoIdA"); 

                    for (var i = 0; i < sel.length; i++) {
                        //  Aca haces referencia al "option" actual
                        var opt = sel[i];

                        if (opt.value == dataMuni[0]['deptoId']) {
                            $('.departamentoIdA option[value='+opt.value+']').attr('selected','selected');
                        }
                    }
                }
            });
        }

        function llenarDepto(municipio) {
            var mData = $(".departamentoIdA");

            $.ajax({
                type: "GET",
                url: "<?= base_url() . route_to('obtenerDeptoList') ?>",
                success: function(data) {

                    var dataMun = JSON.parse(data);

                    console.log(dataMun);
                    $(".departamentoIdA").empty();
                    $(".departamentoIdA").append('<option value="">-Selecciona un Departamento-</option>');

                    $.each(dataMun, function(index, val) {
                        mData.append("<option value=" + val.deptoId + ">" + val.nombreDepto + "</option>")
                    });
                }
            });
        }

        // get Delete Direccion
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const tipoDireccion = $(this).data('tipodireccion');
            const direccion = $(this).data('direccion');
            const municipio = $(this).data('municipio');
            const municipioId = $(this).data('municipioid');
            const personaId = $(this).data('personaid');

            // Set data to Form Edit
            $('.direccionId').val(id);
            $('.direccionN').html(direccion);

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
            }
        });
    });
</script>

<?= $this->endSection() ?>