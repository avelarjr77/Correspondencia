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
        <a href="<?= base_url().route_to('persona') ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-cogs"></i> Configurar Persona</a>
        <br>

        <!--LISTADO DE DIRECCION-->
        <div class="x_content">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Persona</th>
                        <th>Tipo Dirección</th>
                        <th>Dirección</th>
                        <th>Municipio</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody><?php foreach($datos as $key): ?>
                    <tr>
                        <td><?php echo $key->id ?></td>
                        <td><?php echo $key->nombre ?></td>
                        <td><?php echo $key->tipoDireccion ?></td>
                        <td><?php echo $key->direccion ?></</td>
                        <td><?php echo $key->municipio ?></</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>" data-tipoDireccion="<?php echo $key->tipoDireccion ?>" data-direccion="<?php echo $key->direccion ?>" data-municipio="<?php echo $key->municipio ?>" data-municipioId="<?php echo $key->municipioId ?>" data-personaId="<?php echo $key->personaId ?>" ><i class="fa fa-pencil-square-o"></i> Editar</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $key->id ?>" data-nombre="<?php echo $key->nombre ?>" data-tipoDireccion="<?php echo $key->tipoDireccion ?>" data-direccion="<?php echo $key->direccion ?>" data-municipio="<?php echo $key->municipio ?>" data-municipioId="<?php echo $key->municipioId ?>" data-personaId="<?php echo $key->personaId ?>" ><i class="fa fa-trash"></i> Eliminar</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar tipo de Dirección</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Persona: </label>
                        <select name="personaId" class="form-control personaId" required="required">
                            <option value="">-Selecciona una persona-</option>
                            <?php foreach ($persona as $pers): ?>
                                <option value="<?php echo $pers->personaId ?>"><?php echo $pers->nombres ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tipo de Dirección:</label>
                        <select name="tipoDireccion" class="form-control tipoDireccion" required="required">
                            <option value="" disable>-Selecciona un tipo de dirección-</option>
                            <option value="P">Principal</option>
                            <option value="S">Secundaria</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" id="nombreDireccion" name="nombreDireccion" required="required" autocomplete="off" class="form-control nombreDireccion">
                    </div>

                    <div class="form-group">
                        <label>Departamento:</label>
                        <select name="departamentoId" class="form-control departamentoId" required="required">
                            <option value="">-Selecciona un Departamento-</option>
                            <?php foreach ($departamento as $dep): ?>
                                <option value="<?php echo $dep->deptoId ?>"><?php echo $dep->nombreDepto ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Municipio:</label>
                        <select name="municipioId" class="form-control municipioId" required="required">
                            <option value="">-Selecciona un Municipio-</option>
                            <?php foreach ($municipio as $mun): ?>
                                <option value="<?php echo $mun->municipioId ?>"><?php echo $mun->nombreMunicipio ?></option>
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
                            <?php foreach ($persona as $pers): ?>
                                <option value="<?php echo $pers->personaId ?>"><?php echo $pers->nombres ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tipo de Dirección:</label>
                        <select name="tipoDireccion" class="form-control tipoDireccion" required="required">
                            <option value="" disable>-Selecciona un tipo de dirección-</option>
                            <option value="P">Principal</option>
                            <option value="S">Secundaria</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" id="nombreDireccion" name="nombreDireccion" required="required" autocomplete="off" class="form-control nombreDireccion">
                    </div>

                    <div class="form-group">
                        <label>Municipio:</label>
                        <select name="municipioId" class="form-control municipioId" required="required">
                            <option value="">-Selecciona una persona-</option>
                            <?php foreach ($municipio as $mun): ?>
                                <option value="<?php echo $mun->municipioId ?>"><?php echo $mun->nombreMunicipio ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="direccionId" class="direccionId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- End Modal Edit DIRECCION-->

        <!-- Modal Delete DIRECCION-->
        <form action="<?php echo base_url() . '/eliminarDireccion' ?>" method="POST">
            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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

    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal('', 'Agregado', 'success');
    } else if (mensaje == '1') {
        swal('', 'No se agrego', 'error');
    }else if (mensaje == '2') {
        swal('', 'Eliminado', 'success');
    }else if (mensaje == '3') {
        swal('', 'No se Elimino Registro', 'error');
    }else if (mensaje == '4') {
        swal('', 'Actualizado con exito', 'success');
    }else if (mensaje == '5') {
        swal('', 'No se actualizo', 'error');
    }
</script>

<script>
    $(document).ready(function(){

        // get Edit Tipo Direccion
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const tipoDireccion = $(this).data('tipoDireccion');
            const direccion = $(this).data('direccion');
            const municipio = $(this).data('municipio');
            const municipioId = $(this).data('municipioId');
            const persona = $(this).data('personaId');
            

            // Set data to Form Edit
            $('.direccionId').val(id);
            $('.personaId').val(nombre).trigger('change');
            $('.tipoDireccion').val(tipoDireccion);
            $('.nombreDireccion').val(direccion);
            $('.municipioId').val(municipio).trigger('change');
            //$('.municipioId').val(municipioId);
           // $('.personaId').val(persona);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Direccion
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const tipoDireccion = $(this).data('tipoDireccion');
            const direccion = $(this).data('direccion');
            const municipio = $(this).data('municipio');
            const municipioId = $(this).data('municipioId');
            const personaId = $(this).data('personaId');
            
            // Set data to Form Edit
            $('.direccionId').val(id);
            $('.direccionN').html(direccion);

            // Call Modal Edit
            $('#eliminarModal').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>