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
            <div class="card-box table-responsive"><br>
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Actividad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John123</td>
                            <td>22-07-05</td>
                            <td>15:39</td>
                            <td>INSERTO</td>
                            <td><a href="" type="button" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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