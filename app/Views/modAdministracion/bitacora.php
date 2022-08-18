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

<script src="vendors/jquery/dist/jquery.slim.min.js"></script>
<script src="vendors/popper/umd/popper.min.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            language: {
                url: 'vendors/datatables.net/es.json'
            },
            "order": [[0, 0]],
            "ordering":true,
        });
    });
</script>

<?= $this->endSection() ?>