<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>


<!-- BITACORA -->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Administración de Bitácora</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                    <!--LISTADO DE BITACORA-->
                    <div class="card-box table-responsive"><br>
                        <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Usuario</th>
                                        <th>Accion</th>
                                        <th>descripcion</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($datos as $key): ?>
                                    <tr>
                                        <td><?= $key->bitacoraId ?></td>
                                        <td><?= $key->usuario ?></td>
                                        <td><?= $key->accion ?></td>
                                        <td><?= $key->descripcion ?></td>
                                        <td><?= $key->fecha ?></td>
                                        <td><?= $key->hora ?></td>
                                    </tr>
                                    <?php endforeach; ?> 

                                </tbody>
                        </table>
                    </div>
                    <!--FIN LISTADO BITACORA-->

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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