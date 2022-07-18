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
<<<<<<< HEAD
        <div class="col-md-12 col-sm-12 offset-md-12 right">
            <!--LISTADO DE BITACORA-->
            <div class="card-box table-responsive"><br>
=======
        <div class="row">
            <div class="col-md-12 col-sm-12 offset-md-12 right">
                <div class="card-box table-responsive"><br>
>>>>>>> 4a7c22949947fa2793d48932d15cd0eab2f7a85c
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
<<<<<<< HEAD
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
=======
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
                                <td>
                                    <a href="" type="button" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
>>>>>>> 4a7c22949947fa2793d48932d15cd0eab2f7a85c
        </div>
    </div>
</div>


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