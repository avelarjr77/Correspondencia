<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- Formulario para agregar ROLES -->
<div class="x_panel">
    <div class="x_title">
        <h2>Agregar<small>Roles</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a class="dropdown-item" href="#">Settings 1</a>
                    </li>
                    <li><a class="dropdown-item" href="#">Settings 2</a>
                    </li>
                </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br>
        <form method="POST" action="<?php echo base_url() . '/crearRol' ?>">
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre de Rol <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="nombreRol" name="nombreRol" required="required" class="form-control ">
                </div>                  
            </div>
            <button class="btn btn-primary" type="submit">Agregar</button>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Rol</th>
                            <th scope="col" colspan="2">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datos as $rol): ?>
                        <tr>
                            <td><?php echo $rol->rolId ?></td>
                            <td><?php echo $rol->nombreRol ?></td>
                            <td>
                                <a href="<?php echo base_url().'/modAdministracion/RolController/obtenerRol/'.$rol->rolId ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="<?php echo base_url().'/modAdministracion/RolController/eliminar/'.$rol->rolId ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>

                        </tr>
                        <?php endforeach; ?> 

                    </tbody>
                </table>

            </div>

        </form>
    </div>
</div>
<!-- End Formulario para agregar ROLES -->
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    let mensaje = '<?php echo $mensaje ?>';

    if (mensaje == '0') {
        swal(':D', 'Rol agregado', 'success');
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
    $('#modalEliminar').on('show.bs.modal', function(e){
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<?= $this->endSection() ?>