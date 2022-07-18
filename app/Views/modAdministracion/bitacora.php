<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>


<!-- BITACORA -->
<div class="x_panel">
    <div class="x_title">
        <h2>Administración de Bitácora</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div> 
    </div>
    <div class="x_content">
        <div class="col-md-12 col-sm-12 offset-md-12 right">
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

<script>
    $(document).ready(function() {
    $('#datatable').DataTable( {
        language: {
            url: 'vendors/datatables.net/es.json'
        }
    } );
} );
</script>

<?= $this->endSection() ?>